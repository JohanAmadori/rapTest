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
    
            $validated = $request->validate([
                'rapper_id' => 'required|exists:rappeurs,id',
                'rating' => 'required|integer|min:1|max:' . config('rating.max_score'),
            ]);
    
            $rating = Rating::create([
                'rateable_type' => 'App\Models\Rappeur',
                'rateable_id' => $validated['rapper_id'],
                'user_id' => Auth::id(),
                'rating' => $validated['rating'],
            ]);

        return response()->json(['success' => true, 'rating' => $rating], 200);
    }
}



