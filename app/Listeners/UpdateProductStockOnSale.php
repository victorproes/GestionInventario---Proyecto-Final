<?php

namespace App\Listeners;
use App\Events\ProductSold;
use App\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateProductStockOnSale
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
    public function handle(ProductSold $event)
    {
        $product = Product::find($event->productId);

        if ($event->isCancel) {
            $product->stock += $event->quantity; // Aumento del stock
        } else {
            $product->stock -= $event->quantity; // Descuento del stock
        }

        $product->save();
    }
}
