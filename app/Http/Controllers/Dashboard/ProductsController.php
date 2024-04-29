<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $products = Product::with(['store' , 'category'])->paginate();
        return view('dashboard.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $product = new Product();
        $tags = new Tag();
        return view('dashboard.products.create' , compact(['product','tags']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $user = Auth::user();
        
        $request->merge([
            'slug' => Str::slug($request->name),
            'store_id' => $user->store_id,
        ]);

        $data = $request->except('tags');

        $tags = explode(',' , $request->tags);
        $tag_ids = [];
        foreach($tags as $item){
            $tag_slug = Str::slug($item);
            $tag = Tag::where('slug' , '=' , $tag_slug)->first();
            if(!$tag){
                $tag = Tag::create([
                    'name' => $item,
                    'slug' => $tag_slug,
                ]);
            }
            $tag_ids[] = $tag->id;
        }

        $product = Product::create($data);

        $product->tags()->sync($tag_ids);

        return Redirect::route('dashboard.products.index')->with([
            'success' => 'Products Created Successfuly!',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $tags = implode(',' , $product->tags()->pluck('name')->toArray());
        return view('dashboard.products.edit' , compact(['product' , 'tags']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $product->update($request->except('tags'));

        $tags = explode(',' , $request->tags);
        $tag_ids = [];
        foreach($tags as $item){
            $tag_slug = Str::slug($item);
            $tag = Tag::where('slug' , '=' , $tag_slug)->first();
            if(!$tag){
                $tag = Tag::create([
                    'name' => $item,
                    'slug' => $tag_slug,
                ]);
            }
            $tag_ids[] = $tag->id;
        }

        $product->tags()->sync($tag_ids);

        return Redirect::route('dashboard.products.index')->with([
            'success' => 'Product has been Updated!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $product = Product::findOrFail($id);

        $product->delete();

        if($product->image){
            Storage::disk('public')->delete($product->image);
        }

        return Redirect::route('dashboard.products.index')->with([
            'info' => 'Category deleted Successfuly!',
        ]);
    }
}