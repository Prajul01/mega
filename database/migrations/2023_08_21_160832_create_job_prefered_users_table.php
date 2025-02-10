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
        Schema::create('job_prefered_users', function (Blueprint $table) {
            $table->foreignId('job_seeker_id')->references('id')->on('job_seeker_personal_informations')->onDelete('cascade');
            $table->foreignId('company_category_id')->references('id')->on('company_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_prefered_users');
    }
};
