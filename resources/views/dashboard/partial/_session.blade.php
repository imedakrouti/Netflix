@if(Session::has('success'))
    <script>
        new Noty({
            theme: 'relax',
            type:'warning',
            layout: 'topRight',
            text: "{{session('success') }}",
            killer: true,
            timeout: 2000,
        }).show();
    </script>
@endif
