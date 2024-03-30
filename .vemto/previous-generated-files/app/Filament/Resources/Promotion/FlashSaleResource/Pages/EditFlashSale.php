<?php

namespace App\Filament\Resources\Promotion\FlashSaleResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\Promotion\FlashSaleResource;

class EditFlashSale extends EditRecord
{
    protected static string $resource = FlashSaleResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\DeleteAction::make()];
    }
}
