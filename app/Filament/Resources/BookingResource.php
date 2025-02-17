<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Models\Booking;
use App\Models\User;
use App\Models\Studio;
use App\Models\RecordingRoom;
use App\Models\MusicEquipment;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Card;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    Select::make('user_id')
                        ->label('Customer')
                        ->relationship('user', 'name')
                        ->required(),
                    Select::make('studio_id')
                        ->label('Studio')
                        ->relationship('studio', 'name')
                        ->nullable(),
                    Select::make('recording_room_id')
                        ->label('Ruang Rekaman')
                        ->relationship('recordingRoom', 'name')
                        ->nullable(),
                    Select::make('equipment_id')
                        ->label('Alat Musik')
                        ->relationship('equipment', 'name')
                        ->nullable(),
                    Select::make('status')
                        ->label('Status Booking')
                        ->options([
                            'pending' => 'Pending',
                            'confirmed' => 'Confirmed',
                            'canceled' => 'Canceled',
                        ])
                        ->required(),
                ])
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')->label('Customer')->sortable(),
                TextColumn::make('studio.name')->label('Studio')->sortable(),
                TextColumn::make('recordingRoom.name')->label('Ruang Rekaman')->sortable(),
                TextColumn::make('equipment.name')->label('Alat Musik')->sortable(),
                TextColumn::make('status')->label('Status')->sortable(),
                TextColumn::make('created_at')->label('Dibuat Pada')->dateTime(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Filter Status')
                    ->options([
                        'pending' => 'Pending',
                        'confirmed' => 'Confirmed',
                        'canceled' => 'Canceled',
                    ]),
            ])
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
            'index' => Pages\ListBookings::route('/'),
            'create' => Pages\CreateBooking::route('/create'),
            'edit' => Pages\EditBooking::route('/{record}/edit'),
        ];
    }
}
