<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model; 
use App\Models\Articles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'points', // Ajoutez 'points' ici
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function updatePoints($points)
    {
        $this->points += $points;
        $this->save();
    }

    public function articles()
    {
        return $this->belongsToMany(Articles::class);
    }

    public function canAfford(Articles $article): bool
    {
        return $this->points >= $article->prix_public;
    }

    // User.php
public function points()
{
    return $this->points; // Assurez-vous que `points` est un champ valide dans la base de données.
}

public function panier() {
    return $this->belongsToMany(Articles::class, 'paniers')
                ->withPivot('quantite')
                ->withTimestamps();

                return $this->belongsToMany(Articles::class, 'panier', 'user_id', 'article_id');
                        
}


public function responses()
{
    return $this->hasMany(UserReponse::class);
}

public function paniers()
{
    return $this->hasMany(Panier::class); 


}




}