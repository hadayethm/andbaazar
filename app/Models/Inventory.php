<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Product;
use App\Models\Color;
use App\Models\Size;
use App\User;
use Illuminate\Support\Facades\DB;
use App\Models\InventoryMeta;

class Inventory extends Model
{
    use SoftDeletes;
    protected $fillable = [
      'product_id',
      'color_id',
      'color_name',
      'slug',
      'qty_stock',
      'price',
      'special_price',
      'start_date',
      'end_date',
      'seller_sku',
      'sort',
      'type',
      'shop_id',
      'available_on',
      'active',
      'user_id',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }


    public function user(){
     return $this->belongsTo(User::class,'user_id');
    }
    public function item(){
      return $this->belongsTo(Product::class,'product_id');
    }
    public function color(){
      return $this->belongsTo(Color::class,'color_id');
    }
    public function size(){
      return $this->belongsTo(Size::class,'size_id');
    }
    public function invenMeta(){
      return $this->hasOne(InventoryMeta::class,'inventory_id');
    }
    

    public static function getInventroyColor($color,$item){
      return DB::table('inventories')
             ->select('color_id')
             ->where('product_id','=',$item)
             ->where('color_id','=',$color)
             ->get();
    }


}
