@extends('layouts.dashboard.app')
@section ('title','Liste Categories')
@section('content')

      <div class="app-title">
        <h1>Categories</h1>
        <ul class="app-breadcrumb breadcrumb float-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard.category.index') }}">Categories</a></li>
            <li class="breadcrumb-item active">Index</li>
          </ul>
      </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile mb-4">
                <h3 class="tile-title">listes Categories</h3>
                <div class="col-md-12">
                        <form class="row" action="{{ route('dashboard.category.index') }}" method="GET">
                          <div class="form-group col-md-6">
                            <input class="form-control" name="search"type="search" placeholder="Search Category"autofocus value="{{ request()->search }}">
                          </div>
                          <div class="form-group col-md-4 align-self-end">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Search</button>
                            <a href="{{ route('dashboard.category.create') }}"class="btn btn-primary" type="button"><i class="fa fa-fw fa-lg fa-plus-circle"></i>Create</a>
                          </div>
                        </form>
                      </div>
                      @if($categories->count())
                <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>First Name</th>
                        <th>Actions</th>

                      </tr>
                    </thead>
                    <tbody>
                     @foreach($categories as $index => $category)
                         <tr>
                             <td>{{ $index+1 }}</td>
                             <td>{{ $category->name }}</td>
                             <td><a href="{{ route('dashboard.category.edit',$category->id) }}"class="btn btn-warning btn-sm "><i class="fa fa-edit"></i>Edit</a>
                                <a href=""><i class="fa fa-dismiss"></i></a>
                                <form method="post" action="{{ route('dashboard.category.destroy', $category->id) }}" style="display: inline-block;">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm delete"><i class="fa fa-trash"></i> Delete</button>
                                </form>
                            </td>
                         </tr>
                     @endforeach
                    </tbody>
                  </table>
                  <div class="row justify-content-center">
                    {{ $categories->appends(Request()->query())->links() }}
                  </div>
                  @else
                  <h3 class="text-center text-danger">No data available</h3>
                  @endif
            </div><!-- end of tile -->
        </div><!-- end of col -->
    </div><!-- end of row -->
</div>
@endsection
