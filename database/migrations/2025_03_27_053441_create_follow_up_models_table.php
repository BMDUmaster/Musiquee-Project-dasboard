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
        Schema::create('follow_up_models', function (Blueprint $table) {
            $table->id();

            $table->string('userName')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('follower_id');
            $table->unsignedBigInteger('following_id');


            $table->foreign('user_id')->references('id')->on('userregisters')->onDelete('cascade');
            $table->foreign('follower_id')->references('id')->on('userregisters')->onDelete('cascade');
            $table->foreign('following_id')->references('id')->on('userregisters')->onDelete('cascade');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('follow_up_models');
    }
};
