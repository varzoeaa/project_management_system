<?php

namespace App\Filament\Resources\TaskNotesResource\Pages;

use App\Filament\Resources\TaskNotesResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTaskNotes extends ViewRecord
{
    protected static string $resource = TaskNotesResource::class;

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
