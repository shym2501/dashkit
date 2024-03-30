<?php

namespace App\Filament\Resources\Promotion\VoucherResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\Promotion\VoucherResource;

class EditVoucher extends EditRecord
{
    protected static string $resource = VoucherResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\DeleteAction::make()];
    }
}
