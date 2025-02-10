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
        Schema::table('job_seeker_personal_informations', function (Blueprint $table) {
            $table->dropColumn([
                'current_district',
                'current_municipality',
                'current_location',
                'permanent_district',
                'permanent_municipality',
                'permanent_location',
                'meta_title',
                'meta_description',
                'meta_image',
            ]);
            $table->foreignId('current_province')->references('id')->on('provinces')->onDelete('cascade')->after('last_name');
            $table->foreignId('current_district')->references('id')->on('districts')->onDelete('cascade')->nullable()->after('current_province');
            $table->foreignId('current_city')->references('id')->on('cities')->onDelete('cascade')->nullable()->after('current_district');
            $table->foreignId('permanent_province')->references('id')->on('provinces')->onDelete('cascade')->nullable()->after('current_city');
            $table->foreignId('permanent_district')->references('id')->on('districts')->onDelete('cascade')->nullable()->after('permanent_province');
            $table->foreignId('permanent_city')->references('id')->on('cities')->onDelete('cascade')->nullable()->after('permanent_district');
            $table->string('profile_pic')->nullable()->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_seeker_personal_informations', function (Blueprint $table) {
            $table->dropColumn([
                'current_district',
                'current_province',
                'current_city',
                'permanent_district',
                'permanent_province',
                'permanent_city',
                'profile_pic'
            ]);
        });
    }
};