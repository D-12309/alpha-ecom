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
            $table->text('owner_name');
            $table->text('shop_name');
            $table->text('contact_person_name');
            $table->text('owner_image');
            $table->text('recipient_name');
            $table->text('mobile_no');
            $table->text('house_no');
            $table->text('street');
            $table->text('locality');
            $table->text('landmark');
            $table->text('city');
            $table->text('pin_code');
            $table->text('id_type');
            $table->text('id_no');
            $table->text('government_image');
            $table->text('licence_type');
            $table->text('licence_no');
            $table->text('licence_image');
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
