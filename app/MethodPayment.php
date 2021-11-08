<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MethodPayment extends Model
{
    protected $fillable = [
        'type',
        'full_name', 
        'mobile', 
        'account_numbe',
        'bank_id',
        'bank_branch_id',
        'address',
        'comment',
        'user_id'
    ];

    public function bank(){
        return $this->belongsTo(Bank::class,'bank_id');
    }

    public function bankbranch(){
        return $this->belongsTo(BankBranch::class,'bank_branch_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

}
