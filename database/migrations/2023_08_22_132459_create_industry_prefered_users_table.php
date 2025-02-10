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
        Schema::create('industry_prefered_users', function (Blueprint $table) {
            $table->foreignId('job_seeker_id')->reference('id')->on('job_seeker_personal_informations')->onDelete('cascade');
            $table->foreignId('industry_id')->reference('id')->on('industries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('industry_prefered_users');
    }
};
