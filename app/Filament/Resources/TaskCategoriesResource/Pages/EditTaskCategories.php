<?php

namespace App\Filament\Resources\TaskCategoriesResource\Pages;

use App\Filament\Resources\TaskCategoriesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTaskCategories extends EditRecord
{
    protected static string $resource = TaskCategoriesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
