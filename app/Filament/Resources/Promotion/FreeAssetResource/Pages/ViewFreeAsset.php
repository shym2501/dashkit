<?php

namespace App\Filament\Resources\Promotion\FreeAssetResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\Promotion\FreeAssetResource;

class ViewFreeAsset extends ViewRecord
{
    protected static string $resource = FreeAssetResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\EditAction::make()];
    }
}
