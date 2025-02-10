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
        Schema::create('employer_emails', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employer_id')->references('id')->on('employers')->onDelete('cascade');
            $table->string('email');
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('is_primary')->default(0);
            $table->timestamps();
        });

        $employers = App\Models\Employer::all();
        foreach ($employers as $employer) {
            $email = new App\Models\EmployerEmail;
            $email->employer_id = $employer->id;
            $email->email = $employer->email;
            $email->email_verified_at = now();
            $email->save();
        }

        Schema::table('employers', function (Blueprint $table) {
            $table->dropColumn(['email']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employer_emails');
    }
};