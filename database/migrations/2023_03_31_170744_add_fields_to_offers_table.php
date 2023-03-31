<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('offers', function (Blueprint $table) {
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->integer('min_amount')->nullable();
            $table->integer('min_qty')->nullable();
            $table->json('valid_user')->nullable();
            $table->json('valid_product')->nullable();
            $table->string('code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('offers', function (Blueprint $table) {
            $table->dropColumn('start_date');
            $table->dropColumn('end_date');
            $table->dropColumn('min_amount');
            $table->dropColumn('min_qty');
            $table->dropColumn('valid_user');
            $table->dropColumn('valid_product');
            $table->dropColumn('code');
        });
    }
}
