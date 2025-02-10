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
        Schema::table('jobs', function (Blueprint $table) {
            $table->integer('featured')->after('status')->default(0);
            $table->string('newspaper_image')->after('status')->nullable();
            $table->integer('job_type')->after('status')->default(0);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropColumn('featured');
            $table->dropColumn('newspaper_image');
            $table->dropColumn('job_type');

        });
    }
};
