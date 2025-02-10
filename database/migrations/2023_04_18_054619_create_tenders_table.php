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
        Schema::create('tenders', function (Blueprint $table) {
            $table->id();
            $table->text('title')->nullable();
            $table->text('slug')->nullable();
            $table->text('sub_title')->nullable();
            $table->string('logo')->nullable();
            $table->unsignedBigInteger('tender_category_id')->nullable();
            $table->unsignedBigInteger('tender_type_id')->nullable();
            $table->text('tags')->nullable();
            $table->string('deadline')->nullable();
            $table->string('view')->default(0);
            $table->text('description')->nullable();
            $table->string('order_no')->nullable();
            $table->enum('feature', ['0', '1'])->default('1');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->text('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_image')->nullable();
            $table->foreign('tender_category_id')->references('id')->on('tender_categories')->onDelete('cascade');
            $table->foreign('tender_type_id')->references('id')->on('tender_types')->onDelete('cascade');
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
        Schema::dropIfExists('tenders');
    }
};
