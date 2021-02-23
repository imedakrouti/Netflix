@extends('layouts.dashboard.app')

@section('content')
      <div class="app-title">
        <ul class="app-breadcrumb breadcrumb float-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard.category.index') }}">Categories</a></li>
            <li class="breadcrumb-item active">Editer</li>
          </ul>
      </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile mb-4">
                <h3 class="tile-title">Editer Categories</h3>
                <form method="post" action="{{ route('dashboard.category.update',$category->id) }}">
                    @csrf
                    @method('put')

                   {{--  @include('dashboard.partials._errors') --}}

                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" value="{{old('name',$category->name) }}">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Edit</button>
                    </div>

                </form><!-- end of form -->

            </div><!-- end of tile -->
        </div><!-- end of col -->
    </div><!-- end of row -->

@endsection
