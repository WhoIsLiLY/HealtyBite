<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodTag extends Model
{
    use HasFactory;

    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'menus_has_food_tags', 'food_tags_id', 'menus_id');
    }
}
