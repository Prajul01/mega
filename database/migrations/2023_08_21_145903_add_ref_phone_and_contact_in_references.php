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
        Schema::table('job_seeker_references', function (Blueprint $table) {
            $table->text('reference_phone')->after('reference_email')->nullable();
            $table->text('reference_mobile')->after('reference_phone')->nullable();
            $table->dropColumn([
                'meta_title',
                'meta_description',
                'meta_image',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_seeker_references', function (Blueprint $table) {
            $table->dropColumn([
                'reference_mobile',
                'reference_mobile',
            ]);
        });
    }
};
