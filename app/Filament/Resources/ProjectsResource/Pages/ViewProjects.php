<?php

namespace App\Filament\Resources\ProjectsResource\Pages;

use App\Filament\Resources\ProjectsResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Parallax\FilamentComments\Actions\CommentsAction;

class ViewProjects extends ViewRecord
{
    protected static string $resource = ProjectsResource::class;

    public function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()
                    ->label('Edit Project')
                    ->icon('heroicon-o-pencil-square')
                    ->slideover(),
        ];
    }
}
