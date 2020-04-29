<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    protected $fillable = [
        'delivery_cost', 'currency'
    ];

    protected $appends = [
        'total_price', 'created_at_string'
    ];

    public function items()
    {
        return $this->hasMany('App\OrderItem');
    }

    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    public function getTotalPriceAttribute()
    {
        return $this->items()->sum(DB::raw('sold_price * quantity'))
            + $this->delivery_cost;
    }

    public function getCreatedAtStringAttribute()
    {
        return $this->created_at->toDateTimeString();
    }
}
