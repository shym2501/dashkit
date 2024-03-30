<?php

namespace App\Filament\Resources\Promotion;

use Filament\Forms;
use Filament\Tables;
use Livewire\Component;
use Filament\Forms\Form;
use App\Models\FlashSale;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\RichEditor;
use App\Filament\Resources\Promotion\FlashSaleResource\Pages;
use App\Filament\Resources\Promotion\FlashSaleResource\RelationManagers;

class FlashSaleResource extends Resource
{
    protected static ?string $model = FlashSale::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $recordTitleAttribute = 'Flash Sale';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationGroup = 'Promotion';

    public static function getModelLabel(): string
    {
        return __('crud.flashSales.itemTitle');
    }

    public static function getPluralModelLabel(): string
    {
        return __('crud.flashSales.collectionTitle');
    }

    public static function getNavigationLabel(): string
    {
        return __('crud.flashSales.collectionTitle');
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

                    RichEditor::make('description')
                        ->nullable()
                        ->string()
                        ->fileAttachmentsVisibility('public'),
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

                TextColumn::make('description')->limit(255),
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
            'index' => Pages\ListFlashSales::route('/'),
            'create' => Pages\CreateFlashSale::route('/create'),
            'view' => Pages\ViewFlashSale::route('/{record}'),
            'edit' => Pages\EditFlashSale::route('/{record}/edit'),
        ];
    }
}
