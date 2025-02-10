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
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('job_sekeer_profile_searchable')->nullable()->default(1)->after('gauth_id');
            $table->boolean('job_sekeer_seeking_job')->nullable()->default(1)->after('gauth_id');
            $table->boolean('job_sekeer_profile_confidential')->nullable()->default(1)->after('gauth_id');
            $table->boolean('job_sekeer_job_alert')->nullable()->default(1)->after('gauth_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('job_sekeer_profile_searchable');
            $table->dropColumn('job_sekeer_seeking_job');
            $table->dropColumn('job_sekeer_profile_confidential');
            $table->dropColumn('job_sekeer_job_alert');
        });
    }
};