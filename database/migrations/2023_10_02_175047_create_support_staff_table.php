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
        Schema::create('support_staff', function (Blueprint $table) {
            $table->id();
            $table->boolean('display');
            $table->unsignedInteger('order_no');
            $table->string('name');
            $table->string('phone_no');
            $table->string('email');
            $table->string('profile_pic');
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
        Schema::dropIfExists('support_staff');
    }
};
