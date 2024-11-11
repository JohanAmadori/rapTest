<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function rate(Request $request)
    {
        if (auth()->guest()) {
            return response()->json(['error' => 'Vous devez être connecté pour noter.'], 403);
        }

        $request->validate([
            'rapper_id' => 'required|exists:rappeurs,id',
            'rating' => 'required|integer|min:1|max:' . config('rating.max_score'),
        ]);

        $user = Auth::user();
        $rapperId = $request->input('rapper_id');
        $ratingValue = $request->input('rating');

        // Vérifier si l'utilisateur a déjà noté ce rappeur
        $exists = Rating::where('user_id', $user->id)
            ->where('rateable_type', 'App\Models\Rappeur')
            ->where('rateable_id', $rapperId)
            ->exists();

        if ($exists) {
            return response()->json(['error' => 'Vous avez déjà noté ce rappeur.'], 400);
        }

        // Enregistrer la note dans la table ratings
        Rating::create([
            'user_id' => $user->id,
            'rateable_type' => 'App\Models\Rappeur',
            'rateable_id' => $rapperId,
            'rating' => $ratingValue,
        ]);

        return response()->json(['success' => true, 'message' => 'Votre note a été enregistrée avec succès.']);
    }
}



