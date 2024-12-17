<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'id','company_id','products','other_products','table','total','extra','note','in_restaurant','status'
    ];

}
