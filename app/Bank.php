<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $fillable = [
        'name',
        'description',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function bankbranch(){
        return $this->hasMany(BankBranch::class);
    }

    public function method(){
        return $this->hasOne(MethodPayment::class);
    }
}
