<?php

namespace App\Filament\Resources\TaskNotesResource\Pages;

use App\Filament\Resources\TaskNotesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTaskNotes extends EditRecord
{
    protected static string $resource = TaskNotesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
