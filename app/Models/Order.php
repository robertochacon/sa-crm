<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'id','company_id','user_id','products','table','total','extra','note','in_restaurant','status'
    ];

    protected $casts = [
        'products' => 'array',
    ];

    public function user()
    {
    	return $this->belongsTo('App\Models\User', 'user_id');
    }

}
