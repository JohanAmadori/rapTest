<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pack extends Model
{
    protected $fillable = ['name', 'price'];

    public function articles()
    {
        return $this->belongsToMany(Articles::class, 'pack_item', 'pack_id', 'article_id')
                    ->withPivot('probability')
                    ->withTimestamps();
    }
}

