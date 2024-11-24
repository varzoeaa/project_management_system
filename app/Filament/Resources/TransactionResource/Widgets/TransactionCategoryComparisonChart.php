<?php

namespace App\Filament\Resources\TransactionResource\Widgets;

use App\Models\Transaction;
use Filament\Widgets\ChartWidget;

class TransactionCategoryComparisonChart extends ChartWidget
{
    protected static ?string $heading = 'Transaction Amounts by Category';

    protected function getData(): array
    {
        // Query to calculate total amounts grouped by category
        $data = Transaction::selectRaw('
                transaction_types.category as category,
                SUM(CASE WHEN transaction_types.type_name = "income" THEN transactions.amount ELSE 0 END) as income,
                SUM(CASE WHEN transaction_types.type_name = "expense" THEN transactions.amount ELSE 0 END) as expense
            ')
            ->join('transaction_types', 'transactions.transaction_type_id', '=', 'transaction_types.id')
            ->groupBy('transaction_types.category')
            ->orderBy('transaction_types.category')
            ->get();

        // Prepare data for the chart
        $categories = $data->pluck('category'); // X-axis labels
        $income = $data->pluck('income');       // Income dataset
        $expense = $data->pluck('expense');     // Expense dataset

        return [
            'datasets' => [
                [
                    'label' => 'Income',
                    'data' => $income,
                    'backgroundColor' => 'rgba(54, 162, 235, 0.2)', // Light Blue
                    'borderColor' => 'rgba(54, 162, 235, 1)',       // Dark Blue
                    'borderWidth' => 2,
                ],
                [
                    'label' => 'Expense',
                    'data' => $expense,
                    'backgroundColor' => 'rgba(255, 99, 132, 0.2)', // Light Red
                    'borderColor' => 'rgba(255, 99, 132, 1)',       // Dark Red
                    'borderWidth' => 2,
                ],
            ],
            'labels' => $categories->toArray(), // X-axis labels
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
