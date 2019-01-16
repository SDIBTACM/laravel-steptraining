<?php

namespace App\Http\Controllers\Auth;

use App\Log;
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

        $validatedData = $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $this->create($request->toArray());

        return redirect()->route('home');
    }


    private function create(array $data)
    {
        Log::info('username: {} ip: {} register success', $data['user'], Request::ip());
        return User::create([
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'identity' => 1,
        ]);
    }
}
