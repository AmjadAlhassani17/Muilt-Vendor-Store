<?php

namespace App\Http\Controllers\Front\CheckOut;

use Throwable;
use App\Models\Order;
use App\Events\OrderCreated;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Intl\Countries;
use App\Http\Requests\CheckOutRequest;
use App\Repositories\cart\CartRepository;

class CheckOutController extends Controller
{
    //
    public function index(CartRepository $cart)
    {
        if ($cart->get()->count() == 0) {
            return redirect()->route('home');
        }
        $user = Auth::user();
        return view('front.checkout', [
            'cart' => $cart,
            'user' => $user,
            'countries' => Countries::getNames(),
        ]);
    }

    public function store(CheckOutRequest $request, CartRepository $cart)
    {
        $items = $cart->get()->groupBy('product.store_id')->all();

        DB::beginTransaction();
        try {
            foreach ($items as $store_id => $cartItems) {
                $order = Order::create([
                    'store_id' => $store_id,
                    'user_id' => Auth::id(),
                    'payment_method' => 'paypal',
                ]);

                foreach ($cartItems as $items) {
                    OrderProduct::create([
                        'order_id' => $order->id,
                        'product_id' => $items->product_id,
                        'product_name' => $items->product->name,
                        'product_price' => $items->product->price,
                        'product_quantity' => $items->quantity,
                    ]);
                }

                foreach ($request->post('addr') as $type => $address) {
                    $address['type'] = $type;
                    $order->addresses()->create($address);
                }
            }

            DB::commit();

            event(new OrderCreated($order));
            
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }

        // return redirect()->route('home');

    }
}