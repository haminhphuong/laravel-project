<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAttributesToProductInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_infos', function (Blueprint $table) {
            $table->string('size')->nullable();
            $table->string('brand')->nullable();
            $table->string('color')->nullable();
            $table->boolean('deals_of_the_week')->default(false);
            $table->boolean('coming_soon')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_infos', function (Blueprint $table) {
            $table->dropColumn('size');
            $table->dropColumn('brand');
            $table->dropColumn('color');
            $table->dropColumn('deals_of_the_week');
            $table->dropColumn('coming_soon');
        });
    }
}
