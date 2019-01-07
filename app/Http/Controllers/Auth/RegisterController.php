<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class RegisterController extends Controller
{

    public function show() {
        if ( DB::table('user')->count() )
            return redirect()->route('login');
        return view('auth/register');
    }

    public function register(Request $request) {
        if ( DB::table('user')->count() )
            return redirect()->route('login');

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $this->create($request->toArray());

        return redirect()->route('home');
    }


    private function create(array $data)
    {
        return User::create([
            'username' => $data['name'],
            'password' => Hash::make($data['password']),
            'identity' => 1,
        ]);
    }
}
