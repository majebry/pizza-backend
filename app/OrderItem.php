<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'sold_price', 'quantity', 'pizza_id'
    ];

    public function pizza()
    {
        return $this->belongsTo('App\Pizza');
    }
}
