<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Traits\uploadTrait;
use Illuminate\Support\Facades\Storage;


class CategoryController extends Controller
{

    use uploadTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /* search with scoope*/
        $categories=category::WhenSearch(request()->search)->paginate(3);
       /*  //search without scoope
        $categories=category::when($request->search,function($q) use ($request){
            return $q->where('name','like',"%$request->search%");
        })->paginate(2); */
       // dd($categories);
        return view('dashboard.categories.index')->with(['categories'=>$categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.categories.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->hasFile('image'));

        $request->validate([
            'name'=>'required|min:6|unique:categories,name',
            'image'=>'required'
        ]);
        $data=$request->except(['image','token','method']);
        $data['image']=$request->image->hashname();


          /*   $request->image->store('images','public');
            $request->image->store('user-images','public_upload'); */
            $path="uploads/categories";
           /*  //1. get file extension
            $file_extension = $request->image -> getClientOriginalExtension();
            //2 add time to differnet each image from athor
            $file_name = time().'.'.$file_extension;
            $path="uploads/categories";
             $request->image -> move($path,$file_name);*/
             $file_name= $this->saveImage($request->image,$path);
            //dd($file_name);

        $category=Category::create($data);
        //3 move image rquest to folder
        if($category){
            return response()->json([
                'status'=>'true',
                'msg'=>'data inserted successfly'
            ], 200);
        }
         session()->flash('success', 'data inserted with success');
         return redirect()->route('dashboard.category.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {

        return view('dashboard.categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name'=>'required|min:6|unique:categories,name,'.$category->id,
        ]);
        $category->update($request->all());
        session()->flash('success', 'data updated successfuly');
        return redirect()->route('dashboard.category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        session()->flash('success', 'data deleted successfully');
        return redirect()->route('dashboard.category.index');
    }


    /* protected function saveImage($photo,$path){

          //1. get file extension
            $file_extension = $photo->getClientOriginalExtension();
            //2 add time to differnet each image from athor
            $file_name = time().'.'.$file_extension;
             $photo -> move($path,$file_name);

             return $file_name;
    } */
}
