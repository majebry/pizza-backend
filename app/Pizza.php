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
        $imagePath = 'images/' . $this->image_path;

        if (request()->secure()) {
            return secure_url($imagePath);
        }

        return url($imagePath);
    }

    public function getPriceInUsdAttribute()
    {
        return number_format($this->price_in_euro * 1.08, 2);
    }
}
