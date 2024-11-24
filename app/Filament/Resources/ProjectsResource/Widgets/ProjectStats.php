<?php

namespace App\Filament\Resources\ProjectsResource\Widgets;

use App\Models\Project;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ProjectStats extends BaseWidget
{
    protected function getStats(): array
    {
        // total projects
        $totalProjects = Project::count();

        // active projects
        $activeProjects = Project::where('status', 'active')->count();

        // overdue projects
        $overdueProjects = Project::where('end_date', '<', now())
            ->where('status', '!=', 'done')
            ->count();

        // projects on hold
        $onHoldProjects = Project::where('status', 'on-hold')->count();

        return [
            Stat::make('Total Projects', $totalProjects)
                ->description('All projects being managed')
                ->color('primary'),

            Stat::make('Active Projects', $activeProjects)
                ->description('Currently ongoing projects')
                ->color('success'),

            Stat::make('Overdue Projects', $overdueProjects)
                ->description('Projects behind schedule')
                ->color($overdueProjects > 0 ? 'danger' : 'success'), // highlight if there are overdue projects

            Stat::make('Projects on Hold', $onHoldProjects)
                ->description('Paused or delayed projects')
                ->color('warning'),
        ];
    }
}
