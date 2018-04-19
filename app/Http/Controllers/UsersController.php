<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(Auth::user()->isAdmin())
        {
            $_POST['koszt'] = 0;
            $_POST['koszt_tortow'] = 0;
            $users = User::orderBy('id')->paginate(50);
            return view('auth.uzytkownicy', compact('users'));
        }
        else redirect(route('home'));
    }
}
