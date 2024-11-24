<?php

namespace App\Filament\Resources\TaskAssigneesResource\Pages;

use App\Filament\Resources\TaskAssigneesResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTaskAssignees extends ViewRecord
{
    protected static string $resource = TaskAssigneesResource::class;

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
