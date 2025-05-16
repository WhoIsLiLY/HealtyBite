<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function listOrders()
    {
        return $this->hasMany(ListOrder::class, 'menus_id');
    }

    public function addons()
    {
        return $this->hasMany(Addon::class);
    }

    public function foodTags()
    {
        return $this->belongsToMany(FoodTag::class, 'menus_has_food_tags', 'menus_id', 'food_tags_id');
    }
}
