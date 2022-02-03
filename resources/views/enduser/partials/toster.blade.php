@if(session('erorr'))
    <script>
        toastr.error('{{ session('erorr') }}')
    </script>
@endif



@if ($errors->any())
    @foreach ($errors->all() as $error)
    <script>
        toastr.error('{{ $error }}')
    </script>
    @endforeach
@endif

@if(session('success'))
    <script>
        toastr.success('{{ session('success') }}')
    </script>
@endif

@if(session('add'))
<script>
    toastr.success('{{ session('add') }}')
</script>
@endif

@if(session('update'))
<script>
    toastr.info('{{ session('update') }}')
</script>
@endif

