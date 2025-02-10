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
        Schema::create('ad_pricings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('day_package_id')->references('id')->on('day_packages')->onDelete('cascade');
            $table->foreignId('ad_id')->references('id')->on('step_procedures')->onDelete('cascade');
            $table->unsignedInteger('no_of_days');
            $table->unsignedBigInteger('price');
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
        Schema::dropIfExists('ad_pricings');
    }
};
