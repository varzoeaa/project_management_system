<?php

namespace App\Filament\Resources\TasksResource\Pages;

use App\Filament\Resources\TasksResource;
use App\Filament\Resources\TasksResource\Widgets\TaskStats;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTasks extends ListRecords
{
    protected static string $resource = TasksResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            TaskStats::make(),
        ];
    }
}
