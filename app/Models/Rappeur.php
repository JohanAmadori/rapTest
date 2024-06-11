<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Cjmellor\Rating\Concerns\CanBeRated;

class Rappeur extends Model
{
    use HasFactory;
    use CanBeRated;

    public function ratings()
    {
        return $this->morphMany(Rating::class, 'rateable');
    }

    public function quizs(): HasMany
    {
        return $this->hasMany(Quiz::class);
    } 
    
    // Vous devrez peut-être spécifier le nom de la table si elle ne correspond pas à la convention
    protected $table = 'rappeurs';

    // Assurez-vous que la colonne background est incluse dans les attributs fillable
    protected $fillable = ['background'];

    // Ajoutez des relations ou d'autres méthodes si nécessaire
}



