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
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->text('who_we_are_heading')->nullable();
            $table->text('who_we_are_title')->nullable();
            $table->text('who_we_are_description')->nullable();
            $table->string('who_we_are_image')->nullable();
            $table->text('what_we_do_heading')->nullable();
            $table->text('what_we_do_title')->nullable();
            $table->text('what_we_do_description')->nullable();
            $table->string('what_we_do_image')->nullable();
            $table->string('feature_heading')->nullable();
            $table->string('section_1_title')->nullable();
            $table->text('section_1_description')->nullable();
            $table->string('section_1_image')->nullable();
            $table->string('section_2_title')->nullable();
            $table->text('section_2_description')->nullable();
            $table->string('section_2_image')->nullable();
            $table->string('section_3_title')->nullable();
            $table->text('section_3_description')->nullable();
            $table->string('section_3_image')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_image')->nullable();
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
        Schema::dropIfExists('abouts');
    }
};
