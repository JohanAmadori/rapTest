<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use App\Models\Panier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



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

    public function vendreCarte($id)
    {
        $user = Auth::user();
        $panier = Panier::where('id', $id)->where('user_id', $user->id)->first();

        if (!$panier) {
            return redirect()->route('cartes')->with('error', 'Carte non trouvée ou vous n\'êtes pas autorisé à la vendre.');
        }

        // Ajouter le prix de la carte aux points de l'utilisateur
        $article = $panier->article;
        $user->points += $article->prix_public;

        // Sauvegarder les modifications de l'utilisateur et supprimer l'entrée du panier
        $user->save();
        $panier->delete();

                // Message de succès avec le montant de la vente
                $successMessage = "Carte vendue avec succès pour {$article->prix_public} crédits ! Vos points ont été mis à jour.";
        
                return redirect()->route('cartes')->with('success', $successMessage);
    }

    




    
}




