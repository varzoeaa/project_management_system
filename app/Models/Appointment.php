<?php

namespace App\Models;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    
    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    public static function getForm()
    {
        return [
            TextInput::make('title')
                ->label('Title')
                ->required(),
            TextInput::make('description')
                ->label('Description'),
            DateTimePicker::make('start_time')
                ->label('Start Time')
                ->required(),
            DateTimePicker::make('end_time')
                ->label('End Time')
                ->required(),
            TextInput::make('location')
                ->label('Location')
                ->required(),
            Select::make('status')
                ->label('Status')
                ->options([
                    'pending' => 'Pending',
                    'confirmed' => 'Confirmed',
                    'cancelled' => 'Canceled',
                ])
                ->required(),
            
            
        ];
    }
}
