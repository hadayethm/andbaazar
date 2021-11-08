<?php

namespace App;
use App\User;
use Illuminate\Database\Eloquent\Model;

class WalletAccount extends Model
{
    protected $fillable = ['bank_name','branch_name','account_number','description','type','user_id'];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
