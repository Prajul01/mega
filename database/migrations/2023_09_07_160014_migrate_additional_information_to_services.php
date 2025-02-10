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
        Schema::table('employers', function (Blueprint $table) {
            $table->longText('services')->after('additional_info')->nullable();
        });

        $employers = App\Models\Employer::all();
        foreach ($employers as $data) {
            if (!is_null($data->additional_info)) {
                $data->services = $data->additional_info;
                $data->update();
            }
        }

        Schema::table('employers', function (Blueprint $table) {
            $table->dropColumn([
                'additional_info'
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
        Schema::table('employers', function (Blueprint $table) {
            $table->longText('additional_info')->after('services');
        });

        $employers = App\Models\Employer::all();
        foreach ($employers as $data) {
            if (!is_null($data->services)) {
                $data->additional_info = $data->services;
                $data->update();
            }
        }

        Schema::table('employers', function (Blueprint $table) {
            $table->dropColumn([
                'services'
            ]);
        });
    }
};