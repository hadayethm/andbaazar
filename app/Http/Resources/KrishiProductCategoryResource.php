<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class KrishiProductCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $subCategory = [];
        foreach($this->childs as $i=>$row){
            $subCategory[] = [
                "sub_id" => $row->id,
                "parent_id" => $row->parent_id,
                "sub_name" => $row->name,
                "sub_slug" => $row->slug,
            ];
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'thumbnail_image' => (!is_null($this->thumbnail_image)) ? $this->thumbnail_image : asset('images/avatar-product.png'),
            'subcategory' => $subCategory,
        ];
 
    }
}
