<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BasketItem extends Model
{
    use HasFactory;
    protected $fillable = ['menu_id', 'basket_id', 'quantity', 'note'];
    public $timestamps = false;
    public function addons()
    {
        return $this->hasMany(BasketItemAddon::class);
    }
    public function basket()
    {
        return $this->belongsTo(Basket::class);
    }
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

}
