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
            if (Schema::hasColumn('job_seeker_personal_informations', 'current_district')) {
                $table->dropColumn('current_district');
            }
            if (Schema::hasColumn('job_seeker_personal_informations', 'current_municipality')) {
                $table->dropColumn('current_municipality');
            }
            if (Schema::hasColumn('job_seeker_personal_informations', 'current_location')) {
                $table->dropColumn('current_location');
            }
            if (Schema::hasColumn('job_seeker_personal_informations', 'permanent_district')) {
                $table->dropColumn('permanent_district');
            }
            if (Schema::hasColumn('job_seeker_personal_informations', 'permanent_municipality')) {
                $table->dropColumn('permanent_municipality');
            }
            if (Schema::hasColumn('job_seeker_personal_informations', 'permanent_location')) {
                $table->dropColumn('permanent_location');
            }
            if (Schema::hasColumn('job_seeker_personal_informations', 'meta_title')) {
                $table->dropColumn('meta_title');
            }
            if (Schema::hasColumn('job_seeker_personal_informations', 'meta_description')) {
                $table->dropColumn('meta_description');
            }
            if (Schema::hasColumn('job_seeker_personal_informations', 'meta_image')) {
                $table->dropColumn('meta_image');
            }
        });

        Schema::table('job_seeker_personal_informations', function (Blueprint $table) {
            if (!Schema::hasColumn('job_seeker_personal_informations', 'current_province')) {
                $table->foreignId('current_province')->after('last_name')->constrained('provinces')->onDelete('cascade');
            }
            if (!Schema::hasColumn('job_seeker_personal_informations', 'current_district')) {
                $table->foreignId('current_district')->nullable()->after('current_province')->constrained('districts')->onDelete('cascade');
            }
            if (!Schema::hasColumn('job_seeker_personal_informations', 'current_city')) {
                $table->foreignId('current_city')->nullable()->after('current_district')->constrained('cities')->onDelete('cascade');
            }
            if (!Schema::hasColumn('job_seeker_personal_informations', 'permanent_province')) {
                $table->foreignId('permanent_province')->nullable()->after('current_city')->constrained('provinces')->onDelete('cascade');
            }
            if (!Schema::hasColumn('job_seeker_personal_informations', 'permanent_district')) {
                $table->foreignId('permanent_district')->nullable()->after('permanent_province')->constrained('districts')->onDelete('cascade');
            }
            if (!Schema::hasColumn('job_seeker_personal_informations', 'permanent_city')) {
                $table->foreignId('permanent_city')->nullable()->after('permanent_district')->constrained('cities')->onDelete('cascade');
            }
            if (!Schema::hasColumn('job_seeker_personal_informations', 'profile_pic')) {
                $table->string('profile_pic')->nullable()->after('id');
            }
        });
    }

    public function down()
    {
        Schema::table('job_seeker_personal_informations', function (Blueprint $table) {
            $table->dropColumn(['current_province', 'current_district', 'current_city', 'permanent_province', 'permanent_district', 'permanent_city', 'profile_pic']);
        });
    }
};
