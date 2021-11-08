<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tran_id')->unique();
            $table->decimal('amount',8,2)->default(0); //999999
            $table->decimal('previous_balance',8,2)->default(0);
            $table->decimal('current_balance',8,2)->default(0);
            $table->unsignedBigInteger('user_id');
            $table->enum('type',['debit','credit'])->default('debit');
            $table->enum('status',['Failed','Pending','Success'])->default('Pending');
            $table->text('ssl_json')->nullable();
            $table->string('remarks')->nullable();
            $table->timestamps();
      
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wallets');
    }
}
