@props([
    'type' => 'radio',
    'options',
    'lable' => false,
    'checked',
    'name'
])

@if ($lable)
    <lable for="">{{ $lable }}</lable>
@endif

@foreach ($options as $value => $text)
    <div class="form-check">
        <input {{ $attributes->class(['form-check-input', 'is-invalid' => $errors->has($name)]) }}
            type="{{ $type }}" value="{{ $value }}" name="{{ $name }}" @checked(old($name, $checked) == $value)>
        <label class="form-check-label">
            {{ $text }}
        </label>
    </div>
@endforeach

@error($name)
    <div class="invalid-feedback">
        {{ $message }}
    </div>
@enderror
