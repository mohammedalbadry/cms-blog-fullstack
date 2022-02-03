@if(session('erorr'))
    <div class="alert alert-danger" style="text-align: right">
        {{ session('erorr') }}
    </div>
@endif

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger"  style="text-align: right">
            {{ $error }}
        </div>
    @endforeach
@endif

@if(session('success'))
    <div class="alert alert-success"  style="text-align: right">
        {{ session('success') }}
    </div>
@endif

@if(session('add'))
    <div class="alert alert-success"  style="text-align: right">
        {{ session('add') }}
    </div>
@endif

@if(session('update'))
    <div class="alert alert-primary"  style="text-align: right">
        {{ session('update') }}
    </div>
@endif

