<?php

namespace App\Filament\Resources\Catalog;

use Filament\Forms;
use Filament\Tables;
use Livewire\Component;
use App\Models\Product;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\CheckboxColumn;
use App\Filament\Resources\Catalog\ProductResource\Pages;
use App\Filament\Resources\Catalog\ProductResource\RelationManagers;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $recordTitleAttribute = 'Produk';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationGroup = 'Catalog';

    public static function getModelLabel(): string
    {
        return __('crud.products.itemTitle');
    }

    public static function getPluralModelLabel(): string
    {
        return __('crud.products.collectionTitle');
    }

    public static function getNavigationLabel(): string
    {
        return __('crud.products.collectionTitle');
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

                    FileUpload::make('image')
                        ->rules(['image'])
                        ->nullable()
                        ->maxSize(1024)
                        ->preserveFilenames()
                        ->image()
                        ->imageEditor()
                        ->imageEditorAspectRatios([null, '16:9', '4:3', '1:1']),

                    TextInput::make('price')
                        ->required()
                        ->numeric()
                        ->step(1),

                    TextInput::make('discount')
                        ->nullable()
                        ->numeric()
                        ->step(1),

                    TextInput::make('total')
                        ->nullable()
                        ->numeric()
                        ->step(1),

                    Select::make('category_id')
                        ->nullable()
                        ->relationship('category', 'name')
                        ->searchable()
                        ->preload()
                        ->native(false),

                    TextInput::make('link')
                        ->required()
                        ->string(),

                    Toggle::make('is_visibled')
                        ->rules(['boolean'])
                        ->required(),

                    Select::make('flash_sale_id')
                        ->nullable()
                        ->relationship('flashSale', 'name')
                        ->searchable()
                        ->preload()
                        ->native(false),
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

                ImageColumn::make('image')->visibility('public'),

                TextColumn::make('price'),

                TextColumn::make('discount'),

                TextColumn::make('total'),

                TextColumn::make('category.name'),

                TextColumn::make('link'),

                CheckboxColumn::make('is_visibled'),

                TextColumn::make('flashSale.name'),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'view' => Pages\ViewProduct::route('/{record}'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
