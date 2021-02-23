<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\user;
use App\Models\role;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       /*  $users=user::where('name','like',"%request()->search%")->paginate(2); */
     /*  $users=user::WhenSearch(request()->search)->paginate(2); */
 /*    $users=user::SearchRole(request()->search)->paginate(2); */
      /*   $users=user::when(request()->search,function($query){
           return  $query->wherehas('roles',function($q){

                return $q->where('name',request()->search);
               });
        })
            ->paginate(2); */

        $users=user::SearchRoleNot('super_admin')->paginate(2);
        return view('dashboard.users.index',compact('users'));
      //  return view('dashboard.users.index')->with(['users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles=role::WhereNotRule(['super_admin','admin'])->get();
       // dd($roles);
        return view('dashboard.users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            'role_id' => 'required|numeric',
        ]);

        $request->merge(['password' => bcrypt($request->password)]);

        $user = User::create($request->all());
        $user->attachRoles(['admin', $request->role_id]);

        session()->flash('success', 'Data added successfully');
        return redirect()->route('dashboard.user.index');
        }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function show(user $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(user $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, user $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(user $user)
    {
        //
    }
}
