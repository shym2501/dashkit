<?php

namespace App\Filament\Resources\Promotion;

use Filament\Forms;
use Filament\Tables;
use Livewire\Component;
use Filament\Forms\Form;
use App\Models\FreeAsset;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use App\Filament\Resources\Promotion\FreeAssetResource\Pages;
use App\Filament\Resources\Promotion\FreeAssetResource\RelationManagers;

class FreeAssetResource extends Resource
{
    protected static ?string $model = FreeAsset::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $recordTitleAttribute = 'Free Asset';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationGroup = 'Promotion';

    public static function getModelLabel(): string
    {
        return __('crud.freeAssets.itemTitle');
    }

    public static function getPluralModelLabel(): string
    {
        return __('crud.freeAssets.collectionTitle');
    }

    public static function getNavigationLabel(): string
    {
        return __('crud.freeAssets.collectionTitle');
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

                    FileUpload::make('image')
                        ->rules(['image'])
                        ->nullable()
                        ->maxSize(2048)
                        ->image()
                        ->imageEditor()
                        ->imageEditorAspectRatios([null, '16:9', '4:3', '1:1']),

                    TextInput::make('link')
                        ->required()
                        ->url(),
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

                ImageColumn::make('image')->visibility('public'),

                TextColumn::make('link'),
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
            'index' => Pages\ListFreeAssets::route('/'),
            'create' => Pages\CreateFreeAsset::route('/create'),
            'view' => Pages\ViewFreeAsset::route('/{record}'),
            'edit' => Pages\EditFreeAsset::route('/{record}/edit'),
        ];
    }
}
