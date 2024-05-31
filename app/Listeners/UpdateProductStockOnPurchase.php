<?php

namespace App\Listeners;

use App\Events\ProductPurchased;
use App\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateProductStockOnPurchase
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
    public function handle(ProductPurchased $event)
    {
        $product = Product::find($event->productId);

        if ($event->isCancel) {
            $product->stock -= $event->quantity; // Descuento del stock
        } else {
            $product->stock += $event->quantity; // Aumento del stock
        }

        $product->save();
    }
}
