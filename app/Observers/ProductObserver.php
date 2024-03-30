<?php

namespace App\Observers;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductObserver
{
    public function created(Product $product): void
    {
        // $diskon = $product->price * $product->discount / 100;
        // $product->total = $product->price - $diskon;
        // $product->save();
    }

    public function updated(Product $product): void
    {

        if ($product->isDirty('image')) {
            Storage::disk('public')->delete($product->getOriginal('image'));
        }

        // $diskon = $product->price * $product->discount / 100;
        // $product->total = $product->price - $diskon;
    }

    public function deleted(Product $product): void
    {
        if (!is_null($product->image)) {
            Storage::disk('public')->delete($product->image);
        }
    }
}
