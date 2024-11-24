<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransactionTypeResource\Pages;
use App\Filament\Resources\TransactionTypeResource\RelationManagers;
use App\Models\TransactionType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TransactionTypeResource extends Resource
{
    protected static ?string $model = TransactionType::class;

    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema(TransactionType::getForm());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('type_name')
                    ->searchable()
                    ->label('Type Name')
                    ->sortable(),
                TextColumn::make('category')
                    ->searchable()
                    ->label('Category'),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTransactionTypes::route('/'),
            'create' => Pages\CreateTransactionType::route('/create'),
            'view' => Pages\ViewTransactionType::route('/{record}'),
        ];
    }
}
