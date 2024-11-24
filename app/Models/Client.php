<?php

namespace App\Models;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $casts = [
        'payment_status' => 'string',
    ];

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public static function getForm()
    {
        return [
            TextInput::make('name')
                ->label('Name')
                ->required(),
            Textarea::make('description')
                ->label('Description')
                ->required(),
            TextInput::make('email')
                ->label('Email')
                ->required(),
            TextInput::make('phone')
                ->label('Phone')
                ->required(),
            Select::make('payment_status')
                ->label('Payment Status')
                ->options([
                    'paid' => 'Paid',
                    'unpaid' => 'Unpaid',
                    'partially-paid' => 'Partially Paid',
                ])
                ->required(),
        ];
    }
}
