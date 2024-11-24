<?php

namespace App\Filament\Resources\ProjectsResource\Pages;

use App\Filament\Resources\ProjectsResource;
use Filament\Resources\Pages\Page;

class MultiFormCreatePage extends Page
{
    protected static string $resource = ProjectsResource::class;

    protected static string $view = 'filament.resources.projects-resource.pages.multi-form-create-page';
    protected static ?string $navigationIcon = 'heroicon-o-document-add';

    public function submit(): void
    {
        // Handle form submission logic here
        $this->form->getState()['projects']->save();
        $this->form->getState()['project_categories']->save();
        $this->form->getState()['project_notes']->save();
        $this->form->getState()['project_assignees']->save();

        $this->notify('success', 'Data successfully created!');
    }
}
