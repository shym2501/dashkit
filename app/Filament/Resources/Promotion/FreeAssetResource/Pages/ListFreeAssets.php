<?php

namespace App\Filament\Resources\Promotion\FreeAssetResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\Promotion\FreeAssetResource;

class ListFreeAssets extends ListRecords
{
    protected static string $resource = FreeAssetResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\CreateAction::make()];
    }
}
