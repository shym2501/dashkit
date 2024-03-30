<?php

namespace App\Filament\Resources\Promotion\FlashSaleResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\Promotion\FlashSaleResource;

class ViewFlashSale extends ViewRecord
{
    protected static string $resource = FlashSaleResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\EditAction::make()];
    }
}
