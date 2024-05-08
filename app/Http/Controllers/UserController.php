<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('points', 'desc')->get();

        return view('classement', ['users' => $users]);
    }

    public function profile_picture()
    {

    }
}


