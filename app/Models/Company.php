<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'companies';

    protected $fillable = [
        'plan_id',
        'full_name',
        'short_name',
        'rnc',
        'website',
        'phone',
        'address',
        'logo',
        'color',
        'tables',
        'status',

    ];

    public function users()
    {
    	return $this->hasMany('App\Models\User', 'company_id');
    }

    public function categories()
    {
    	return $this->hasMany('App\Models\Category', 'company_id');
    }

    public function products()
    {
    	return $this->hasMany('App\Models\Product', 'company_id');
    }

    public function plan()
    {
    	return $this->belongsTo('App\Models\Plan', 'plan_id');
    }
}
