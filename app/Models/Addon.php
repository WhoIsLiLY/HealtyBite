<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addon extends Model
{
    use HasFactory;

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function listOrders()
    {
        return $this->hasMany(ListOrder::class, 'addons_id');
    }
}
