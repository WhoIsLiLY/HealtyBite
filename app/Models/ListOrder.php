<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListOrder extends Model
{
    use HasFactory;
        protected $fillable = [
        'orders_id',
        'menus_id',
        'detail',
        'quantity',
        'subtotal',
    ];
    public $timestamps = true;

    public function order()
    {
        return $this->belongsTo(Order::class, 'orders_id');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menus_id');
    }

    public function addon()
    {
        return $this->belongsTo(Addon::class, 'addons_id');
    }
}
