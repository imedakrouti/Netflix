@extends('layouts.dashboard.app')

@section('content')
      <div class="app-title">
        <h1>users</h1>
        <ul class="app-breadcrumb breadcrumb float-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard.user.index') }}">users</a></li>
            <li class="breadcrumb-item active">Index</li>
          </ul>
      </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile mb-4">
                <h3 class="tile-title">listes users</h3>
                <div class="col-md-12">
                        <form class="row" action="{{ route('dashboard.user.index') }}" method="GET">
                          <div class="form-group col-md-6">
                            <input class="form-control" name="search"type="search" placeholder="Search user"autofocus value="{{ request()->search }}">
                          </div>
                          <div class="form-group col-md-4 align-self-end">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Search</button>
                            <a href="{{ route('dashboard.user.create') }}"class="btn btn-primary" type="button"><i class="fa fa-fw fa-lg fa-plus-circle"></i>Create</a>
                          </div>
                        </form>
                      </div>
                      @if($users->count())
                <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>First Name</th>
                        <th>Email</th>
                        <th>Role</th>

                      </tr>
                    </thead>
                    <tbody>
                     @foreach($users as $index => $user)
                         <tr>
                             <td>{{ $index+1 }}</td>
                             <td>{{ $user->name }}</td>
                             <td>{{ $user->email }}</td>
                             <td>{{ implode(',',$user->roles->pluck('display_name')->toArray() )}}</td>
                             <td><a href="{{ route('dashboard.user.edit',$user->id) }}"class="btn btn-warning btn-sm "><i class="fa fa-edit"></i>Edit</a>
                                <a href=""><i class="fa fa-dismiss"></i></a>
                                <form method="post" action="{{ route('dashboard.user.destroy', $user->id) }}" style="display: inline-block;">
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
                    {{ $users->appends(Request()->query())->links() }}
                  </div>
                  @else
                  <h3 class="text-center text-danger">No data available</h3>
                  @endif
            </div><!-- end of tile -->
        </div><!-- end of col -->
    </div><!-- end of row -->
</div>
@endsection
