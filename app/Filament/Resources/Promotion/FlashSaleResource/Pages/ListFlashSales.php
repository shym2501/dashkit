<?php

namespace App\Filament\Resources\Promotion\FlashSaleResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\Promotion\FlashSaleResource;

class ListFlashSales extends ListRecords
{
    protected static string $resource = FlashSaleResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\CreateAction::make()];
    }
}
