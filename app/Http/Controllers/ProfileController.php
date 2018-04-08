<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\EditProfileRequest;
use App\Order;
use Illuminate\Support\Facades\Notification;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        return view('auth.profile');
    }

    public function edit(User $id)
    {
        $user = User::find($id)->first();
        return view('auth.editProfile', compact('user'));
    }

    public function update(EditProfileRequest $request, $id)
    {
        User::find($id)->update($request->all());
        return redirect(route('profile.index'));
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect(route('home'));
    }
}
