<?php

namespace App\Filament\Resources;

use App\Filament\Clusters\TasksCluster;
use App\Filament\Resources\TaskNotesResource\Pages;
use App\Filament\Resources\TaskNotesResource\RelationManagers;
use App\Models\TaskNote;
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

class TaskNotesResource extends Resource
{
    protected static ?string $model = TaskNote::class;

    protected static bool $shouldRegisterNavigation = false;

    public function isReadOnly(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema(TaskNote::getForm());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('task.name')
                    ->label('Task Name')
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
                Section::make('Task Information')
                    ->columns(1)
                    ->description('Click the task name to view more details.')
                    ->schema([
                        TextEntry::make('task.name')
                        ->label('Task Name')
                        ->url(fn ($record) => $record->task)
                        ->openUrlInNewTab()
                        ->columnSpanFull(),
                ]),
            ]);
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTaskNotes::route('/'),
            'create' => Pages\CreateTaskNotes::route('/create'),
            'edit' => Pages\EditTaskNotes::route('/{record}/edit'),
        ];
    }
}
