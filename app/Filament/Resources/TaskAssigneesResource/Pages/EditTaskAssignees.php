<?php

namespace App\Filament\Resources\TaskAssigneesResource\Pages;

use App\Filament\Resources\TaskAssigneesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTaskAssignees extends EditRecord
{
    protected static string $resource = TaskAssigneesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
