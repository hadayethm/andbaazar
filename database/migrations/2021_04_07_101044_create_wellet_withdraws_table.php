<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWelletWithdrawsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wellet_withdraws', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('type',['bank','nagod','bkash'])->default('bkash');               
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('account_id');
            $table->unsignedBigInteger('wallet_id')->comment('wallet transaction relation');
            $table->decimal('amount',7,2)->default(0);
            $table->enum('status',['Failed','Pending','Success'])->default('Pending');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('account_id')->references('id')->on('wallet_accounts')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('wallet_id')->references('id')->on('wallets')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wellet_withdraws');
    }
}
