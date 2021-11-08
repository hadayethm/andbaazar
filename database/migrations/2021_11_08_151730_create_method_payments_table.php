<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMethodPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('method_payments', function (Blueprint $table) {
            $table->id();
            $table->enum('type',['Bank','Mobile_banking'])->default('Bank');
            $table->string('full_name',200); 
            $table->string('mobile');
            $table->string('account_numbe');
            $table->unsignedBigInteger('bank_id')->nullable();
            $table->unsignedBigInteger('bank_branch_id')->nullable();
            $table->string('address',200);
            $table->text('comment');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            
            $table->foreign('bank_id')->references('id')->on('banks')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('bank_branch_id')->references('id')->on('bank_branches')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('method_payments');
    }
}
