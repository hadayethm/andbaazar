<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->references('id')->onDelete('cascade')->comment('as customer id');
            $table->foreignId('division_id')->nullable()->constrained('divisions')->references('id')->onDelete('cascade');
            $table->integer('district_id')->nullable()->constrained('districts')->references('id')->onDelete('cascade');
            $table->unsignedBigInteger('upazila_id')->nullable();
            $table->unsignedBigInteger('union_id')->nullable();
            $table->unsignedBigInteger('village_id')->nullable();
            $table->integer('zip_code')->nullable();
            $table->text('address')->nullable();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->enum('address_type',['Home','Office'])->default('Home');
            $table->boolean('is_default_shipping')->default(1)->comment('1 for allowed, 0 for not allowed');
            $table->boolean('is_default_billing')->default(1)->comment('1 for allowed, 0 for not allowed');
            $table->timestamps();
            $table->foreign('upazila_id')->references('id')->on('upazilas')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('union_id')->references('id')->on('unions')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('village_id')->references('id')->on('villages')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_addresses');
    }
}
