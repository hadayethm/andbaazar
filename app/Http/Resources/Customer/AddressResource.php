<?php

namespace App\Http\Resources\Customer;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
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
            'id'                => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->first_name,
            'mobile_number' => $this->phone,
            'email' => $this->email,
            'house_number' => $this->house_number,
            'floor_number' => $this->floor_number,
            'street_address' => $this->street_address,
            'postal_code'       => $this->postal_code, 
            'note' => $this->note, 
            'address_type'      => $this->address_type,
            // 'division_id'       => $this->division_id,
            // 'division_name'     => $this->division->name,
            // 'district_name'     => $this->district->name,
            // 'district_id'       => $this->district_id,
            // 'upazila_id'        => $this->upazila_id,
            // 'union_id'          => $this->union_id,
            // 'zip_code'          => $this->zip_code,
            // 'address'           => $this->address,
            // 'name'              => $this->name,  
            // 'is_default_shipping'=> $this->is_default_shipping,
            // 'is_default_billing'=> $this->is_default_billing,  
        ];
    }
}
