<?php

namespace App\Filament\Resources\ProductsResource\Pages;

use App\Filament\Resources\ProductsResource;
use App\Models\Product;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListProducts extends ListRecords
{
    protected static string $resource = ProductsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'Todos' => Tab::make()
                ->badge(Product::query()->count()),
            'Activos' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', true))
                ->badge(Product::query()->where('status', true)->count()),
            'Inactivos' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', false))
                ->badge(Product::query()->where('status', false)->count()),
        ];
    }

    protected function getTableQuery(): Builder
    {
        return parent::getTableQuery()
            ->where('company_id', auth()->user()->company_id);
    }
}
