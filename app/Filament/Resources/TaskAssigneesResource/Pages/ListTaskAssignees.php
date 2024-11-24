<?php

namespace App\Filament\Resources\TaskAssigneesResource\Pages;

use App\Filament\Resources\TaskAssigneesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTaskAssignees extends ListRecords
{
    protected static string $resource = TaskAssigneesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
