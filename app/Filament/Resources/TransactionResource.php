<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransactionRelationManagerResource\RelationManagers\TypeRelationManager;
use App\Filament\Resources\TransactionResource\Pages;
use App\Filament\Resources\TransactionResource\RelationManagers;
use App\Filament\Resources\TransactionResource\Widgets\TransactionStats;
use App\Models\Transaction;
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

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(Transaction::getForm());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('transactionType.type_name')
                    ->searchable()
                    ->label('Transaction Type')
                    ->sortable(),
                TextColumn::make('amount')
                    ->numeric()
                    ->label('Amount')
                    ->sortable(),
                Tables\Columns\TextColumn::make('transaction_date')
                    ->date('Y-m-d')
                    ->label('Transaction Date')
                    ->sortable(),
            ])
            ->filters([
            Tables\Filters\Filter::make('Amount Range: 0 - 10,000')
                ->query(fn (Builder $query) => $query->whereBetween('amount', [0, 10000]))
                ->label('0 - 10,000'),

            Tables\Filters\Filter::make('Amount Range: 10,001 - 100,000')
                ->query(fn (Builder $query) => $query->whereBetween('amount', [10001, 100000]))
                ->label('10,001 - 100,000'),

            Tables\Filters\Filter::make('Amount Range: 100,001 and above')
                ->query(fn (Builder $query) => $query->where('amount', '>', 100000))
                ->label('100,001 and above'),
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
            TypeRelationManager::class,
        ];
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Transaction Details')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('description')
                            ->label('Description'),
                        TextEntry::make('amount')
                            ->label('Amount'),
                        TextEntry::make('transaction_date')
                            ->label('Transaction Date')
                            ->columnSpanFull(),
                    ]),
                Section::make('More Information')
                    ->columns(1)
                    ->description('Click the type name to view more details.')
                    ->schema([
                        TextEntry::make('transactionType.type_name')
                        ->label('Transaction Type')
                        ->url(fn ($record) => $record->transaction_type)
                        ->openUrlInNewTab()
                        ->columnSpanFull(),
                ]),
            ]);
    }

    public static function getWidgets(): array
    {
        return [
            TransactionStats::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTransactions::route('/'),
            'create' => Pages\CreateTransaction::route('/create'),
            'view' => Pages\ViewTransaction::route('/{record}'),
        ];
    }
}
