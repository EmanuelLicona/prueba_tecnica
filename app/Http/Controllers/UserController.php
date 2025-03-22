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
        return redirect()->route('login')->withErrors(['error' => 'Invalid email or password']);
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
