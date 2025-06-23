<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'customers_id',
        'restaurants_id',
        'payment_methods_id',
        'order_type',
        'total_price',
        'status',
    ];
    public $timestamps = true;
    
    public function customer()
    {
        return $this->belongsTo(Customer::class,'customers_id');
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function listOrders()
    {
        return $this->hasMany(ListOrder::class, 'orders_id');
    }
}
