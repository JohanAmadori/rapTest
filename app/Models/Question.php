<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserReponse;

class Question extends Model
{
    use HasFactory;

    public function reponses()
{
    return $this->hasMany(UserReponse::class);
}

}
