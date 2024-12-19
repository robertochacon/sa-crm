<?php

namespace App\Filament\Resources\OrdersResource\Pages;

use App\Filament\Resources\OrdersResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateOrders extends CreateRecord
{
    protected static string $resource = OrdersResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['company_id'] = auth()->user()->company_id;
        $data['user_id'] = auth()->user()->id;

        if (isset($data['products']) && is_array($data['products'])) {
            foreach ($data['products'] as &$product) {
                unset($product['product_options']); // Eliminar product_options de cada producto
                unset($product['product_id']); // Eliminar product_options de cada producto
            }
        }

        return $data;
    }
}
