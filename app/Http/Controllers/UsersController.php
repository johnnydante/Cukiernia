<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class UsersController extends Controller
{

    public function index()
    {
            $users = User::orderBy('id')->paginate(50);
            return view('auth.uzytkownicy', compact('users'));
    }
}
