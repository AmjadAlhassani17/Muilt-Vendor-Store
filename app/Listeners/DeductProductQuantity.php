<?php

namespace App\Listeners;

use App\Fasades\Cart;
use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class DeductProductQuantity
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $order = $event->order;

        foreach($order->products as $product)
        {
            $product->decrement('quantity' , $product->pivot->product_quantity);
            // Product::where('id', '=' , $item->product_id)->update([
            //     'quantity' => DB::raw("quantity - {$item->quantity}"),
            // ]);
        }
        
    }
}