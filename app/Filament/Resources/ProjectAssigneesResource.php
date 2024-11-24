<?php

namespace App\Filament\Resources;

use App\Filament\Clusters\ProjectsCluster;
use App\Filament\Resources\Projects;
use App\Filament\Resources\ProjectAssigneesResource\Pages;
use App\Filament\Resources\Projects\ProjectAssigneesResource\RelationManagers;
use App\Models\ProjectAssignee;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProjectAssigneesResource extends Resource
{
    protected static ?string $model = ProjectAssignee::class;

    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema(ProjectAssignee::getForm());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('project.name')
                    ->label('Project Name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('name')
                    ->label('Assignee Name')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                ViewAction::make(),
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
            //
        ];
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
        ->schema([
            Section::make('Project Assignee Information')
                ->columns(2)
                ->description('Click on the project name or assignee name to view more details.')
                ->schema([
                    TextEntry::make('project.name')
                        ->label('Project Name')
                        ->url(fn ($record) => $record->project)
                        ->openUrlInNewTab(),
                    TextEntry::make('name')
                        ->label('Assignee Name'),
                ]),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjectAssignees::route('/'),
            'create' => Pages\CreateProjectAssignees::route('/create'),
            'view' => Pages\ViewProjectAssignees::route('/{record}'),
        ];
    }
}
