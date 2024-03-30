<?php

namespace App\Filament\Resources\Promotion\VoucherResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\Promotion\VoucherResource;

class ListVouchers extends ListRecords
{
    protected static string $resource = VoucherResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\CreateAction::make()];
    }
}
