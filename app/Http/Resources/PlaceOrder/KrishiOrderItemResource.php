<?php

namespace App\Http\Resources\PlaceOrder;

use Illuminate\Http\Resources\Json\JsonResource;

class KrishiOrderItemResource extends JsonResource
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
            'qty' => $this->qty,
            'unit' => $this->unit,
            'rate' => $this->rate,
            'amount' => $this->amount,
            'user_id' => $this->user_id,
            'order_id' => $this->order_id,
            'shop_id' => $this->shop_id,
            'krishi_product_id' => $this->krishi_product_id,
        ];
    }
}
