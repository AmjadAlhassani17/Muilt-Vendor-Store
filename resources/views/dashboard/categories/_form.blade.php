{{-- @if ($errors->any())
    <div class="alert alert-danger">
        <h3>Error!</h3>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}
<div class="form-group">
    <x-form.input type="text" name="name" :value="$category->name" lable="Category Name" />
</div>
<div class="form-group">
    <x-form.select name="parent_id" nothingOption="Primary Category" lable="Category Parent" :options="$parents"
        :value="$category->parent_id" />
</div>
<div class="form-group">
    <x-form.textarea name="description" :value="$category->description" lable="Category Description" />
</div>
<div class="form-group">
    <x-form.input type="file" name="image" :value="$category->name" lable="Category Image" accept="image/*" />
    @if ($category->image)
        <img src="{{ asset('storage/' . old('image', $category->image)) }}" alt="" height="60">
    @endif
</div>
<div class="form-group">
    <x-form.radio name="status" type="radio" :options="['active' => 'Active' , 'archive' => 'Archive']"
        :checked="$category->status" />
</div>
<div class="form-group">
    <button type="submit" class="btn btn-primary">Save</button>
</div>
