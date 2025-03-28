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
                $table->unsignedBigInteger('user_id'); // Foreign Key
                $table->string('title');
                $table->string('artist')->nullable();
                $table->string('file_path'); // Song File Path
                $table->text('description')->nullable();
                $table->timestamps();

                // Foreign Key Constraint
                $table->foreign('user_id')->references('id')->on('userregisters')->onDelete('cascade');
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
