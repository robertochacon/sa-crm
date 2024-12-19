<?php

namespace App\Repositories\OrderRepository;

use App\Models\Order;
use App\Repositories\BaseRepository\BaseRepository;
use Illuminate\Support\Facades\Hash;

class OrderRepository extends BaseRepository
{

    public function __construct(Order $order){
        parent::__construct($order);
    }

    public function allOrdersByCompapyId(int $company_id){
        return $this->model->with('user')->where("company_id", $company_id)->get();
    }

}
