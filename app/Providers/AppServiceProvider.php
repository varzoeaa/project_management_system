<?php

namespace App\Providers;

use App\Filament\Resources\TransactionResource\Widgets\IncomeExpenseComparisonChart;
use App\Models\Project;
use App\Models\Task;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Filament\Facades\Filament;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use TomatoPHP\FilamentDocs\Facades\FilamentDocs;
use TomatoPHP\FilamentDocs\Services\Contracts\DocsVar;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Model::unguard();

        Filament::serving(function () {
            // Register navigation groups for Projects and Tasks
            Filament::registerNavigationGroups([
                // Projects Navigation Group
                NavigationGroup::make('Projects')
                    ->icon('heroicon-o-folder')
                    ->items([
                        NavigationItem::make('Project Assignees')
                            ->url('/admin/projects/project-assignees')
                            ->icon('heroicon-o-user'),
                        NavigationItem::make('Project Categories')
                            ->url('/admin/projects/project-categories')
                            ->icon('heroicon-o-tag'),
                        NavigationItem::make('Project Notes')
                            ->url('/admin/projects/project-notes')
                            ->icon('heroicon-o-document-text'),
                    ]),
    
                // Tasks Navigation Group
                NavigationGroup::make('Tasks')
                    ->icon('heroicon-o-clipboard-list')
                    ->items([
                        NavigationItem::make('Task Assignees')
                            ->url('/admin/tasks/task-assignees')
                            ->icon('heroicon-o-user'),
                        NavigationItem::make('Task Categories')
                            ->url('/admin/tasks/task-categories')
                            ->icon('heroicon-o-tag'),
                        NavigationItem::make('Task Notes')
                            ->url('/admin/tasks/task-notes')
                            ->icon('heroicon-o-document-text'),
                    ]),
            ]);
        });


        FilamentDocs::register([
            DocsVar::make('$PROJECT_NAME')
                ->label('Project Title')
                ->model(Project::class)
                ->column('name'),
            DocsVar::make('$PROJECT_DESCRIPTION')
                ->label('Project Description')
                ->model(Project::class)
                ->column('description'),
            DocsVar::make('$PROJECT_START')
                ->label('Project Start Date')
                ->model(Project::class)
                ->column('start_date'),
            DocsVar::make('$PROJECT_END')
                ->label('Project End Date')
                ->model(Project::class)
                ->column('end_date'),
            DocsVar::make('$PROJECT_STATUS')
                ->label('Project Status')
                ->model(Project::class)
                ->column('status'),
            DocsVar::make('$TASK_NAME')
                ->label('Task Title')
                ->model(Task::class)
                ->column('name'),
            DocsVar::make('$TASK_DESCRIPTION')
                ->label('Task Description')
                ->model(Task::class)
                ->column('description'),
            DocsVar::make('$TASK_STATUS')
                ->label('Task Status')
                ->model(Task::class)
                ->column('status'),
            DocsVar::make('$TRANSACTION_AMOUNT')
                ->label('Transaction Amount')
                ->model(Transaction::class)
                ->column('amount'),
            DocsVar::make('$TRANSACTION_DATE')
                ->label('Transaction Date')
                ->model(Transaction::class)
                ->column('transaction_date'),
            DocsVar::make('$TRANSACTION_DESCRIPTION')
                ->label('Transaction Description')
                ->model(Transaction::class)
                ->column('description'),
        ]);
            
    }
}
