<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KrishiOrderItem extends Model
{
    protected $fillable = [
        'krishi_product_id',
        'qty',
        'unit',
        'rate',
        'amount',
        'user_id',
        'order_id',
        'shop_id'
    ];

    public function orderitem(){
        return $this->belongsTo(Order::class,'order_id');
    }
}
