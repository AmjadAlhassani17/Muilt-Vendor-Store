<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    //
    public function index()
    {
        $products = Product::active()->get();
        $productsGrid = Product::active()->paginate(9);
        $productsList = Product::active()->paginate(5);
        return view('front.shop-product' , compact(['products', 'productsGrid', 'productsList']));
    }
    
    public function show(Product $product)
    {
        if($product->status != 'active'){
            return view('front.404');
        }
        return view('front.product-details' , compact('product'));
    }

    public function pagination()
    {
        $products = Product::active()->get();
        $productsGrid = Product::active()->paginate(9);
        $productsList = Product::active()->paginate(5);
        return view('front.pagination-product' , compact(['products', 'productsGrid', 'productsList']))->render();
    }

}