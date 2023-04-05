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
            $table->longText('owner_name');
            $table->longText('shop_name');
            $table->longText('contact_person_name');
            $table->longText('owner_image');
            $table->longText('recipient_name');
            $table->longText('mobile_no');
            $table->longText('house_no');
            $table->longText('street');
            $table->longText('locality');
            $table->longText('landmark');
            $table->longText('city');
            $table->longText('pin_code');
            $table->longText('id_type');
            $table->longText('id_no');
            $table->longText('government_image');
            $table->longText('licence_type');
            $table->longText('licence_no');
            $table->longText('licence_image');
            $table->boolean('is_approved')->default(0);
            $table->boolean('is_rejected')->default(0);
            $table->longText('rejected_message')->nullable();
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
