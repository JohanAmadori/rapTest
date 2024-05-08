<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Articles extends Model
{
    use HasFactory;

    protected $table = 'articles';

    protected $fillable = ['id','nom', 'note', 'prix_public','img'];

    protected $hidden = [];

    protected $casts = [
        'prix_public' => 'decimal:2',
    ];

    public function acheteurs() {
        return $this->belongsToMany(User::class, 'paniers')
                    ->withPivot('quantite')
                    ->withTimestamps();
    }
    
}

