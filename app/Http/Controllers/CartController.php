<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use App\Models\Panier;
use Illuminate\Http\Request;



class CartController extends Controller
{
    public function cartes()
    {
        return view('cartes');
    }

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
            // Récupère et trie les paniers par le prix de l'article
            $articles = Articles::all();
            $paniers = Panier::with(['article' => function($query) {
                $query->orderBy('prix_public', 'desc');
            }])->where('user_id', $user->id)->get();
    
            return view('cartes', ['paniers' => $paniers,'articles' => $articles]);
        } else {
            return redirect('login');  
        }
    }
    




    
}




