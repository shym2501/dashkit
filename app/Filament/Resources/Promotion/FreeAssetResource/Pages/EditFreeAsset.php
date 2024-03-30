<?php

namespace App\Filament\Resources\Promotion\FreeAssetResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\Promotion\FreeAssetResource;

class EditFreeAsset extends EditRecord
{
    protected static string $resource = FreeAssetResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\DeleteAction::make()];
    }
}
