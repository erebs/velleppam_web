<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('full_name',30);
            $table->string('phone_number',20);
            $table->string('email_id',30)->unique();
            $table->string('password',100);
            $table->string('otp',4)->default('');
            $table->enum('device_type', ['Android', 'iOS', 'Web']);
             $table->string('status',15);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
