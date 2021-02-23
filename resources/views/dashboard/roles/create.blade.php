@extends('layouts.dashboard.app')

@section('content')
      <div class="app-title">
        <ul class="app-breadcrumb breadcrumb float-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard.role.index') }}">Roles</a></li>
            <li class="breadcrumb-item active">Add</li>
          </ul>
      </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile mb-4">
                <h3 class="tile-title">Ajouter Roles</h3>
                <form method="post" action="{{ route('dashboard.role.store') }}"  enctype="multipart/form-data">
                    @csrf
                    @method('post')

                   {{--  @include('dashboard.partials._errors') --}}

                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control @error('name')
                        is-invalid
                        @enderror" value="{{ old('name') }}">
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                    </div>
                   {{--  <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control @error('image')
                        is-invalid
                        @enderror" value="{{ old('image') }}">
                        @error('image')
                        <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                    </div> --}}
                   <div class="form-group">
                   Permissions
                     @php
                         $models=['categories','users']
                     @endphp
                 <table class="table table-hover  table-responsive">
                     <thead>
                         <tr>
                             <th width="10%">#</th>
                             <th width="15%">Model</th>
                             <th>Permission</th>
                         </tr>
                         </thead>
                         <tbody>
                             @foreach($models as $index => $model)
                             <tr>
                                <td>{{ $index+1 }}</td>
                                <td>{{$model}}</td>
                                <td>
                                    @php
                                        $permissions_map=['create','read','update','delete']
                                    @endphp
                                      <select class="form-control select2" name="permissions[]" id=""multiple>
                                       @foreach($permissions_map as $permission_map)
                                       <option value="{{ $model . '_' . $permission_map }}">{{ $permission_map }}</option>
                                       @endforeach
                                      </select>
                                </td>
                             @endforeach
                             </tr>
                          
                         </tbody>
                 </table>
                   </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Add</button>
                    </div>

                </form><!-- end of form -->

            </div><!-- end of tile -->
        </div><!-- end of col -->
    </div><!-- end of row -->

@endsection
