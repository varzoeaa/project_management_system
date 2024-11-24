<?php

namespace App\Filament\Resources\ProjectNotesResource\Pages;

use App\Filament\Resources\ProjectNotesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProjectNotes extends EditRecord
{
    protected static string $resource = ProjectNotesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
