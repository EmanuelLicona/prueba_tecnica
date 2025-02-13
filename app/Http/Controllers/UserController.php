<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class UserController extends Controller
{
    public function index()
    {
        // si no existe un usuario crear un nuevo
        if(User::count() == 0){
            $user = new User();
            $user->name = 'admin';
            $user->email = 'admin@prueba.com';
            $user->password = bcrypt('123456');
            $user->save();
        }
        return redirect()->route('login');
    }

    public function executeLogin(Request $request)
    {
      $credentials = $request->only('email', 'password', 'remember');

      $remember = $request->remember ? 'true' : 'false';

      if (Auth::attempt($credentials, $remember)) {
        return redirect()->route('index');
      }
      return redirect()->route('login')->withErrors(['error' => 'Usuario o contraseña incorrectos']);
    }


    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
