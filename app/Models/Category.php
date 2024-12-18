<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'id','company_id','name','icon','status'
    ];

    public function getIconAttribute($value)
    {
        return $value ?? 'https://img.icons8.com/?size=48&id=13982&format=png';
    }
}
