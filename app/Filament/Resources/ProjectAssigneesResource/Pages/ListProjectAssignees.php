<?php

namespace App\Filament\Resources\ProjectAssigneesResource\Pages;

use App\Filament\Resources\ProjectAssigneesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProjectAssignees extends ListRecords
{
    protected static string $resource = ProjectAssigneesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
