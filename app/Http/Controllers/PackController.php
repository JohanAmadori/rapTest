<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Pack;
use App\Models\Articles;
use Illuminate\Http\Request;

class PackController extends Controller
{
    public function openPack($id)
{
    // Trouver le pack correspondant
    $pack = Pack::findOrFail($id);

    // Récupérer l'utilisateur actuellement authentifié
    $user = Auth::user();

    // Vérifier si l'utilisateur a suffisamment de points pour acheter le pack
    if ($user->points < $pack->price) {
        // Rediriger l'utilisateur s'il n'a pas assez de points
        return redirect()->route('packs.index')->with('error', 'Vous n\'avez pas assez de points pour ouvrir ce pack.');
    }

    // Déduire le prix du pack des points de l'utilisateur
    $user->points -= $pack->price;

    // Sauvegarder les changements
    if ($user->save() === false) {
        return redirect()->route('packs.index')->with('error', 'Impossible de mettre à jour vos points. Veuillez réessayer.');
    }

    $drawnCards = [];

    // Définir les probabilités en fonction de l'ID du type de pack
    $probabilities = [];

    // Différencier les probabilités en fonction du type de pack (Pack Simple, Rare, Épique)
    switch ($pack->id) {
        case 1: // Pack Simple
            $probabilities = [
                'common' => 68,     // 65% de chance d'avoir une carte entre 40 et 50
                'uncommon' => 25,   // 25% de chance d'avoir une carte entre 51 et 70
                'rare' => 6,        // 7% de chance d'avoir une carte entre 71 et 80
                'very_rare' => 3,    // 3% de chance d'avoir une carte entre 81 et 90
                'super_rare' => 0,    // 3% de chance d'avoir une carte entre 81 et 90
                'legendary' => 0    // 3% de chance d'avoir une carte entre 81 et 90
            ];
            break;

        case 2: // Pack Rare
            $probabilities = [
                'common' => 15,
                'uncommon' => 28,
                'rare' => 37,
                'very_rare' => 14,
                'super_rare' => 5,
                'legendary' => 1 
            ];
            break;

        case 3: // Pack Épique
            $probabilities = [
                'common' => 0,
                'uncommon' => 8,
                'rare' => 14,
                'very_rare' => 40,
                'super_rare' => 32,
                'legendary' => 6  
            ];
            break;

        default:
            // Par défaut, si l'ID ne correspond à aucun pack prédéfini
            $probabilities = [
                'common' => 0,
                'uncommon' => 0,
                'rare' => 0,
                'very_rare' => 0,
                'super_rare' => 0,
                'legendary' => 0  
            ];
            break;
    }

    // On veut tirer 2 cartes pour ce pack
    while (count($drawnCards) < 2) {
        $randomPercentage = rand(1, 100);
        $possibleCards = collect(); // Initialise une collection vide pour stocker les cartes possibles

        // Utilisation des probabilités définies pour tirer les cartes
        if ($randomPercentage <= $probabilities['common']) {
            // Common: Tirer une carte de note entre 40 et 50
            $possibleCards = Articles::whereBetween('note', [75, 79])->get();
        } elseif ($randomPercentage <= ($probabilities['common'] + $probabilities['uncommon'])) {
            // Uncommon: Tirer une carte de note entre 51 et 70
            $possibleCards = Articles::whereBetween('note', [80, 83])->get();
        } elseif ($randomPercentage <= ($probabilities['common'] + $probabilities['uncommon'] + $probabilities['rare'])) {
            // Rare: Tirer une carte de note entre 71 et 80
            $possibleCards = Articles::whereBetween('note', [84, 86])->get();
        } elseif ($randomPercentage <= ($probabilities['common'] + $probabilities['uncommon'] + $probabilities['rare'] + $probabilities['very_rare'])) {
            // Very Rare: Tirer une carte de note entre 81 et 90
            $possibleCards = Articles::whereBetween('note', [87, 89])->get();
        } elseif ($randomPercentage <= ($probabilities['common'] + $probabilities['uncommon'] + $probabilities['rare'] + $probabilities['very_rare'] + $probabilities['super_rare'])) {
            // Super Rare: Tirer une carte de note entre 91 et 95
            $possibleCards = Articles::whereBetween('note', [90, 91])->get();
        } else {
            // Legendary: Tirer une carte de note entre 96 et 100
            $possibleCards = Articles::whereBetween('note', [92, 95])->get();
        }

        // Si des cartes sont disponibles, en choisir une au hasard et vérifier si elle est déjà présente
        if ($possibleCards->isNotEmpty()) {
            $selectedCard = $possibleCards->random();

            // Vérifier si la carte n'est pas déjà dans le tirage actuel pour éviter les doublons
            if (!in_array($selectedCard->id, array_column($drawnCards, 'id'))) {
                $drawnCards[] = $selectedCard;

                // Insérer la carte dans le panier de l'utilisateur (enregistrement dans la table `paniers`)
                $panier = new \App\Models\Panier();
                $panier->user_id = $user->id;
                $panier->articles_id = $selectedCard->id;
                $panier->valeur = $selectedCard->prix_public;  // Ajouter la valeur de la carte au panier
                $panier->save();  // Enregistrer la carte dans le panier de l'utilisateur    
                
                
            }

            // Transmettre l'ID du pack ($pack->id) à la vue
//    return view('pack.open', [
//        'drawnCards' => $drawnCards,
//        'packId' => $pack->id
//    ])->with('success', 'Pack ouvert avec succès ! Vos points et la valeur de votre collection ont été mis à jour.');
        }
    }



    return view('pack.open', compact('drawnCards'));
}

    
    

    public function index()
    {
        $packs = Pack::all(); // Récupérer tous les packs de la base de données
        return view('pack.index', compact('packs')); // Utiliser 'pack.index' au lieu de 'packs.index'
    }
    
}

