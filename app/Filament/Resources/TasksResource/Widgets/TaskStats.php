<?php

namespace App\Filament\Resources\TasksResource\Widgets;

use App\Models\Task;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TaskStats extends BaseWidget
{
    protected function getStats(): array
    {
        // Total Tasks
        $totalTasks = Task::count();

        // Active Tasks
        $activeTasks = Task::where('status', 'active')->count();

        // Overdue Tasks
        $overdueTasks = Task::where('deadline', '<', now())
            ->where('status', '!=', 'done')
            ->count();

        // Tasks on Hold
        $onHoldTasks = Task::where('status', 'on-hold')->count();

        // Tasks by Priority
        $lowPriorityTasks = Task::where('priority', 'low')->count();
        $mediumPriorityTasks = Task::where('priority', 'medium')->count();
        $highPriorityTasks = Task::where('priority', 'high')->count();

        return [
            Stat::make('Total Tasks', $totalTasks)
                ->description('All tasks being managed')
                ->color('primary'),

            Stat::make('Active Tasks', $activeTasks)
                ->description('Currently ongoing tasks')
                ->icon('heroicon-o-check-circle')
                ->color('success'),

            Stat::make('Overdue Tasks', $overdueTasks)
                ->description('Tasks behind schedule')
                ->icon('heroicon-o-clock')
                ->color($overdueTasks > 0 ? 'danger' : 'success'), 

            Stat::make('Tasks on Hold', $onHoldTasks)
                ->description('Paused or delayed tasks')
                ->icon('heroicon-o-pause-circle')
                ->color('warning'),

            Stat::make('Low Priority Tasks', $lowPriorityTasks)
                ->description('Tasks with low urgency')
                ->icon('heroicon-o-hand-thumb-down')
                ->color('info'),

            Stat::make('Medium Priority Tasks', $mediumPriorityTasks)
                ->description('Tasks with medium urgency')
                ->icon('heroicon-o-hand-raised')
                ->color('secondary'),

            Stat::make('High Priority Tasks', $highPriorityTasks)
                ->description('Tasks with high urgency')
                ->icon('heroicon-o-fire')
                ->color('danger'),
        ];
    }
}
