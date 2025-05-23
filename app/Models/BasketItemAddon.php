<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BasketItemAddon extends Model
{
    protected $fillable = ['basket_item_id', 'addon_id'];
    public $timestamps = false;
    use HasFactory;

    public function addon(){
        return $this->belongsTo(Addon::class);
    }
}
