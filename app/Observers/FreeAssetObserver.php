<?php

namespace App\Observers;

use App\Models\FreeAsset;
use Illuminate\Support\Facades\Storage;


class FreeAssetObserver
{
    public function updated(FreeAsset $freeAsset): void
    {

        if ($freeAsset->isDirty('image')) {
            Storage::disk('public')->delete($freeAsset->getOriginal('image'));
        }
    }

    public function deleted(FreeAsset $freeAsset): void
    {
        if (!is_null($freeAsset->image)) {
            Storage::disk('public')->delete($freeAsset->image);
        }
    }
}
