<?php

namespace App\Http\Resources\PlaceOrder;

use Illuminate\Http\Resources\Json\JsonResource;

class UpazilaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'division_id' => $this->division_id,
            'name' => $this->name,
            'bn_name' => $this->bn_name,
            'slug' => $this->slug
        ];
    }
}
