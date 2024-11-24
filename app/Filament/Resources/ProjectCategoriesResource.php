<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectCategoriesResource\Pages;
use App\Filament\Clusters\ProjectsCluster;
use App\Filament\Resources\ProjectCategoriesResource\RelationManagers;
use App\Models\ProjectCategory;
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

class ProjectCategoriesResource extends Resource
{
    protected static ?string $model = ProjectCategory::class;

    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema(ProjectCategory::getForm());
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
                    ->searchable()
                    ->sortable(),
                TextColumn::make('description')
                    ->searchable()
                    ->sortable()
                    ->limit(10),
                
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
                    ->description('Description of the project category.')
                    ->schema([
                        TextEntry::make('name')
                            ->label('Project Name'),
                        TextEntry::make('description')
                            ->label('Description'),
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
            'index' => Pages\ListProjectCategories::route('/'),
            'create' => Pages\CreateProjectCategories::route('/create'),
            'view ' => Pages\ViewProjectCategories::route('/{record}'),
        ];
    }
}
