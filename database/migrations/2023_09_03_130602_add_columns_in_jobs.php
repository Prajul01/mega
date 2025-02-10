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
        Schema::table('jobs', function (Blueprint $table) {
            $table->enum('approval', ['approved', 'pending','declined'])->nullable();
            $table->text('declined_reason')->nullable();
        });

        $jobs = App\Models\Job::all();
        foreach ($jobs as $job) {
            $job->approval = 'approved';
            $job->update();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropColumn([
                'approval',
                'declined_reason',
            ]);
        });
    }
};