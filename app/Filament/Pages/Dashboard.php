<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\StatsOverview;
use Filament\Pages\Dashboard as BasePage;

class Dashboard extends BasePage
{
    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static ?string $navigationLabel = 'لوحة التحكم';


    protected static ?string $title = 'لوحة التحكم';

    protected static ?int $navigationSort = 1;

    protected function getHeaderWidgets(): array
    {
        return [
            // StatsOverview::class,
        ];
    }
} 