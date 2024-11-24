<?php

namespace App\Filament\Resources\ProjectAssigneesResource\Pages;

use App\Filament\Resources\ProjectAssigneesResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewProjectAssignees extends ViewRecord
{
    protected static string $resource = ProjectAssigneesResource::class;

    public function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()
                    ->label('Edit')
                    ->icon('heroicon-o-pencil-square')
                    ->slideover(),
        ];
    }
}
