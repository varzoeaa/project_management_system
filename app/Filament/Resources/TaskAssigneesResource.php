<?php

namespace App\Filament\Resources;

use App\Filament\Clusters\TasksCluster;
use App\Filament\Resources\TaskAssigneesResource\Pages;
use App\Filament\Resources\TaskAssigneesResource\RelationManagers;
use App\Models\TaskAssignee;
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

class TaskAssigneesResource extends Resource
{
    protected static ?string $model = TaskAssignee::class;

    protected static bool $shouldRegisterNavigation = false;

    public function isReadOnly(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema(TaskAssignee::getForm());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('task.name')
                    ->label('Task Name')
                    ->searchable()
                    ->sortable(),
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
                Section::make('Task Assignee Information')
                    ->columns(2)
                    ->description('Click on the task name or assignee name to view more details.')
                    ->schema([
                        TextEntry::make('task.name')
                            ->label('Task Name')
                            ->url(fn ($record) => $record->task)
                            ->openUrlInNewTab(),
                        TextEntry::make('name')
                            ->label('Assignee Name'),
                    ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTaskAssignees::route('/'),
            'create' => Pages\CreateTaskAssignees::route('/create'),
            'view' => Pages\ViewTaskAssignees::route('/{record}'),
        ];
    }
}
