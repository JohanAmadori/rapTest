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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 15)->nullable(false);
            $table->integer('note')->nullable(true);
            $table->decimal('prix_public', 9, 2)->nullable(false);
            $table->string('img')->nullable(false);        

            $table->timestamps();

            $table->index('nom');
            $table->index('note');
            $table->index('prix_public');
            $table->index('img');

            
            

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};