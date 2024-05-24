<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('user_reponses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('question_id')->unique;
            $table->timestamps();

            $table->unique(['user_id', 'question_id']); // Contrainte unique pour éviter les réponses multiples  
            
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('question_id')->references('id')->on('quizs');
        });
    }
    
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_responses');
    }
};
