<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Filament\Resources\BookingResource\RelationManagers;
use App\Models\Booking;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static ?string $navigationIcon = 'heroicon-c-calendar-date-range';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('id')->numeric(),
                TextColumn::make('name')->label('Booked By'),
                TextColumn::make('room.title')->label('Room'),
                TextColumn::make('date_from')->date()->sortable()->label('Check In'),
                TextColumn::make('date_to')->date()->sortable()->label('Check Out'),
                TextColumn::make('total_price')->money('eur', true),
            ])
            ->filters([
                //
            ])
            ->actions([
                ViewAction::make()
                    ->form([
                        TextInput::make('id')->integer(),
                        TextInput::make('date_from'),
                        TextInput::make('date_to'),
                        TextInput::make('name'),
                        TextInput::make('email'),
                        TextInput::make('total_price'),
                    ]),
                // Tables\Actions\EditAction::make(),
                // Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageBookings::route('/'),
        ];
    }
}
