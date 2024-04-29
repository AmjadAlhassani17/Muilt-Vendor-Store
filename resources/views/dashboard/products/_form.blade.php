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
    <x-form.input type="text" name="name" :value="$product->name" lable="Product Name" />
</div>
<div class="form-group">
    <x-form.select name="category_id" nothingOption="" lable="Product Parent" :options="App\Models\Category::all()"
        :value="$product->category_id" />
</div>
<div class="form-group">
    <x-form.textarea name="description" :value="$product->description" lable="Product Description" />
</div>
<div class="form-group">
    <x-form.input type="file" name="image" :value="$product->image" lable="Product Image" accept="image/*" />
    @if ($product->image)
        <img src="{{ asset('storage/' . old('image', $product->image)) }}" alt="" height="60">
    @endif
</div>
<div class="form-group">
    <x-form.input type="text" name="tags" :value="$tags" lable="Product Tags" />
</div>
<div class="form-group">
    <x-form.radio name="status" type="radio" :options="['active' => 'Active' , 'draft' => 'Draft' , 'archive' => 'Archive' ]"
        :checked="$product->status" />
</div>
<div class="form-group">
    <button type="submit" class="btn btn-primary">Save</button>
</div>
