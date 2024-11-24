<?php

namespace App\Filament\Resources;

use App\Filament\Clusters\TasksCluster;
use App\Filament\Resources\TaskAssigneesRelationManagerResource\RelationManagers\AssigneesRelationManager;
use App\Filament\Resources\TaskCategoriesRelationManagerResource\RelationManagers\CategoriesRelationManager;
use App\Filament\Resources\TaskNotesRelationManagerResource\RelationManagers\NotesRelationManager;
use App\Filament\Resources\TasksResource\Pages;
use App\Filament\Resources\TasksResource\RelationManagers;
use App\Filament\Resources\TasksResource\Widgets\TaskStats;
use App\Models\Task;
use Date;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Parallax\FilamentComments\Infolists\Components\CommentsEntry;

class TasksResource extends Resource
{
    protected static ?string $model = Task::class;

    protected static ?string $navigationIcon = 'heroicon-o-circle-stack';


    public static function form(Form $form): Form
    {
        return $form
            ->schema(Task::getForm());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('project.name')
                    ->label('Project Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('name')
                    ->label('Task Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('priority')
                    ->label('Priority')
                    ->badge()
                    ->colors([
                        'success' => 'high',
                        'warning' => 'medium',
                        'danger' => 'low',
                    ])
                    ->searchable()
                    ->sortable(),
                TextColumn::make('deadline')
                    ->label('Deadline')
                    ->date('Y-m-d')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('priority')
                    ->options([
                        'high' => 'High',
                        'medium' => 'Medium',
                        'low' => 'Low',
                    ])
                    ->label('Priority'),
                SelectFilter::make('status')
                    ->options([
                        'active' => 'Active',
                        'done' => 'Done',
                        'on-hold' => 'On Hold',
                        'overdue' => 'Overdue',
                    ])
                    ->label('Status'),
            ])
            ->actions([
                ViewAction::make()
                    ->icon('heroicon-o-eye'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            AssigneesRelationManager::class,
            CategoriesRelationManager::class,
            NotesRelationManager::class,
        ];
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Task Information')
                    ->columns(2)
                    ->description('Basic information about the task.')
                    ->schema([
                        TextEntry::make('name')
                            ->label('Task Name'),
                        TextEntry::make('description')
                            ->label('Description'),
                        TextEntry::make('priority')
                            ->label('Priority'),
                        TextEntry::make('deadline')
                            ->label('Deadline'),
                        TextEntry::make('status')
                            ->label('Status')
                            ->columnSpanFull(),
                    ]),
                Section::make('Project Information')
                    ->columns(1)
                    ->description('Click the project name to view more details.')
                    ->schema([
                        TextEntry::make('project.name')
                        ->label('Project Name')
                        ->url(fn ($record) => $record->project)
                        ->openUrlInNewTab()
                        ->columnSpanFull(),
                ]),
                CommentsEntry::make('filament_comments')
                    ->label('Comments')
                    ->columnSpanFull(),
            ]);
    }

    public static function getWidgets(): array
    {
        return [
            TaskStats::make(),
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTasks::route('/'),
            'create' => Pages\CreateTasks::route('/create'),
            'view' => Pages\ViewTasks::route('/{record}'),
            
        ];
    }
}
