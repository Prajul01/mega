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
        Schema::create('employers', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->nullable();
            $table->string('email')->nullable();
            $table->string('office_number')->nullable();
            $table->string('phone_number')->nullable();
            $table->text('company_website')->nullable();
            $table->text('company_description')->nullable();
            $table->text('additional_info')->nullable();
            $table->text('social_information')->nullable();
            $table->text('contact_persons_information')->nullable();
            $table->string('logo')->nullable();
            $table->string('slug')->nullable();
            $table->string('image')->nullable();
            $table->string('address')->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->unsignedBigInteger('province_id')->nullable();
            $table->unsignedBigInteger('district_id')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->unsignedBigInteger('company_category_id')->nullable();
            $table->unsignedBigInteger('company_owner_ship_id')->nullable();
            $table->unsignedBigInteger('company_size_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->foreign('province_id')->references('id')->on('provinces')->onDelete('cascade');
            $table->foreign('district_id')->references('id')->on('districts')->onDelete('cascade');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->foreign('company_category_id')->references('id')->on('company_categories')->onDelete('cascade');
            $table->foreign('company_owner_ship_id')->references('id')->on('company_owner_ships')->onDelete('cascade');
            $table->foreign('company_size_id')->references('id')->on('company_sizes')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('status')->nullable();
            $table->string('is_varify')->nullable();
            $table->string('expiry_date')->nullable();
            $table->text('meta_title')->nullable();
            $table->string('order_no')->nullable();
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
        Schema::dropIfExists('employers');
    }
};
