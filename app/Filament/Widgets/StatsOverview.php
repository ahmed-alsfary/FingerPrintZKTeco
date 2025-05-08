<?php

namespace App\Filament\Widgets;

use App\Models\Employee;
use App\Models\Fingerprint;
use App\Models\Task;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('إجمالي الموظفين', Employee::count())
                ->description('عدد الموظفين المسجلين')
                ->descriptionIcon('heroicon-o-user-group')
                ->color('success'),

            Stat::make('البصمات المسجلة', Fingerprint::count())
                ->description('عدد البصمات المسجلة في النظام')
                ->descriptionIcon('heroicon-o-finger-print')
                ->color('info'),

            Stat::make('المهام النشطة', Task::where('status', 'in_progress')->count())
                ->description('المهام قيد التنفيذ')
                ->descriptionIcon('heroicon-o-clipboard-document-check')
                ->color('warning'),

            Stat::make('المستخدمون', User::count())
                ->description('إجمالي المستخدمين في النظام')
                ->descriptionIcon('heroicon-o-users')
                ->color('primary'),

            Stat::make('المهام المكتملة', Task::where('status', 'completed')->count())
                ->description('المهام التي تم إنجازها')
                ->descriptionIcon('heroicon-o-check-circle')
                ->color('success'),

            Stat::make('المهام المعلقة', Task::where('status', 'pending')->count())
                ->description('المهام في انتظار التنفيذ')
                ->descriptionIcon('heroicon-o-clock')
                ->color('danger'),
        ];
    }
} 