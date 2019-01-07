<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;


class LoginController extends Controller
{

    public function showLoginFrom() {
        if ( DB::table('user')->count() == 0)
            return redirect()->route('register');
        return view('auth/login');
    }

    public function login(Request $request)
    {
        if ( DB::table('user')->count() == 0)
            return redirect()->route('register');

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('home');
        }

        $user = User::where('username', $credentials['username'])->first();

        print_r($user->toArray());

        if ($this->passwordCheck($user->password, $credentials['password'])) {
            $user->password = Hash::make($credentials['password']);
            Auth::loginUsingId($user->id);
            $user->save();

            return redirect()->intended('home');
        }

        return view('auth/login');
    }

    public function logout() {

        Auth::logout();
        return redirect('/');
    }

    private function passwordCheck($hash, $password) {

    }
}
