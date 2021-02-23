@if ($errors->any())
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        @foreach ($errors->all() as $error)
            <p class="mb-2 bg-primary">{{ $error }}</p>
        @endforeach
    </div>
@endif

