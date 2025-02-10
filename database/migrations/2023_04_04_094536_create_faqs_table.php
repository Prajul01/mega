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
        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('sub_title')->nullable();
            $table->text('description')->nullable();
            $table->string('faq_type')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->string('order_no')->nullable();
            $table->text('meta_title')->nullable();
            $table->text('meta_content')->nullable();
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
        Schema::dropIfExists('faqs');
    }
};
