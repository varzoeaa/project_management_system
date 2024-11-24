<?php

namespace App\Filament\Resources\ProjectsResource\Widgets;

use App\Models\Project;
use Filament\Widgets\ChartWidget;

class ProjectStatusChart extends ChartWidget
{
    protected static ?string $heading = 'Projects by Status';

    protected function getData(): array
    {
        // Fetch the count of projects for each status
        $statuses = Project::select('status')
            ->selectRaw('COUNT(*) as count')
            ->groupBy('status')
            ->get();

        // Prepare data for the chart
        $labels = $statuses->pluck('status')->toArray(); // Project statuses
        $values = $statuses->pluck('count')->toArray(); // Counts for each status

        return [
            'datasets' => [
                [
                    'label' => 'Projects',
                    'data' => $values, // Data for the pie chart
                    'backgroundColor' => [
                        '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40',
                    ], // Colors for each status
                ],
            ],
            'labels' => $labels, // Labels for the statuses
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
