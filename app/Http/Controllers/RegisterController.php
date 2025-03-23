<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function show($id)
    {
        $registration = Registration::with('childrenRegistrations')->find($id);
        return view('register.show', compact('registration'));
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




    public function newRegistration(Request $request)
    {
        DB::beginTransaction();

        try {
            //transaction 

            $registrationParent = new Registration();
            $registrationParent->nombre = $request->nombre;
            $registrationParent->correo = $request->email;
            $registrationParent->telefono = $request->telefono;
            $registrationParent->fecha_nacimiento = $request->fecha_nacimiento;
            $registrationParent->pertenece_iglesia = $request->pertenece_iglesia;
            $registrationParent->nombre_iglesia = $request->nombre_iglesia;
            $registrationParent->padece_condicion_medica = $request->padece_condicion_medica;

            $registrationParent->save();

            if ($request->personas_invitadas) {

                foreach ($request->personas_invitadas as $persona) {
                    $registrationChild = new Registration();

                    $registrationChild->nombre = $persona['nombre'];
                    $registrationChild->fecha_nacimiento = $persona['fecha_nacimiento'];
                    $registrationChild->padece_condicion_medica = $persona['padece_condicion_medica'];
                    $registrationChild->estado = true;
                    $registrationChild->pertenece_iglesia = $registrationParent->pertenece_iglesia;

                    $registrationChild->parent_registration_id = $registrationParent->id;

                    $registrationChild->save();
                }
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'request' => $request->all(),
            ], 201);
        } catch (Exception $e) {

            DB::rollBack();

            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], 400);
        }
    }
}
