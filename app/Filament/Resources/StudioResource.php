<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Studio;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use App\Filament\Resources\StudioResource\Pages;

class StudioResource extends Resource
{
    protected static ?string $model = Studio::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-library';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    TextInput::make('name')
                        ->label('Nama Studio')
                        ->required(),
                    Textarea::make('description')
                        ->label('Deskripsi')
                        ->rows(3),
                    TextInput::make('price_per_hour')
                        ->label('Harga per Jam (Rp)')
                        ->prefix('Rp ')
                        ->numeric()
                        ->required(),
                    FileUpload::make('image')
                        ->disk('public')
                        ->directory('studio')
                        ->image()
                        ->required(),
    
                ])
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Nama Studio')->sortable(),
                ImageColumn::make('image')
                    ->label('Image')
                    ->width(100)
                    ->height(100),
                TextColumn::make('price_per_hour')->label('Harga per Jam (Rp)')->sortable(),
                TextColumn::make('created_at')->label('Dibuat Pada')->dateTime(),
            ])
            ->filters([])
            ->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()])
            ->bulkActions([Tables\Actions\DeleteBulkAction::make()]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStudios::route('/'),
            'create' => Pages\CreateStudio::route('/create'),
            'edit' => Pages\EditStudio::route('/{record}/edit'),
        ];
    }
}
