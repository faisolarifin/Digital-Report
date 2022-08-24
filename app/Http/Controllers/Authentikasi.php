<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class Authentikasi extends Controller
{
    public function formRegister()
    {
        return view('auth.register');
    }
    public function actionRegister(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        $user = User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        event(new Registered($user));
        Auth::login($user);

        return redirect()->route('verification.notice');
    }
    public function formLogin()
    {
        if (Auth::check()) {
            return redirect()->route('rep.kas');
        }
        return view('auth.login');
    }
    public function actionLogin(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if (Auth::attempt($data)) {
            return redirect()->route('dashboard');
        }
        return redirect()->route('login')->with('error', 'Email atau Password Salah!');
    }
    public function logout()
    {
        Session:flush();
        Auth::logout();
        return redirect()->route('login');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
    {
        try {
            $user =  Socialite::driver('google')->user();
            $finduser = User::where('google_id', $user->id)->first();

            if($finduser) {
                Auth::login($finduser);
            }
            else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'password' => Hash::make('dummy'),
                    'email_verified_at' => Carbon::now(),
                ]);
                Auth::login($newUser);
            }
            return redirect()->route('dashboard');

        }
        catch (Exception $e) {
            dd($e->getMessage());
        }
    }

}
