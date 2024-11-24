<?php

namespace App\Filament\Resources\ProjectAssigneesResource\Pages;

use App\Filament\Resources\ProjectAssigneesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProjectAssignees extends EditRecord
{
    protected static string $resource = ProjectAssigneesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
