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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->integer('no_of_opening')->nullable();
            $table->string('job_post_from')->nullable();
            $table->string('posting_days')->nullable();
            $table->string('desired_candidate')->nullable();
            $table->string('salary')->nullable();
            $table->string('pay_type')->nullable();
            $table->string('salary_range')->nullable();
            $table->text('license')->nullable();
            $table->text('skills')->nullable();
            $table->text('job_description')->nullable();
            $table->text('job_specification')->nullable();
            $table->string('banner')->nullable();
            $table->string('status')->nullable();
            $table->string('expiry_date')->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->unsignedBigInteger('province_id')->nullable();
            $table->unsignedBigInteger('district_id')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->string('area')->nullable();
            $table->unsignedBigInteger('employer_id')->nullable();
            $table->unsignedBigInteger('employee_type_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('job_level_id')->nullable();
            $table->unsignedBigInteger('education_id')->nullable();
            $table->unsignedBigInteger('experience_id')->nullable();
            $table->unsignedBigInteger('company_category_id')->nullable();
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->foreign('employee_type_id')->references('id')->on('employee_types')->onDelete('cascade');
            $table->foreign('province_id')->references('id')->on('provinces')->onDelete('cascade');
            $table->foreign('district_id')->references('id')->on('districts')->onDelete('cascade');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->foreign('company_category_id')->references('id')->on('company_categories')->onDelete('cascade');
            $table->foreign('job_level_id')->references('id')->on('job_levels')->onDelete('cascade');
            $table->foreign('education_id')->references('id')->on('educations')->onDelete('cascade');
            $table->foreign('experience_id')->references('id')->on('experiences')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('employer_id')->references('id')->on('employers')->onDelete('cascade');
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
        Schema::dropIfExists('jobs');
    }
};
