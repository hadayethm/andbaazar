<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankBranch extends Model
{
    protected $fillable = [
        'name',
        'address',
        'bank_id',
        'user_id'
    ];

    public function bank(){
        return $this->belongsTo(Bank::class,'bank_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function method(){
        return $this->hasOne(MethodPayment::class);
    }
}
