<?php

namespace App\Filament\Resources;

use App\Filament\Clusters\ProjectsCluster;
use App\Filament\Resources\ProjectAssigneesRelationManagerResource\RelationManagers\AssigneesRelationManager;
use App\Filament\Resources\ProjectCategoryRelationManagerResource\RelationManagers\ProjectRelationManager;
use App\Filament\Resources\ProjectNotesRelationManagerResource\RelationManagers\NotesRelationManager;
use App\Filament\Resources\ProjectsResource\Pages;
use App\Filament\Resources\Projects\ProjectsResource\RelationManagers;
use App\Filament\Resources\ProjectsResource\Widgets\ProjectStats;
use App\Models\Project;
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

class ProjectsResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-square-2-stack';


    public static function form(Form $form): Form
    {
        return $form
            ->schema(Project::getForm());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('client.name')
                    ->label('Client Name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('name')
                    ->label('Project Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('description')
                    ->label('Project Description')
                    ->searchable()
                    ->limit(10)
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Project Status')
                    ->badge()
                    ->colors([
                        'success' => 'done',
                        'warning' => 'inactive',
                        'danger' => 'overdue',
                        'info' => 'on-hold',
                        'primary' => 'active',
                    ])
                    ->searchable()
                    ->sortable(),
                
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'active' => 'Active',
                        'done' => 'Done',
                        'inactive' => 'Inactive',
                        'overdue' => 'Overdue',
                        'on-hold' => 'On Hold',
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
            ProjectRelationManager::class,
            NotesRelationManager::class,
        ];
    }

    public static function getWidgets(): array
    {
        return [
            ProjectStats::make(),
        ];
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Project Information')
                    ->columns(2)
                    ->description('Basic information about the project.')
                    ->schema([
                        TextEntry::make('name')
                            ->label('Project Name'),
                        TextEntry::make('description')
                            ->label('Description'),
                        TextEntry::make('strat_date')
                            ->label('Start Date'),
                        TextEntry::make('end_date')
                            ->label('End Date'),
                        TextEntry::make('status')
                            ->label('Status')
                            ->columnSpanFull(),
                    ]),
                Section::make('Client Information')
                    ->columns(1)
                    ->description('Click the client name to view more details.')
                    ->schema([
                        TextEntry::make('client.name')
                        ->label('Client Name')
                        ->url(fn ($record) => $record->client)
                        ->openUrlInNewTab()
                        ->columnSpanFull(),
                ]),
                CommentsEntry::make('filament_comments')
                    ->label('Comments')
                    ->columnSpanFull(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProjects::route('/create'),
            'view' => Pages\ViewProjects::route('/{record}'),
        ];
    }
}
