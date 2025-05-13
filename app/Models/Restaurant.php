<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Restaurant extends Authenticatable
{
    use HasFactory;

    public function menus()
    {
        return $this->hasMany(Menu::class,'restaurants_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'restaurants_id');
    }

    public function category()
    {
        return $this->belongsTo(RestaurantCategory::class, 'restaurant_categories_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'restaurants_id');
    }
}
