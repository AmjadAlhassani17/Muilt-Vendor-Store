@props(['name',  'options' , 'nothingOption'])

<select name="{{ $name }}" {{ $attributes->class(['form-control', 'is-invalid' => $errors->has($name)]) }}>
    <option value="">{{ $nothingOption }}</option>
    @foreach ($options as $value => $text)
        <option value="{{ $value }}" >{{ $text }}</option>
    @endforeach
</select>

@error($name)
    <div class="invalid-feedback">
        {{ $message }}
    </div>
@enderror
