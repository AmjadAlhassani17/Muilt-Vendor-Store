<?php

namespace App\Http\Controllers\Front;

use App\Helpers\Currency;
use App\Http\Controllers\Controller;
use App\Http\Requests\CartRequest;
use App\Fasades\Cart;
use App\Models\Product;
use App\Repositories\cart\CartRepository;
use App\View\Components\CartMenu;
use Illuminate\Http\Request;
use Illuminate\View\Component;

class CartController extends Controller
{

    protected $cart;

    public function __construct(CartRepository $cart)
    {
        $this->cart = $cart;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(CartRepository $cart)
    {
        //
        return view('front.cart', compact(['cart']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CartRequest $request, CartRepository $cart)
    {
        //
        $product = Product::findOrFail($request->product_id);
        
        $this->cart->add($product, $request->quantity);

        $items = Cart::get();
        $total = Cart::total();
        return view('front.cart-menu-update', compact('items','total'))->render();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'quantity' => ['required', 'int', 'min:1'],
        ]);

        $this->cart->update($id, $request->quantity);

        // return Redirect::route('front.cart.index');
        $cart = Cart::where('id', '=', $id)->first();
        $quantity = $cart->quantity;
        $msg = Currency::format($cart->product->price * $request->quantity);
        $total = Currency::format($this->cart->total());
        return response()->json(array('msg' => $msg, 'total' => $total, 'quantity' => $quantity), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $this->cart->delete($id);
        
        $itemCount = Cart::get()->count();
        $total = Currency::format($this->cart->total());
        return response()->json(array('itemCount' => $itemCount, 'total' => $total), 200);
    }
}