<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WelletWithdraw extends Model
{
    protected $fillable = [
        'type',
        'user_id',
        'account_id',
        'wallet_id',
        'amount',
        'status'
    ];

    public function account(){
        return $this->belongsTo(WalletAccount::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function wallet(){
        return $this->belongsTo(Wallet::class);
    }
}
