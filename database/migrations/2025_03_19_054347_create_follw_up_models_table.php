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
        Schema::create('follw_up_models', function (Blueprint $table) {
            $table->id();
            $table->string('UserName');
            $table->unsignedBigInteger('follower_id');
            $table->foreign('follower_id')->references('id')->on('api_registrations')->onDelete('cascade')->onUpdate('cascade');
            $table->string('Follwer');
            $table->string('following');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('follw_up_models');
    }
};
