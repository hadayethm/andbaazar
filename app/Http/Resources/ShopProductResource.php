<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ShopProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $shopProduct = [];
        foreach($this->krishiproduct as $row){
            $shopProduct[] = [
                'id' => $row->id,
                'name' => $row->name, 
                'slug' => $row->slug,
                'thumbnail_image' => $row->thumbnail_image, 
                'price' => $row->price,
                'flash_sale_discount_rate' => $row->flash_sale_discount_rate,
                'category_name'=>$row->category->name 
            ];
        }
        return [
            'id' => $this->id,
            'name' => $this->name, 
            'slug' => $this->slug, 
            'krishiproduct' => $shopProduct
        ];
    }
}
