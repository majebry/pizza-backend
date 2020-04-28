<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'delivery_cost', 'currency'
    ];

    public function items()
    {
        return $this->hasMany('App\OrderItem');
    }
}
