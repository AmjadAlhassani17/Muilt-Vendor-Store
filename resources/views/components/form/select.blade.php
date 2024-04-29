@props(['name', 'nothingOption', 'options', 'lable' => false, 'value' => ''])

@if ($lable)
    <lable for="">{{ $lable }}</lable>
@endif

<select name="{{ $name }}" {{ $attributes->class(['form-control', 'is-invalid' => $errors->has($name)]) }}>
    <option value="">{{ $nothingOption }}</option>
    @foreach ($options as $option)
        <option value="{{ $option->id }}" @selected($option->id == old($name, $value))>{{ $option->name }}</option>
    @endforeach
</select>

@error($name)
    <div class="invalid-feedback">
        {{ $message }}
    </div>
@enderror
