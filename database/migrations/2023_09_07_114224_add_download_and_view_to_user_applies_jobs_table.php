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
        Schema::table('user_applies_jobs', function (Blueprint $table) {
            $table->boolean('is_download')->default(0)->after('status');
            $table->boolean('is_seen')->default(0)->after('status');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_applies_jobs', function (Blueprint $table) {
            $table->dropColumn('is_download');
            $table->dropColumn('is_seen');
        });
    }
};