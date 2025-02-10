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
        Schema::create('employer_account_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employer_id')->reference('id')->on('employers')->onDelete('cascade');
            $table->boolean('profile')->default(1);
            $table->boolean('ownership')->default(1);
            $table->boolean('size')->default(1);
            $table->boolean('summary')->default(1);
            $table->boolean('address')->default(1);
            $table->boolean('website')->default(1);
            $table->boolean('services')->default(1);
            $table->boolean('social_accounts')->default(1);
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
        Schema::dropIfExists('employer_account_settings');
    }
};
