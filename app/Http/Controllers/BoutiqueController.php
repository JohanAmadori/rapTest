<?php

// Assurez-vous que le namespace et les imports sont corrects
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Articles;
use App\Models\Panier;


class BoutiqueController extends Controller
{
        // Autres méthodes pour d'autres vues, assurez-vous que leur nom est clair et descriptif
        public function cartes(){
            return view('cartes');
        }
    
        public function boutique(){
            return view('boutique');
        }
    // Méthode pour afficher la boutique avec tous les articles disponibles
    public function index()
    {
        $articles = Articles::all(); // Récupère tous les articles de la base de données
        return view('boutique', compact('articles')); // Passe les articles à la vue
    }


    public function acheter(Request $request, $id)
    {
        // Vérifier si l'utilisateur est connecté
        if (auth()->guest()) {
            return redirect()->route('boutique')->with('error', 'Veuillez vous connecter pour continuer.');
        }
    
        $article = Articles::findOrFail($id); // Utilisation de findOrFail pour gérer le cas où l'article n'existe pas
        $user = auth()->user();
    
        // Vérifier si l'article est déjà dans le panier de l'utilisateur
        $panierExist = $user->panier()->where('articles_id', $article->id)->exists();
    
        // Si l'article est déjà dans le panier, afficher un message d'erreur
        if ($panierExist) {
            return redirect()->back()->with('error', 'Vous avez déjà cet article dans votre panier.');
        }
    
        if ($user->points >= $article->prix_public) {
            $user->points -= $article->prix_public; // Déduire les points
            $user->save();
    
            // Ajouter l'article au panier 
            $user->panier()->attach($article->id, [
                'quantite' => 1,
                //'montant' => $article->prix_public 
            ]);        
    
            return redirect()->route('cartes')->with('success', 'Article acheté.');
        }
    
        return back()->with('error', 'Pas assez de points pour cet achat.');
    }
    

    
    
}





   
    


