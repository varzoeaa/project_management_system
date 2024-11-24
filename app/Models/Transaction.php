<?php

namespace App\Models;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $casts = [
        'transaction_date' => 'date',
    ];

    public function transactionType()
    {
        return $this->belongsTo(TransactionType::class);
    }

    public static function getForm()
    {
        return [
            Select::make('transaction_type_id')
                    ->relationship('type', 'type_name')
                    ->label('Transaction Type')
                    ->required(),
            TextInput::make('amount')
                    ->required()
                    ->label('Amount')
                    ->numeric(),
            Textarea::make('description')
                    ->columnSpanFull(),
            DatePicker::make('transaction_date')
                    ->label('Transaction Date')
                    ->required(),
        ];
    }
}
