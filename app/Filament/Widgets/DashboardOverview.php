<?php

namespace App\Filament\Widgets;

use App\Models\Company;
use App\Models\Plan;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $companies = Company::get()->count();
        $plans = Plan::get()->count();

        return [
            Stat::make('Empresas', $companies)
                ->description('Total de empresas registras')
                ->descriptionIcon('heroicon-m-users')
                ->color('warning')
                ->chart([1,1]),
            Stat::make('Planes', $plans)
                ->description('Total de planes registrados')
                ->descriptionIcon('heroicon-m-clipboard-document-list')
                ->color('warning')
                ->chart([1,1]),
            Stat::make('Total de pagos', 0)
                ->description('Total de pagos del mes')
                ->descriptionIcon('heroicon-m-currency-dollar')
                // ->url("payments_report")
                // ->openUrlInNewTab()
                ->color('#fd3232')
                ->chart([1,1]),
        ];
    }

    // public static function canView(): bool
    // {
    //     return auth()->user()->isAdmin();
    // }
}
