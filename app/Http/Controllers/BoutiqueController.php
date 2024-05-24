<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Articles;
use App\Models\Panier;

class BoutiqueController extends Controller
{
    public function cartes()
    {
        return view('cartes');
    }

    public function boutique()
    {
        return view('boutique');
    }

    public function index()
    {
        $articles = Articles::all();
        return view('boutique', compact('articles'));
    }

    public function acheter(Request $request, $id)
    {
        if (auth()->guest()) {
            return redirect()->route('boutique')->with('login_error', 'Veuillez vous connecter pour continuer.');
        }

        $article = Articles::findOrFail($id);
        $user = auth()->user();

        // Vérifier si l'article est déjà dans le panier
        if ($user->panier()->where('articles.id', $article->id)->exists()) {
            return redirect()->route('boutique')->with('error', 'Vous possèdez deja cet article.');
        }

        if ($user->points >= $article->prix_public) {
            $panierCount = $user->panier()->count();

            $isFirstPurchase = $panierCount == 0;
            $isFivePurchase = $panierCount == 4;
            $isTenPurchase = $panierCount == 9;

            // Vérifiez si l'article a une note de 85 ou plus
            $isNote85 = $article->note >= 85;
            $isNote90 = $article->note >= 90;

            // Compter le nombre d'articles avec une note de 85 ou plus dans le panier de l'utilisateur
            $countArticles85 = $user->panier()->where('note', '>=', 85)->count();
            $countArticles90 = $user->panier()->where('note', '>=', 90)->count();

            $user->points -= $article->prix_public;

            $bonusMessages = [];

            if ($isFirstPurchase) {
                $user->points += 10; // Bonus pour le premier achat
                $bonusMessages[] = "Bonus de 10 points pour votre premier achat!";
            }
            if ($isFivePurchase) {
                $user->points += 20; // Bonus pour le cinquième achat
                $bonusMessages[] = "Bonus de 20 points pour votre cinquième achat!";
            }
            if ($isTenPurchase) {
                $user->points += 30; // Bonus pour le dixième achat
                $bonusMessages[] = "Bonus de 30 points pour votre dixième achat!";
            }
            if ($isNote85 && $countArticles85 == 0) {
                $user->points += 15; // Bonus pour une note de 85 ou plus
                $bonusMessages[] = "Bonus de 15 points pour un article noté 85 ou plus!";
            }
            if ($isNote90 && $countArticles90 == 0) {
                $user->points += 30; // Bonus pour une note de 90 ou plus
                $bonusMessages[] = "Bonus de 30 points pour un article noté 90 ou plus!";
            }

            $user->save();

            // Ajouter l'article au panier
            $user->panier()->attach($article->id, [
                'quantite' => 1,
                'valeur' => $article->prix_public
            ]);

            $successMessage = "Vous avez ajouté une carte à votre collection!";
            if (!empty($bonusMessages)) {
                $successMessage .= "<ul>";
                foreach ($bonusMessages as $message) {
                    $successMessage .= "<li>$message</li>";
                }
                $successMessage .= "</ul>";
                return redirect()->route('cartes')->with('success_with_bonus', $successMessage);
            } else {
                return redirect()->route('cartes')->with('success_no_bonus', $successMessage);
            }
        }

        return redirect()->route('boutique')->with('error', 'Vous être trop pauvre ! Ouvrez un OF.');    }

    public function showPaniers()
    {
        // Charger les paniers avec les articles, en triant les articles par prix_public
        $paniers = Panier::with(['article' => function ($query) {
            $query->orderBy('prix_public', 'asc');
        }])->get();

        return view('cartes', compact('paniers'));
    }
}
