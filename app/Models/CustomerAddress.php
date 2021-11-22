<?php

namespace App\Models;

use App\Models\Geo\District;
use App\Models\Geo\Division;
use App\Models\Geo\Union;
use App\Models\Geo\Upazila;
use App\Models\Geo\Village;
use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'user_id',
        'division_id',
        'district_id',
        'upazila_id',
        'union_id',
        'village_id',
        'zip_code',
        'address',
        'name',
        'phone',
        'address_type',
        'is_default_shipping',
        'is_default_billing',
        'postal_code',
        'email',
        'house_number',
        'floor_number',
        'street_address',
        'note'
    ];

    public function division(){
        return $this->belongsTo(Division::class,'division_id');
    }
    public function district(){
        return $this->belongsTo(District::class,'district_id');
    }
    public function upazila(){
        return $this->belongsTo(Upazila::class,'upazila_id');
    }
    public function union(){
        return $this->belongsTo(Union::class,'union_id');
    }
    public function village(){
        return $this->belongsTo(Village::class,'village_id');
    }
}
