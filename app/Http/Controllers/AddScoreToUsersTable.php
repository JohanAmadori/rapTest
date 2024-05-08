<?php

namespace App\Http\Controllers;

// Exemple de migration pour ajouter une colonne 'score' à la table 'users'

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddScoreToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('score')->default(0); // Ajoute la colonne 'score' avec une valeur par défaut de 0
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('score'); // Supprime la colonne 'score' lors du rollback
        });
    }
}