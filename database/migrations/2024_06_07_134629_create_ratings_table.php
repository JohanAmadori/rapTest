<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->morphs('rateable');

            $table->foreignId('rappeur_id');
            $table->foreignId('user_id');

            $table->integer('rating');
            $table->timestamps();
        });
    }
};
