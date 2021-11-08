<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
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
            'type' => $this->type,
            'full_name' => $this->full_name,
            'mobile' => $this->mobile,
            'account_numbe' => $this->account_numbe,
            'bank_id' => $this->bank_id,
            'bank_branch_id' => $this->bank_branch_id,
            'address' => $this->address,
            'comment' => $this->comment,
        ];
    }
}
