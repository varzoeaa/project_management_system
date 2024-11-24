<?php

namespace App\Filament\Resources\ProjectCategoriesResource\Pages;

use App\Filament\Resources\ProjectCategoriesResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewProjectCategories extends ViewRecord
{
    protected static string $resource = ProjectCategoriesResource::class;

    public function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()
                    ->label('Edit')
                    ->icon('heroicon-o-pencil-square')
                    ->slideover(),
        ];
    }
}
