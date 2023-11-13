@if ($errors->any())
<div
    class="mb-4 rounded-lg bg-red-100 px-6 py-5 text-base text-red-700"
    role="alert">
    <h4 class="mb-2 text-2xl font-medium leading-tight">
        @lang('Whoops! Something went wrong.')
    </h4>
    <ul class="m-0">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif