@extends('layouts.dashboard.app')

@section('content')
      <div class="app-title">
        <ul class="app-breadcrumb breadcrumb float-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard.user.index') }}">Usres</a></li>
            <li class="breadcrumb-item active">Add</li>
          </ul>
      </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile mb-4">
                <h3 class="tile-title">Ajouter User</h3>
                <form method="post" action="{{ route('dashboard.user.store') }}"  enctype="multipart/form-data">
                    @csrf
                    @method('post')

                   {{--  @include('dashboard.partials._errors') --}}

                    <div class="form-group">
                        @include('partial.errors')

                        {{--name--}}
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                        </div>

                        {{--email--}}
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                        </div>

                        {{--password--}}
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>

                        {{--password confirmation--}}
                        <div class="form-group">
                            <label>Password Confirmation</label>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>

                        {{--roles--}}
                        <div class="form-group">
                            <label>Roles</label>
                            <select name="role_id" class="form-control">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                            <a href="{{ route('dashboard.role.create') }}">Create new role</a>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add</button>
                        </div>

                </form><!-- end of form -->

            </div><!-- end of tile -->
        </div><!-- end of col -->
    </div><!-- end of row -->

@endsection
