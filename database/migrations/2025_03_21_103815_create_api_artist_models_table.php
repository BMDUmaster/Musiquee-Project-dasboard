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
        Schema::create('api_artist_models', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('Username');
            $table->text('BioGraph');
            $table->date('Date');
            $table->json('Socialmedia');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('api_artist_models');
    }
};
