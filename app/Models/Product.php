<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    protected $casts = [
        'gallery' => 'array',
    ];



    public function reviews()
    {
        return $this->hasMany(ProductReview::class);
    }
}
