<?php

namespace App\Filament\Resources;

use App\Filament\Clusters\TasksCluster;
use App\Filament\Resources\TaskCategoriesResource\Pages;
use App\Filament\Resources\TaskCategoriesResource\RelationManagers;
use App\Models\TaskCategory;
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

class TaskCategoriesResource extends Resource
{
    protected static ?string $model = TaskCategory::class;

    protected static bool $shouldRegisterNavigation = false;

    public function isReadOnly(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema(TaskCategory::getForm());
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
                    ->label('Category Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('description')
                    ->limit(10)
                    ->label('Description')
                    ->searchable()
                    ->sortable(),
                
            ])
            ->filters([
                //
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
            //
        ];
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Category')
                    ->columns(2)
                    ->description('Description of the task category.')
                    ->schema([
                        TextEntry::make('name')
                            ->label('Task Name'),
                        TextEntry::make('description')
                            ->label('Description'),
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
            'index' => Pages\ListTaskCategories::route('/'),
            'create' => Pages\CreateTaskCategories::route('/create'),
            'view' => Pages\ViewTaskCategories::route('/{record}'),
        ];
    }
}
