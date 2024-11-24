<?php

namespace App\Filament\Resources\TransactionTypeResource\Pages;

use App\Filament\Resources\TransactionTypeResource;
use Filament\Actions;
use Filament\Pages\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewTransactionType extends ViewRecord
{
    protected static string $resource = TransactionTypeResource::class;

    public function getHeaderActions(): array
    {
        return [
            EditAction::make()
                    ->label('Edit')
                    ->icon('heroicon-o-pencil-square')
                    ->slideover(),
        ];
    }
}
