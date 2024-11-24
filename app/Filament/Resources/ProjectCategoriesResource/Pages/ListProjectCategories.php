<?php

namespace App\Filament\Resources\ProjectCategoriesResource\Pages;

use App\Filament\Resources\ProjectCategoriesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProjectCategories extends ListRecords
{
    protected static string $resource = ProjectCategoriesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
