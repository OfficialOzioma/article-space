<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\User;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout'); // like this
    }

    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function authicate(Request $request)
    {
        $remember_me = $request->has('remember_me') ? true : false;
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $remember_me)) {
            $url = 'profile/' . Auth::user()->username;

            return redirect()
                ->intended($url)
                ->withSuccess('You have Successfully logged in');
        }
        return redirect('login')->withErrors(
            'Sorry! You have entered invalid credentials'
        );
    }

    public function registration(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|string',
            'email' => 'required|email|unique:users',
            'username' => 'required|string|min:4|unique:users',
            'password' => 'required|min:8',
            'terms' => 'accepted',
        ]);

        $data = $request->all();

        $user = $this->create($data);

        Auth::login($user);
        $url = 'profile/' . Auth::user()->username;
        return redirect($url)->withSuccess('Welcome');
    }

    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'role' => 'user',
        ]);
    }

    public function logout()
    {
        request()
            ->session()
            ->invalidate();
        request()
            ->session()
            ->regenerateToken();
        Session::flush();
        Auth::logoutCurrentDevice(); // use this instead of Auth::logout()

        return Redirect('login');
    }

    // public function dashboard()
    // {
    //     if(Auth::check()){
    //         return view('dashboard');
    //     }

    //     return redirect("login")->withSuccess('Opps! You do not have access');
    // }
}