<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wards', function (Blueprint $table) {
            $table->string('ma')->primary();
            $table->string('ten');
            $table->string('ma_qh');
            $table->string('quan_huyen');
            $table->timestamps();
        });

        Schema::table('wards', function (Blueprint $table) {
            $table->foreign('ma_qh')->references('ma')->on('districts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wards');
    }
};
