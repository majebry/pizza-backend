<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public function orders()
    {
        return $this->hasMany('App\Order');
    }
}
