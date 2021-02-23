@extends('layouts.dashboard.app')

@section('content')

      <div class="app-title">
        <ul class="app-breadcrumb breadcrumb float-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard.category.index') }}">Categories</a></li>
            <li class="breadcrumb-item active">Add</li>
          </ul>
      </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile mb-4">
                <h3 class="tile-title">Ajouter Categories</h3>
                <form method="post" action="
              {{--   {{ route('dashboard.category.store') }} --}}
                "
                  enctype="multipart/form-data"
                  id="formcreate">
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
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control @error('image')
                        is-invalid
                        @enderror" value="{{ old('image') }}">
                        @error('image')
                        <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <button type="" class="btn btn-primary save"><i class="fa fa-plus"></i> Add</button>
                    </div>

                </form><!-- end of form -->

            </div><!-- end of tile -->
        </div><!-- end of col -->
    </div><!-- end of row -->

@endsection
@section('scripts')
<script>
    console.log('imed');
    $(document).on('click', '.save', function (e) {
            e.preventDefault();
            var form_data=new FormData($('#formcreate')[0]);
            $.ajax({
        type: "post",
        enctype:"multipart/form-data",
        url: "{{ route('dashboard.category.store') }}",
        data: form_data,
        processData:false,
        contentType:false,
        success: function (response) {
            if(response.status=='true'){
                new Noty({
                    type: 'warning',
                    layout: 'bottomRight',
                    text: response.msg,
                    timeout: 2000,
                    }).show();
            }
        },
        error: function (reject) {

        }
    });
    });



</script>
@stop
