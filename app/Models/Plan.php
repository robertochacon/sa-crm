<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
        protected $table = 'plans';

        protected $fillable = [
            'name',
            'frequency_id',
            'support_id',
            'amount',
            'status',
        ];

        public function frequency()
        {
            return $this->belongsTo('App\Models\Frequency', 'frequency_id');
        }

        public function support()
        {
            return $this->belongsTo('App\Models\Support', 'support_id');
        }

}
