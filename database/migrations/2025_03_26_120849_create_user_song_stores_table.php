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
        Schema::create('user_song_stores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userId'); // Foreign Key
            $table->foreign('userId')->references('user_Id')->on('userregisters')->onDelete('cascade');
            $table->string('title');
            $table->string('type');
            $table->string('file_path');
            $table->text('content')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_song_stores');
    }
};
