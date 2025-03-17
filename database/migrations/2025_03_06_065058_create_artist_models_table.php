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
        Schema::create('artist_models', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('Username');
            $table->text('BioGraph');
            $table->date('Date');
            $table->json('Socialmedia');
            $table->string('status');
            $table->string('Action');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artist_models');
    }
};
