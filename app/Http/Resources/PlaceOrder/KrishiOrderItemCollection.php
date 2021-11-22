<?php

namespace App\Http\Resources\PlaceOrder;

use Illuminate\Http\Resources\Json\ResourceCollection;

class KrishiOrderItemCollection extends ResourceCollection
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
            'msg'   => 'success',
            'data' =>KrishiOrderItemResource::collection($this->collection)
        ];
    }
}
