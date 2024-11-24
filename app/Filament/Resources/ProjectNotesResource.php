<?php

namespace App\Filament\Resources;

use App\Filament\Clusters\ProjectsCluster;
use App\Filament\Resources\ProjectNotesResource\Pages;
use App\Models\ProjectNote;
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

class ProjectNotesResource extends Resource
{
    protected static ?string $model = ProjectNote::class;

    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema(ProjectNote::getForm());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('project.name')
                    ->label('Project Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('title')
                    ->label('Title')
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
                Section::make('Notes')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('title')
                            ->label('Title'),
                        TextEntry::make('text')
                            ->label('Text'),
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
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjectNotes::route('/'),
            'create' => Pages\CreateProjectNotes::route('/create'),
            'view' => Pages\ViewProjectNotes::route('/{record}'),
        ];
    }
}
