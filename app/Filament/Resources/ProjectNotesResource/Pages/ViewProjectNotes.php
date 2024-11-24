<?php

namespace App\Filament\Resources\ProjectNotesResource\Pages;

use App\Filament\Resources\ProjectNotesResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewProjectNotes extends ViewRecord
{
    protected static string $resource = ProjectNotesResource::class;

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
