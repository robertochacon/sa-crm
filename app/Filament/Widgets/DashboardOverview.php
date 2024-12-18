<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use App\Models\Company;
use App\Models\Order;
use App\Models\Plan;
use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardOverview extends BaseWidget
{
    protected function getStats(): array
    {
        if (auth()->user()->isAdmin()) {
            return $this->forAdmin();
        }else{
            return $this->forSuscriptor();
        }
    }

    protected function forAdmin(): array
    {
        $companies = Company::get()->count();
        $plans = Plan::get()->count();

        return [
            Stat::make('Empresas', $companies)
                ->description('Total de empresas registras')
                ->descriptionIcon('heroicon-m-users')
                ->color('primary')
                ->chart([1,1]),
            Stat::make('Planes', $plans)
                ->description('Total de planes registrados')
                ->descriptionIcon('heroicon-m-clipboard-document-list')
                ->color('primary')
                ->chart([1,1]),
        ];
    }

    protected function forSuscriptor(): array
    {
        $orders = Order::where('company_id', auth()->user()->company_id)->get()->count();
        $categories = Category::where('company_id', auth()->user()->company_id)->get()->count();
        $products = Product::where('company_id', auth()->user()->company_id)->get()->count();

        return [
            Stat::make('Ordenes', $orders)
                ->description('Total de ordenes registras')
                ->descriptionIcon('heroicon-m-clipboard-document-list')
                ->color('primary')
                ->chart([1,1]),
            Stat::make('Categorias', $categories)
                ->description('Total de categorias registrados')
                ->descriptionIcon('heroicon-m-clipboard-document-list')
                ->color('primary')
                ->chart([1,1]),
            Stat::make('Productos', $products)
                ->description('Total de productos registrados')
                ->descriptionIcon('heroicon-m-clipboard-document-list')
                ->color('primary')
                ->chart([1,1]),
        ];
    }

    // public static function canView(): bool
    // {
    //     return auth()->user()->isAdmin();
    // }
}
