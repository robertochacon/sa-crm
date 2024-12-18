<?php

namespace App\Filament\Resources\OrdersResource\Pages;

use App\Filament\Resources\OrdersResource;
use App\Models\Order;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListOrders extends ListRecords
{
    protected static string $resource = OrdersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        $statuses = ['Todas', 'Recibida', 'Preparando', 'Completada', 'Facturada', 'Cancelada'];

        return collect($statuses)->mapWithKeys(function ($status) {
            return [
                $status => Tab::make()
                    ->label($status)
                    ->modifyQueryUsing(fn (Builder $query) =>
                        $status === 'Todas' ? $query : $query->where('status', $status)
                    )
                    ->badge($status === 'Todas'
                        ? Order::query()->count()
                        : Order::query()->where('status', $status)->count()
                    ),
            ];
        })->toArray();
    }

    protected function getTableQuery(): Builder
    {
        return parent::getTableQuery()
            ->where('company_id', auth()->user()->company_id);
    }
}
