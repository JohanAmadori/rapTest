<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rappeur;

class RappeurController extends Controller
{
    public function index($id) {

        $rappeur = Rappeur::find($id);
        return view('rappeur', [
            'rappeur' => $rappeur,
        ]);
    }

    

    public function afficherPage($id)
    {
        $rappeur = Rappeur::findOrFail($id);
        $background = $rappeur->background;
    
        return view('rappeur', ['background' => $background]);
    }
    

}
