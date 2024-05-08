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
        Schema::create('quizs', function (Blueprint $table) {
            $table->id()->onDelete('cascade')->unique;
            $table->unsignedBigInteger('rappeur_id')->nullable(true);
            $table->string('question', 500)->nullable(false);
            $table->string('reponse1', 500)->nullable(false);
            $table->string('reponse2', 500)->nullable(false);
            $table->string('reponse3', 500)->nullable(false);
            $table->string('reponse4', 500)->nullable(false);
            $table->integer('reponse')->nullable(false);

            $table->timestamps();

            $table->index('rappeur_id');
            $table->foreign('rappeur_id')->references('id')->on('rappeurs');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz');
    }
};
