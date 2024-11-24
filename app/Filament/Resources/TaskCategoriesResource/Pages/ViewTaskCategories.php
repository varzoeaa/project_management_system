<?php

namespace App\Filament\Resources\TaskCategoriesResource\Pages;

use App\Filament\Resources\TaskCategoriesResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTaskCategories extends ViewRecord
{
    protected static string $resource = TaskCategoriesResource::class;

    public function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()
                    ->label('Edit Ctegory')
                    ->icon('heroicon-o-pencil-square')
                    ->slideover(),
        ];
    }
}
