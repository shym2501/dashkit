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
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\FileUpload;
use App\Filament\Resources\Catalog\ProductResource\Pages;
use App\Filament\Resources\Catalog\ProductResource\RelationManagers;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Illuminate\Support\Str;


class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationGroup = 'Catalog';

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
                        ->image()
                        ->maxSize(2048)
                        ->optimize('webp')
                        ->directory('product')
                        ->getUploadedFileNameForStorageUsing(
                            fn (TemporaryUploadedFile $file): string => (string) str($file->getClientOriginalName())
                                ->prepend('product-('),
                        ),

                    TextInput::make('price')
                        ->required()
                        ->numeric()
                        ->currencyMask(thousandSeparator: '.', decimalSeparator: ',', precision: 2)
                        ->step(1),

                    TextInput::make('discount')
                        ->nullable()
                        ->numeric()
                        ->step(1),

                    Select::make('category_id')
                        ->relationship('category', 'name')
                        ->searchable()
                        ->preload()
                        ->native(false),

                    TextInput::make('link')
                        ->required()
                        ->string(),

                    Toggle::make('is_visible')
                        ->label('Visible to customers.')
                        ->default(true),

                    Select::make('flash_sale_id')
                        ->relationship('flash_sale', 'name')
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
            ->recordTitleAttribute('name')
            ->defaultSort('name')
            ->columns([
                TextColumn::make('name')
                    ->sortable(),

                ImageColumn::make('image')
                    ->visibility('public'),

                TextColumn::make('category.name')
                    ->label('Kategori')
                    ->sortable(),

                TextColumn::make('price')
                    ->label('Harga')
                    ->currency('IDR')
                    ->sortable(),

                TextColumn::make('discount')
                    ->label('Diskon'),

                TextColumn::make('total')
                    ->label('Total')
                    ->currency('IDR'),

                IconColumn::make('is_visible')
                    ->label('Visibility')
                    ->toggleable()
                    ->boolean(),

                TextColumn::make('flash_sale.name')
                    ->label('Flash Sale')
                    ->sortable(),

                TextColumn::make('link'),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'view' => Pages\ViewProduct::route('/{record}'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
            // 'index' => Pages\ManageProducts::route('/'),
        ];
    }
}
