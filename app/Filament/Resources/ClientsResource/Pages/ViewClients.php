<?php

namespace App\Filament\Resources\ClientsResource\Pages;

use App\Filament\Resources\ClientsResource;
use Filament\Actions;
use Filament\Pages\Actions\ButtonAction;
use Filament\Resources\Pages\ViewRecord;

class ViewClients extends ViewRecord
{
    protected static string $resource = ClientsResource::class;

    public function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()
                    ->label('Edit Client')
                    ->icon('heroicon-o-pencil-square')
                    ->slideover(),
        ];
    }
}
