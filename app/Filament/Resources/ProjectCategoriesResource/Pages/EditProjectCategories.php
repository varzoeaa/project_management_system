<?php

namespace App\Filament\Resources\ProjectCategoriesResource\Pages;

use App\Filament\Resources\ProjectCategoriesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProjectCategories extends EditRecord
{
    protected static string $resource = ProjectCategoriesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
