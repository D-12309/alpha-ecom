<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_details', function (Blueprint $table) {
            $table->id();
            $table->string('owner_name');
            $table->string('shop_name');
            $table->string('contact_person_name');
            $table->string('owner_image');
            $table->string('recipient_name');
            $table->string('mobile_no');
            $table->string('house_no');
            $table->string('street');
            $table->string('locality');
            $table->string('landmark');
            $table->string('city');
            $table->string('pin_code');
            $table->string('id_type');
            $table->string('id_no');
            $table->string('government_image');
            $table->string('licence_type');
            $table->string('licence_no');
            $table->string('licence_image');
            $table->boolean('is_approved')->default(0);
            $table->boolean('is_rejected')->default(0);
            $table->text('rejected_message')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->string('user_category')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('business_details');
    }
}
