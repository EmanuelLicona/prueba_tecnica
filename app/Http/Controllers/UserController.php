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
        $users = User::all();
        return view('user.index', compact('users'));
    }

    public function executeLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // $remember = $request->remember ? 'true' : 'false';

        if (Auth::attempt($credentials)) {
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

    public function register(Request $request)
    {
        return view('register');
    }

    public function executeRegister(Request $request)
    {

        // validaciones
        $this->validate(
            $request,
            [
                'name' => 'required',
                'email' => 'required|unique:users,email',
                'password' => 'required|min:6',
                'password_confirmation' => 'required|same:password',
            ],
            // mensajes de error en español
            [
                'name.required' => 'El nombre es obligatorio',
                'email.required' => 'El correo electrónico es obligatorio',
                'email.unique' => 'El correo electrónico ya existe',
                'password.required' => 'La contraseña es obligatoria',
                'password.min' => 'La contraseña debe tener al menos 6 caracteres',
                'password_confirmation.required' => 'La confirmación de la contraseña es obligatoria',
                'password_confirmation.same' => 'Las contraseñas no coinciden',
            ]
        );

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('index');
        }

        return redirect()->route('login')->with('success', 'Cuenta creada exitosamente');
    }
}
