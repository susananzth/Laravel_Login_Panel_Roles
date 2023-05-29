@if (session('message'))
<div class="alert alert-{{ session('alert_class') ? session('alert_class') : 'info' }} alert-dismissible fade show" role="alert">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    {{ session('message') }}
</div>
@endif
@if ($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    <div>@lang('Whoops! Something went wrong.')</div>
    <ul class="m-0">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
