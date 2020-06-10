<?php
namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use App\Models\Buyer;
use App\Models\BuyerBillingAddress;
use App\Models\BuyerCard;
use App\Models\BuyerPayment;
use App\Models\BuyerShippingAddress;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Color;
use App\Models\Courier;
use App\Models\Currency;
use App\Models\Inventory;
use App\Models\Item;
use App\Models\ItemCategory;
use App\Models\ItemImage;
use App\Models\ItemTag;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PaymentMethod;
use App\Models\Permission;
use App\Models\Promotion;
use App\Models\PromotionHead;
use App\Models\PromotionPlan;
use App\Models\PromotionUse;
use App\Models\Review;
use App\Models\Seller;
use App\Models\ShippingMethod;
use App\Models\Size;
use App\Models\Shop;
use App\Models\Tag;
use App\Models\Attribute;
use App\Models\AttributeMeta;
use Sentinel;
use Session;

class Baazar
{
    public function getUniqueSlug($model, $value,$row = "slug")
    {
        $slug = Str::slug($value);
        $slugCount = count($model->whereRaw("{$row} REGEXP '^{$slug}(-[0-9]+)?$' and id != '{$model->id}'")->get());

        return ($slugCount > 0) ? "{$slug}-{$slugCount}" : $slug;
    }

    public function fileUpload($request, $input = 'image', $old = 'old_image', $path = '/uploads',$name = NULL) {
        $request->validate([
            $input => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile($input)) {
            if(!empty($old)){
                if(file_exists(public_path().$old)){
                    unlink(public_path().$old);
                }
            }
            $image = $request->file($input);
            $name = !empty($name) ? $name : time();
            $name = $name.'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path($path);
            $image->move($destinationPath, $name);
            $url =  $path.'/'.$name;
            return $url;
        }
        if(!empty($old)){
            return $request->$old;
        }
        return '';
    } 

   public function insertRecords($data, $parent_id = 0,$parent_slug = 0) {
    //    dd($data);
        foreach($data as $row) {
            $slug = Str::slug($row['0']);
            $data = [
                'name'          => $row['0'],
                'slug'          => $slug,
                'parent_slug'   => $parent_slug,
                'parent_id'     => $parent_id,
                'percentage'    => 2,
                'user_id'       => 1,
                'is_last'       => isset($row["child"]) ? 0 : 1,
            ];
            $cat = Category::create($data);
            if (isset($row["child"])){ 
                $this->insertRecords($row["child"], $cat->id,$slug);
            }else{
                if (isset($row["attr"])){
                    foreach($row['attr'] as $attr){
                        $attributes = [
                            'label'             => $attr['label'],
                            'suggestion'        => isset($attr['suggestion']) ? $attr['suggestion'] : 0,
                            'type'              => $attr['type'],
                            'required'          => isset($attr['required']) ? 1 : 0,
                            'category_id'       => $cat->id,
                        ];
                        $attribute = Attribute::create($attributes);
                        if (isset($attr["meta"])){
                            foreach($attr['meta'] as $meta){
                                $metas = [
                                    'values'        =>  $meta,
                                    'attribute_id'  => $attribute->id,
                                ];
                                AttributeMeta::create($metas);
                            }
                        }
                    }
                } 
            }
        }
    }

    public function short_text($text, $limit){
        return strlen($text) > $limit ? substr($text,0,$limit).".." : $text;
    }
    
}
