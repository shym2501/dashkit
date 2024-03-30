<?php

namespace App\Filament\Resources\Promotion\VoucherResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\Promotion\VoucherResource;

class ViewVoucher extends ViewRecord
{
    protected static string $resource = VoucherResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\EditAction::make()];
    }
}
