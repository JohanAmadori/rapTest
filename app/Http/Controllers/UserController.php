<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $user = auth()->user(); 

        if (!session()->has('visited_classement')) {
            $bonusMessage = " Premiere visite du classement, tient 5 points la chienneté !";
            $user->points += 5; 
            $user->save();

            session(['visited_classement' => true]);

            $successMessage = "Achievement debloqué ";
            if (!empty($bonusMessage)) {
                $successMessage .= $bonusMessage;
                return redirect()->route('classement')->with('success_with_bonus', $successMessage);
            }
        }

        $users = User::with('paniers')->get();

        $users->each(function ($user) {
            $user->total_valeur = $user->paniers->sum('valeur');
        });
        
        $sortedUsers = $users->sortByDesc('total_valeur');
        
        return view('classement', ['users' => $sortedUsers]);
    }


    public function profile_picture()
    {

    }

    }
    

    

    



