<?php

namespace App\Repositories\cart;

use App\Helpers\Currency;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class CartModelRepository implements CartRepository
{
    public function get(): Collection
    {
        return Cart::with('product')->where('cookie_id', '=', $this->getCookieID())->get();
    }

    public function add(Product $product, $quantity = 1)
    {
        $item = Cart::where('product_id', '=', $product->id)->first();

        if(!$item)
        {
            return Cart::create([
                'cookie_id' => $this->getCookieID(),
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => $quantity,
            ]); 
        }
        return $item->increment('quantity' , $quantity);
    }

    public function update($id, $quantity)
    {
        Cart::where('cookie_id', '=', $this->getCookieID())
            ->where('id', '=', $id)
            ->update([
                'quantity' => $quantity,
            ]);
    }

    public function delete($id)
    {
        Cart::where('cookie_id', '=', $this->getCookieID())
            ->where('id', '=', $id)->delete();
    }

    public function empty()
    {
        Cart::where('cookie_id', '=', $this->getCookieID())->delete();
    }

    public function total() : float
    {
        // return (float) Cart::where('cookie_id', '=', $this->getCookieID())
        //     ->join('products', 'products.id', '=', 'carts.product_id')
        //     ->selectRaw('SUM(products.price * carts.quantity) as total')->value('total');

        return (float) $this->get()->sum(function($item){
            return ($item->quantity * $item->product->price) ?? 0;
        });
    }

    protected function getCookieID()
    {
        $cookie_id = Cookie::get('cart_id');
        if (!$cookie_id) {
            $cookie_id = Str::uuid();
            Cookie::queue('cart_id', $cookie_id, 30 * 24 * 60);
        }
        return $cookie_id;
    }
}