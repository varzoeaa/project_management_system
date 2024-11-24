<?php

namespace App\Models;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionType extends Model
{
    use HasFactory;

    protected $casts = [
        'client_id' => 'integer',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public static function getForm()
    {
        return [
            Select::make('client_id')
                    ->relationship('client', 'name')
                    ->label('Client Name'),
            Select::make('type_name')
                    ->required()
                    ->label('Type Name'),
            TextInput::make('category')
                    ->label('Category'),
            TextInput::make('client_name')
                    ->label('Client Name'),
        ];
    }
}
