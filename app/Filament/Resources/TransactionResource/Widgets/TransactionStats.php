<?php

namespace App\Filament\Resources\TransactionResource\Widgets;

use App\Models\Transaction;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TransactionStats extends BaseWidget
{

    protected static ?string $pollingInterval = '5s';

    protected function getStats(): array
    {
        // Query Total Income
        $totalIncome = Transaction::join('transaction_types', 'transactions.transaction_type_id', '=', 'transaction_types.id')
            ->where('transaction_types.type_name', 'income')
            ->sum('transactions.amount');

        // Query Total Expense
        $totalExpense = Transaction::join('transaction_types', 'transactions.transaction_type_id', '=', 'transaction_types.id')
            ->where('transaction_types.type_name', 'expense')
            ->sum('transactions.amount');

        // Calculate Net Balance
        $netBalance = $totalIncome - $totalExpense;

        return [
            Stat::make('Total Income', number_format($totalIncome, 2))
                ->description('All incoming transactions')
                ->icon('heroicon-o-arrow-up')
                ->color('success'),
            Stat::make('Total Expense', number_format($totalExpense, 2))
                ->description('All outgoing transactions')
                ->icon('heroicon-o-arrow-down')
                ->color('danger'),
            Stat::make('Net Balance', number_format($netBalance, 2))
                ->description('Income - Expense')
                ->icon('heroicon-o-currency-dollar')
                ->color($netBalance >= 0 ? 'success' : 'danger'),
        ];
    }
}
