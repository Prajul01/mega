<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Employer;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employers', function (Blueprint $table) {
            $table->text('facebook_url')->nullable()->after('additional_info');
            $table->text('instagram_url')->nullable()->after('additional_info');
            $table->text('youtube_url')->nullable()->after('additional_info');
            $table->text('linkedIn_url')->nullable()->after('additional_info');
            $table->text('tiktok_url')->nullable()->after('additional_info');
        });

        $employers = Employer::all();
        foreach ($employers as $employer) {
            if (!is_null($employer->social_information)) {
                $social_informations = json_decode($employer->social_information);
                $social_names = $social_informations->social_name;
                $social_links = $social_informations->social_link;

                foreach ($social_names as $key => $name) {
                    switch (strtolower($name)) {
                        case 'youtube':
                            $employer->youtube_url = $social_links[$key];
                            break;
                        case 'facebook':
                            $employer->facebook_url = $social_links[$key];
                            break;
                        case 'tiktok':
                            $employer->tiktok_url = $social_links[$key];
                            break;
                        case 'instagram':
                            $employer->instagram_url = $social_links[$key];
                            break;
                        case 'linkedin':
                            $employer->linkedIn_url = $social_links[$key];
                            break;
                    }
                }
            }

            $employer->update();
        }

        Schema::table('employers', function (Blueprint $table) {
            $table->dropColumn(['social_information']);
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
            //
        });
    }
};