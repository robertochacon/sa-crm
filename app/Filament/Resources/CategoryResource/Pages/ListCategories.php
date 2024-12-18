<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use App\Filament\Resources\CategoryResource;
use App\Models\Category;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListCategories extends ListRecords
{
    protected static string $resource = CategoryResource::class;

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
                ->badge(Category::query()->count()),
            'Activos' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', true))
                ->badge(Category::query()->where('status', true)->count()),
            'Inactivos' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', false))
                ->badge(Category::query()->where('status', false)->count()),
        ];
    }

    protected function getTableQuery(): Builder
    {
        return parent::getTableQuery()
            ->where('company_id', auth()->user()->company_id);
    }
}
