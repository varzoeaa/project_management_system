<?php

namespace App\Filament\Resources\TransactionResource\Widgets;

use App\Models\Transaction;
use Filament\Widgets\ChartWidget;

class IncomeExpenseComparisonChart extends ChartWidget
{
    protected static ?string $pollingInterval = '10s'; 
    protected static ?string $heading = 'Income vs Expense Comparison';

    protected function getData(): array
    {
        // Query Income and Expenses grouped by Month
        $data = Transaction::selectRaw("
                MONTH(transaction_date) as month, 
                SUM(CASE WHEN transaction_types.type_name = 'income' THEN amount ELSE 0 END) as income,
                SUM(CASE WHEN transaction_types.type_name = 'expense' THEN amount ELSE 0 END) as expense
            ")
            ->join('transaction_types', 'transactions.transaction_type_id', '=', 'transaction_types.id')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Prepare Data for the Chart
        $months = $data->pluck('month')->map(fn ($month) => date('F', mktime(0, 0, 0, $month, 10))); // Convert month numbers to names
        $income = $data->pluck('income');
        $expense = $data->pluck('expense');

        return [
            'datasets' => [
                [
                    'label' => 'Income',
                    'data' => $income,
                    'backgroundColor' => 'rgba(54, 162, 235, 0.2)', // Light Blue
                    'borderColor' => 'rgba(54, 162, 235, 1)', // Dark Blue
                    'borderWidth' => 2,
                ],
                [
                    'label' => 'Expense',
                    'data' => $expense,
                    'backgroundColor' => 'rgba(255, 99, 132, 0.2)', // Light Red
                    'borderColor' => 'rgba(255, 99, 132, 1)', // Dark Red
                    'borderWidth' => 2,
                ],
            ],
            'labels' => $months->toArray(), // X-Axis labels (Months)
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
