<?php

namespace App\Http\Resources\PlaceOrder;

use Illuminate\Http\Resources\Json\ResourceCollection;

class KrishiOrderListCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'error' => false,
            'msg'   => 'Krishi product found successfully',
            'data' => KrishiOrderListResource::collection($this->collection)
        ];
    }
}
