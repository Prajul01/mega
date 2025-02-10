<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * These are the all the required fields for site setting 
         * Remove all those which are not necessary for the project
         */
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_title');
            $table->string('site_email');
            $table->string('site_email2')->nullable();
            $table->string('logo');
            $table->string('favicon');
            
            $table->string('phone');
            $table->string('phone2')->nullable();
            $table->string('mobile');
            $table->string('mobile2')->nullable();

            $table->string('address')->nullable();

            $table->string('facebook_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('youtube_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->text('googlemap_url')->nullable();

            $table->string('whatsApp_number')->nullable();
            $table->string('viber_number')->nullable();

            $table->text('og_title')->nullable();
            $table->text('og_description')->nullable();
            $table->text('og_image')->nullable();

            $table->text('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('site_settings');
    }
}
