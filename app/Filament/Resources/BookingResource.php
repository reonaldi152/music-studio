<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Models\Booking;
use App\Models\User;
use App\Models\Studio;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\CheckboxList;
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
                        ->required(),

                    Forms\Components\DateTimePicker::make('start_time')
                        ->label('Waktu Mulai')
                        ->required(),

                    Forms\Components\DateTimePicker::make('end_time')
                        ->label('Waktu Selesai')
                        ->required(),

                    Checkbox::make('add_recording')
                        ->label('Tambahkan Rekaman (Rp 200.000)')
                        ->default(false),

                    CheckboxList::make('music_equipment')
                        ->label('Pilih Alat Musik (Rp 50.000 per alat)')
                        ->options([
                            'gitar' => 'Gitar',
                            'ampli' => 'Ampli',
                            'recording' => 'Recording',
                        ])
                        ->columns(2),

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
                TextColumn::make('start_time')->label('Mulai')->dateTime()->sortable(),
                TextColumn::make('end_time')->label('Selesai')->dateTime()->sortable(),
                TextColumn::make('status')->label('Status')->sortable(),
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
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()
            ]);
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
