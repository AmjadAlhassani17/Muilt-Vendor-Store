@props([ 'type' ])

@if (session()->has($type))
    <div class="alert alert-{{ $type }}" id="alertMessage">{{ session($type) }}</div>
@endif
