<?php

namespace App\Filament\Resources\EmployeeResource\Widgets;
use App\Filament\Resources;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class EmployeeStatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
 
        return [
            Card::make('Unique views', '192.1k'),
            Card::make('Bounce rate', '21%'),
            Card::make('Average time on page', '3:12'),
          
        ];

    }
}
