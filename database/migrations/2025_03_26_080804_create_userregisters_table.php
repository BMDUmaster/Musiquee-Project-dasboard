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
        Schema::create('userregisters', function (Blueprint $table) {
            $table->id('user_Id');
            $table->string('userName')->nullable();
            $table->string('phone')->nullable()->unique();
            $table->string('email')->nullable()->unique();
            $table->text('bio')->nullable();
            $table->json('socialLinks')->nullable();
            $table->string('role')->default('singer');
            $table->string('profileImage')->nullable();
            $table->string('password');
            $table->string('status')->default('active');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('userregisters');
    }
};
