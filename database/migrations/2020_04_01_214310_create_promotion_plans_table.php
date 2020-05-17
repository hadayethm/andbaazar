<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotion_plans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('from_price',8,0);
            $table->decimal('to_price',8,0);
            $table->decimal('amount',8,0);
            $table->string('slug')->nullable();
            $table->enum('is_free_shipping',['Yes','No'])->default('No');
            $table->boolean('active')->default(1)->change();
            $table->unsignedBigInteger('promotion_id');
            $table->unsignedBigInteger('user_id');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('promotion_id')->references('id')->on('promotions')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('promotion_plans');
    }
}
