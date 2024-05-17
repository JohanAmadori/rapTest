<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Panier extends Model
{
    protected $table = 'paniers'; // Spécifiez le nom de la table si ce n'est pas le pluriel du nom du modèle

    protected $fillable = [
        'user_id', 'articles_id', 'quantite','valeur' // Les attributs que vous autorisez à être assignés massivement
    ];

    // Relation avec le modèle User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relation avec le modèle Article
    public function article()
    {
        return $this->belongsTo(Articles::class, 'articles_id');
    }
    
}
