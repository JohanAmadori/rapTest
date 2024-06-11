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
        Schema::create('rappeurs', function (Blueprint $table) {
            $table->id();

            $table->string('nom', 70)->nullable(false);
            $table->integer('note_globale')->nullable(true);
            $table->string('vignette')->nullable(true);
            $table->string('picture')->nullable(true);
            $table->string('lien')->nullable(true);
            $table->string('musique')->nullable(true);
            $table->string('background')->nullable(true);
            
            $table->text('biographie')->nullable(true);

            $table->string('spotify')->nullable(true);
            $table->string('insta')->nullable(true);
            $table->string('youtube')->nullable(true);

            $table->timestamps();

            $table->index('nom');
            $table->index('note_globale');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_rappeurs');
    }
};
