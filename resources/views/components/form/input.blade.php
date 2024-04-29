@props([
    'type' => 'name',
    'name',
    'value' => '',
    'lable' => false,
])

@if ($lable)
    <lable for="">{{ $lable }}</lable>
@endif

<input type="{{ $type }}" name="{{ $name }}" value="{{ old($name, $value) }}"
    {{ $attributes->class(['form-control', 'is-invalid' => $errors->has($name)]) }}>

@error($name)
    <div class="invalid-feedback">
        {{ $message }}
    </div>
@enderror
