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
        Schema::create('job_seeker_personal_informations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('current_district')->nullable();
            $table->string('current_municipality')->nullable();
            $table->string('current_location')->nullable();
            $table->string('permanent_district')->nullable();
            $table->string('permanent_municipality')->nullable();
            $table->string('permanent_location')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('gender')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('preferred_job')->nullable();
            $table->enum('have_license',['Yes','No'])->nullable();
            $table->string('have_vehicle')->nullable();
            $table->string('maritial_status')->nullable();
            $table->unsignedBigInteger('employee_type_id')->nullable();
            $table->foreign('employee_type_id')->references('id')->on('employee_types')->onDelete('cascade');
            $table->unsignedBigInteger('company_category_id')->nullable();
            $table->foreign('company_category_id')->references('id')->on('company_categories')->onDelete('cascade');
            $table->string('looking_for')->nullable();
            $table->string('expected_salary')->nullable();
            $table->text('career_objective')->nullable();
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
        Schema::dropIfExists('job_seeker_personal_information');
    }
};
