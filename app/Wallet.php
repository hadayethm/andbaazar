<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Wallet extends Model{
    protected $fillable = [
        'id',
        'tran_id',
        'amount',
        'previous_balance',
        'current_balance',
        'user_id',
        'type',
        'status',
        'ssl_json',
        'remarks',
    ];

    public function customer(){
        return $this->belongsTo(User::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
