<?php

namespace App\Filament\Resources;


use App\Filament\Resources\ClientsResource\Pages;
use App\Filament\Resources\ClientsResource\RelationManagers;
use App\Models\Client;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Infolist;
use Filament\Tables\Actions\ViewAction;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Infolists\Components\TextEntry;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ClientsResource extends Resource
{
    protected static ?string $model = Client::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(Client::getForm());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Client Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->label('Email Address')
                    ->icon('heroicon-o-envelope')
                    ->copyable()
                    ->searchable()
                    ->sortable(),
                TextColumn::make('phone')
                    ->label('Phone Number')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('payment_status')
                    ->label('Payment Status')
                    ->badge()
                    ->colors([
                        'success' => 'paid', 
                        'danger' => 'unpaid', 
                        'warning' => 'partially-paid',
                    ])
                    ->searchable()
                    ->sortable(),
                
            ])
            ->filters([
                SelectFilter::make('payment_status')
                    ->options([
                        'paid' => 'Paid',
                        'unpaid' => 'Unpaid',
                        'partially-paid' => 'Partially Paid',
                    ])
                    ->label('Payment Status'),
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
                Section::make('Client Information')
                    ->columns(2)
                    ->description('Basic information about the client.')
                    ->schema([
                        TextEntry::make('name')
                            ->label('Name'),
                        TextEntry::make('email')
                            ->label('Email'),
                        TextEntry::make('phone')
                            ->label('Phone'),
                        TextEntry::make('payment_status')
                            ->label('Payment Status'),
                    ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClients::route('/'),
            'create' => Pages\CreateClients::route('/create'),
            'view' => Pages\ViewClients::route('/{record}'),
        ];
    }
}
