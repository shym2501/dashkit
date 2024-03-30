<?php

namespace App\Filament\Resources\Promotion;

use Filament\Forms;
use Filament\Tables;
use Livewire\Component;
use App\Models\Voucher;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\CheckboxColumn;
use App\Filament\Resources\Promotion\VoucherResource\Pages;
use App\Filament\Resources\Promotion\VoucherResource\RelationManagers;

class VoucherResource extends Resource
{
    protected static ?string $model = Voucher::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationGroup = 'Promotion';

    public static function getModelLabel(): string
    {
        return __('crud.vouchers.itemTitle');
    }

    public static function getPluralModelLabel(): string
    {
        return __('crud.vouchers.collectionTitle');
    }

    public static function getNavigationLabel(): string
    {
        return __('crud.vouchers.collectionTitle');
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make()->schema([
                Grid::make(['default' => 1])->schema([
                    TextInput::make('name')
                        ->required()
                        ->string()
                        ->autofocus(),

                    TextInput::make('value')
                        ->required()
                        ->numeric()
                        ->step(1),

                    Toggle::make('as_a')
                        ->rules(['boolean'])
                        ->required()
                        ->inline(),
                ]),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->poll('60s')
            ->columns([
                TextColumn::make('name'),

                TextColumn::make('value'),

                CheckboxColumn::make('as_a')->label(
                    __('crud.vouchers.filament.as_a.label')
                ),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('id', 'desc');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVouchers::route('/'),
            'create' => Pages\CreateVoucher::route('/create'),
            'view' => Pages\ViewVoucher::route('/{record}'),
            'edit' => Pages\EditVoucher::route('/{record}/edit'),
        ];
    }
}
