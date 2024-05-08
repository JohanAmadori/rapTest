<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use App\Models\Panier;
use Illuminate\Http\Request;



class CartController extends Controller
{
    public function index()
    {
        return view('cartes', ['cartes' => session('cartes', [])]);

        $paniers = Panier::with('article') // Assurez-vous de charger la relation avec 'article'
                    ->get()
                    ->sortBy(function($panier) {
                        return $panier->article->prix_public;
                    });

    return view('cartes', compact('paniers'));
    }

    public function showCart()
    {
        $user = auth()->user();  // Assurez-vous que l'utilisateur est connecté
        if ($user) {
            // Récupère les articles achetés par l'utilisateur connecté
            $paniers = Panier::where('user_id', $user->id)->get();
    
            // Pour récupérer les détails des articles, vous devez avoir une relation définie dans votre modèle
            return view('cartes', ['paniers' => $paniers]);
        } else {
            return redirect('login');  // Redirige vers la page de connexion si l'utilisateur n'est pas connecté
        }
    }

    public function showPaniers()
{
    // Charger les paniers avec les articles, en triant les articles par prix_public
    $paniers = Panier::with(['article' => function ($query) {
        $query->orderBy('prix_public', 'asc');
    }])->get();

    return view('votre_vue', compact('paniers'));
}

    
    


    
}




