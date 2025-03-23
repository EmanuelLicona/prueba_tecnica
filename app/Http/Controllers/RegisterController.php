<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function form(Request $request)
    {
        return view('register.form');
    }

    public function index(Request $request)
    {
        $registrations = Registration::where('estado', true)->get();
        return view('register.index', compact('registrations'));
    }


    public function store(Request $request)
    {

        $request->validate(
            [
                'nombre' => 'required',
                'fecha_nacimiento' => 'required',
                'pertenece_iglesia' => 'required',
                'telefono' => 'required',
                // 'nombre_iglesia' => 'required',
                // 'padece_condicion_medica' => 'required',
                // 'persona_invitada' => 'required',
            ],
        );

        $registration = new Registration();
        $registration->nombre = $request->nombre;
        $registration->fecha_nacimiento = $request->fecha_nacimiento;
        $registration->pertenece_iglesia = $request->pertenece_iglesia;
        $registration->nombre_iglesia = $request->nombre_iglesia;
        $registration->padece_condicion_medica = $request->padece_condicion_medica;
        $registration->persona_invitada = $request->persona_invitada;
        $registration->telefono = $request->telefono;
        $registration->correo = $request->correo;
        $registration->estado = true;
        $registration->save();

        return redirect()->route('register_form')->with('success', 'Registration successful, thank you for your participation');
    }

    public function destroy($id)
    {
        $registration = Registration::find($id);
        if (!$registration) {
            return redirect()->route('register.index')->withErrors(['name' => 'Registro no encontrado']);
        }

        $registration->estado = false;
        $registration->save();

        return redirect()->route('register.index')->with('success', 'Registro eliminado exitosamente');
    }

    public function edit($id)
    {
        // producto con categoria
        $registration = Registration::with('categories')->find($id);

        if (!$registration) {
            return redirect()->route('register.index')->withErrors(['name' => 'Registro no encontrado']);
        }

        return view('register.edit');
    }

    public function update(Request $request, $id)
    {
        return redirect()->route('register.index')->with('success', 'Registro actualizado exitosamente');
    }
}
