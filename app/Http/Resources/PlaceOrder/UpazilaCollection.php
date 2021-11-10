<?php

namespace App\Http\Resources\PlaceOrder;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UpazilaCollection extends ResourceCollection
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
            'data' => UpazilaResource::collection($this->collection)
        ];
    }
}
