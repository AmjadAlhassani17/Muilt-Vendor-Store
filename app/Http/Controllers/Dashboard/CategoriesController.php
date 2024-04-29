<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoriesRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $categories = Category::LeftJoin('categories as parents', 'parents.id', '=', 'categories.parent_id')->select([
            'categories.*', 'parents.name as parent_name',
        ])->filter($request->query())->withCount('products as products_count')->with('products')->paginate();

        return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $parents = Category::all();
        $category = new Category();
        return view('dashboard.categories.create', compact('parents', 'category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoriesRequest $request)
    {
        $request->merge([
            'slug' => Str::slug($request->name),
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $data['image'] = $this->UploadImage($request);
        }

        $category = Category::create($data);

        return Redirect::route('dashboard.categories.index')->with([
            'success' => 'Category Created Successfuly!',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('dashboard.categories.show', [
            'category' => $category,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $category = Category::findOrFail($id);

        // SELECT * FROM Categories WHERE id != id AND
        // parent_id IS NULL OR parent_id != id
        $parents = Category::where('id', '<>', $id)
            ->where(function ($query) use ($id) {
                $query->whereNull('parent_id')->Orwhere('parent_id', '<>', $id);
            })->get();
        return view('dashboard.categories.edit', compact('category', 'parents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoriesRequest $request, string $id)
    {
        $category = Category::findOrFail($id);

        $old_image = $category->image;

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $data['image'] = $this->UploadImage($request);
        }

        $category->update($data);

        if ($old_image && isset($data['image'])) {
            Storage::disk('public')->delete($old_image);
        }

        return Redirect::route('dashboard.categories.index')->with([
            'success' => 'Category Updated Successfuly!',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $category = Category::findOrFail($id);

        $category->delete();
        // Category::destroy($id);

        return Redirect::route('dashboard.categories.index')->with([
            'info' => 'Category deleted Successfuly!',
        ]);
    }

    protected function UploadImage(Request $request)
    {
        $file = $request->file('image');
        $path = $file->store('uploads', [
            'disk' => 'public',
        ]);

        return $path;
    }

    public function trash()
    {
        $categories = Category::onlyTrashed()->paginate();
        return view('dashboard.categories.trash', compact('categories'));
    }

    public function restore(Request $request, $id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);

        $category->restore();

        return Redirect::route('dashboard.categories.trash')->with([
            'success' => 'Category Restore Successfuly!',
        ]);
    }

    public function force_delete(Request $request , $id){

        $category = Category::onlyTrashed()->findOrFail($id);

        $category->forceDelete();

        if($category->image){
            Storage::disk('public')->delete($category->image);
        }
        
        return Redirect::route('dashboard.categories.trash')->with([
            'success' => 'Category Deleted Forever Successfuly!',
        ]);
    }

}