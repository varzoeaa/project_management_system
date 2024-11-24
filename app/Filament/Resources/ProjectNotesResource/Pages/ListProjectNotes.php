<?php

namespace App\Filament\Resources\ProjectNotesResource\Pages;

use App\Filament\Resources\ProjectNotesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProjectNotes extends ListRecords
{
    protected static string $resource = ProjectNotesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
