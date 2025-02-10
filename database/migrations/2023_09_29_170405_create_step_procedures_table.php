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
        Schema::create('step_procedures', function (Blueprint $table) {
            $table->id();
            $table->string('posting_type');
            $table->text('step1');
            $table->text('step2');
            $table->text('step3');
            $table->string('banner')->nullable();
            $table->timestamps();
        });

        $steps = [
            json_encode([
                'heading' => 'heading1',
                'description' => 'description1'
            ]),
            json_encode([
                'heading' => 'heading2',
                'description' => 'description2'
            ]),
            json_encode([
                'heading' => 'heading2',
                'description' => 'description2'
            ]),
        ];

        $types = ['megajobs', 'premium-jobs', 'prime-jobs', 'advertisement'];
        foreach ($types as $type) {
            $q = new \App\Models\StepProcedure;
            $q->posting_type = $type;
            $q->step1 = $steps[0];
            $q->step2 = $steps[1];
            $q->step3 = $steps[2];
            $q->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('step_procedures');
    }
};