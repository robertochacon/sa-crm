<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'id','company_id','category_id','name','description','price','images','status'
    ];

    protected $casts = [
        'images' => 'array',
    ];

    public function category()
    {
    	return $this->belongsTo('App\Models\Category', 'category_id');
    }
}
