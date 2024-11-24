<?php

namespace App\Filament\Resources\TransactionResource\Pages;

use App\Filament\Resources\TransactionResource;
use Filament\Actions;
use Filament\Pages\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewTransaction extends ViewRecord
{
    protected static string $resource = TransactionResource::class;

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
