@if (session('message'))
    @if (session('alert_class') == 'danger')
    <div
        class="mb-4 rounded-lg bg-red-100 px-6 py-5 text-base text-red-700"
        role="alert">
        {{ session('message') }}
    </div>
    @elseif (session('alert_class') == 'success')
    <div
        class="mb-4 rounded-lg bg-emerald-100 px-6 py-5 text-base text-emerald-700"
        role="alert">
        {{ session('message') }}
    </div>
    @else
    <div
        class="mb-4 rounded-lg bg-cyan-100 px-6 py-5 text-base text-cyan-700"
        role="alert">
        {{ session('message') }}
    </div>
    @endif
@endif