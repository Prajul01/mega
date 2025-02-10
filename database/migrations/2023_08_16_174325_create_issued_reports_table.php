<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issued_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('area_of_concern_id')->references('id')->on('area_of_concerns')->onDelete('cascade');
            $table->boolean('read')->default(0);
            $table->string('name');
            $table->string('email');
            $table->string('phone_no');
            $table->string('subject');
            $table->text('details');
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
        Schema::dropIfExists('issued_reports');
    }
};