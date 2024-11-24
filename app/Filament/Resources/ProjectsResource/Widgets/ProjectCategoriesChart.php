<?php

namespace App\Filament\Resources\ProjectsResource\Widgets;

use App\Models\ProjectCategory;
use Filament\Widgets\ChartWidget;

class ProjectCategoriesChart extends ChartWidget
{
    protected static ?string $heading = 'Project Categories Distribution';

    protected function getData(): array
    {
        // Fetch the count of projects in each category
        $categories = ProjectCategory::select('name')
            ->selectRaw('COUNT(*) as count')
            ->groupBy('name')
            ->get();

        // Prepare the chart data
        $labels = $categories->pluck('name')->toArray(); // Category names
        $values = $categories->pluck('count')->toArray(); // Counts for each category

        return [
            'datasets' => [
                [
                    'label' => 'Projects',
                    'data' => $values, // Data for each category
                    'backgroundColor' => [
                        '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40',
                    ], // Optional colors for each slice
                ],
            ],
            'labels' => $labels, // Labels for categories
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
