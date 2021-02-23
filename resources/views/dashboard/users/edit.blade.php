@extends('layouts.dashboard.app')

@section('content')
      <div class="app-title">
        <ul class="app-breadcrumb breadcrumb float-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard.role.index') }}">Roles</a></li>
            <li class="breadcrumb-item active">Editer</li>
          </ul>
      </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile mb-4">
                <h3 class="tile-title">Editer Roles</h3>
                <form method="post" action="{{ route('dashboard.role.update', $role->id) }}">
                    @csrf
                    @method('put')

              {{--       @include('dashboard.partials._errors') --}}

                    {{--name--}}
                    <div class="form-group">
                        <label>Name</label>
                      {{--   <input type="text" name="name" class="form-control" value="{{ old('name', $role->name) }}"> --}}
                        <input type="text" name="name" class="form-control @error('name')
                        is-invalid
                        @enderror"value="{{ old('name', $role->name) }}">
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                    </div>

                    {{--permissions--}}
                    <div class="form-group">
                        <h4>Permissions</h4>
                        @php
                            $models = ['categories','movies', 'users', 'settings'];
                        @endphp

                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th style="width: 5%;">#</th>
                                <th style="width: 15%;">Model</th>
                                <th>action</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($models as $index=>$model)
                                <tr>
                                    <td>{{ $index+1 }}</td>
                                    <td>{{ $model }}</td>
                                    <td>
                                        @php
                                            $permission_maps = ['create', 'read', 'update', 'delete'];
                                        @endphp

                                        @if ($model == 'settings')
                                            @php
                                                $permission_maps = ['create', 'read'];
                                            @endphp
                                        @endif
                                        <select name="permissions[]" class="form-control select2" multiple>
                                            @foreach ($permission_maps as $permission_map)
                                                <option {{ $role->hasPermission($permission_map . '_' . $model) ? 'selected' : '' }} value="{{ $permission_map . '_' . $model }}">{{ $permission_map }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table><!-- end of table -->
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</button>
                    </div>

                </form><!-- end of form -->

            </div><!-- end of tile -->
        </div><!-- end of col -->
    </div><!-- end of row -->

@endsection
