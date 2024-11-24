<?php

namespace App\Filament\Resources\TaskNotesResource\Pages;

use App\Filament\Resources\TaskNotesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTaskNotes extends ListRecords
{
    protected static string $resource = TaskNotesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
