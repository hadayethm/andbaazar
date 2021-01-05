<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Order;
use App\User;

class CustomerBillingAddress extends Model
{
   use SoftDeletes;
   protected $fillable = ['location','slug','address','country','state','city','zip_code','phone','fax','active','customer_id','user_id','deleted_at'];

   public function user()
   {
       return $this->belongsTo(User::class, 'user_id');
   }

    public function buyer(){
     return $this->belongsTo(CustomerProfile::class,'buyer_id');
   }
   public function order(){
     return $this->hasMany(Order::class,'buyer_billing_address_id');
   }
}
