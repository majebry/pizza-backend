<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Pizza extends Model
{
    protected $appends = [
        'image_link', 'price_in_usd'
    ];

    public function getImageLinkAttribute()
    {
        return url(Storage::url($this->image_path));
    }

    public function getPriceInUsdAttribute()
    {
        return number_format($this->price_in_euro * 1.08, 2);
    }
}
