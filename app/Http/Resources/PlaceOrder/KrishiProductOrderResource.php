<?php

namespace App\Http\Resources\PlaceOrder;

use Illuminate\Http\Resources\Json\JsonResource;

class KrishiProductOrderResource extends JsonResource
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
            'customer_id' => $this->customer_id,
            'order_number' => $this->order_number,
            'customer_billing_address_id' => $this->customer_billing_address_id,
            'shipping_method_id' => $this->shipping_method_id,
            'subtotal' => $this->subtotal,
            'shipping_charge' => $this->shipping_charge,
            'grand_total' => $this->grand_total,
            'order_type' => $this->order_type,
            'status' => $this->status,  
            'krishiOrderItem' => KrishiOrderItemResource::collection($this->krishiorderitem)
        ];
    }
}
