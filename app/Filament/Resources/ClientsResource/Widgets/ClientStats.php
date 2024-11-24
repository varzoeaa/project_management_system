<?php

namespace App\Filament\Resources\ClientsResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Client; 

class ClientStats extends BaseWidget
{
    protected function getStats(): array
    {
        // total clients
        $totalClients = Client::count();

        // clients with unpaid status
        $clientsWithUnpaidStatus = Client::where('payment_status', 'unpaid')->count();

        // top paying client
        $topPayingClient = Client::join('transaction_types', 'clients.id', '=', 'transaction_types.client_id')
            ->join('transactions', 'transaction_types.id', '=', 'transactions.transaction_type_id')
            ->selectRaw('clients.name, SUM(transactions.amount) as total_paid')
            ->groupBy('clients.name')
            ->orderByDesc('total_paid')
            ->first();

        // average payment per client
        $averagePayment = Client::join('transaction_types', 'clients.id', '=', 'transaction_types.client_id')
            ->join('transactions', 'transaction_types.id', '=', 'transactions.transaction_type_id')
            ->selectRaw('AVG(transactions.amount) as avg_payment')
            ->value('avg_payment');

        return [
            Stat::make('Total Clients', $totalClients)
                ->description('All registered clients')
                ->color('primary'),
            
            Stat::make('Unpaid Clients', $clientsWithUnpaidStatus)
                ->description('Clients who did not pay yet')
                ->color($clientsWithUnpaidStatus > 0 ? 'danger' : 'success'),
            
            Stat::make('Top Paying Client', $topPayingClient ? $topPayingClient->name . ' ($' . number_format($topPayingClient->total_paid, 2) . ')' : 'No payments')
                ->description('Client with highest total payments')
                ->color('success'),
            
            Stat::make('Average Payment', '$' . number_format($averagePayment, 2))
                ->description('Average income per client')
                ->color('secondary'),
        ];
    }
}
