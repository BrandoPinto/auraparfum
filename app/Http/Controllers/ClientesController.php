<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = Auth::user()->id;
        $customers = Customer::where('idUser', $id)
            ->where('state', 1)->get();


        return view('pages.clientes.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $idUser = Auth::id();
            $name = strtoupper($request->input('name'));
            $cellphone = $request->input('cellphone');
            $dni = $request->input('dni');
            $email = $request->input('email');

            // Verificar si el celular ya existe
            $existingCustomer = Customer::where('cellphone', $cellphone);

            // Verificar si el DNI ya existe (si no es nulo)
            if (!empty($dni)) {
                $existingCustomer = $existingCustomer->orWhere('dni', $dni);
            }

            // Verificar si el email ya existe (si no es nulo)
            if (!empty($email)) {
                $existingCustomer = $existingCustomer->orWhere('email', $email);
            }

            $existingCustomer = $existingCustomer->first();

            if ($existingCustomer) {
                return redirect()->back()->with('error', 'El cliente con el DNI, email o teléfono ya existe.');
            }

            // Crear el nuevo cliente
            $customer = new Customer;
            $customer->name = $name;
            $customer->cellphone = $cellphone;
            $customer->idUser = $idUser;
            $customer->registration_date = now()->format('Y/m/d');

            // Asignar DNI solo si no está vacío
            if (!empty($dni)) {
                $customer->dni = $dni;
            }

            // Asignar email solo si no está vacío
            if (!empty($email)) {
                $customer->email = $email;
            }

            $customer->save();

            return redirect()->back()->with('success', 'Cliente registrado con éxito');
        } catch (\Exception $e) {
            // Registrar el error en el log
            Log::error('Error al crear nuevo cliente', [
                'error' => $e->getMessage(),
                'stack' => $e->getTraceAsString()
            ]);

            return redirect()->back()->with('error', 'Hubo un error al crear el nuevo cliente');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $id = $request->input('id');
            $user = Customer::findOrFail($id);

            $user->name = $request->input('name');
            $user->cellphone = $request->input('cellphone');
            $user->email = $request->input('email');
            $user->dni = $request->input('dni');

            $user->save();

            return redirect()->back()->with('success', 'Cliente actualizado correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocurrió un error al actualizar el cliente.');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $type = Customer::findOrFail($id);

            $type->state = 0;
            $type->save();

            return redirect()->back()->with('success', 'El cliente fue eliminado con éxito.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Hubo un error al eliminar el cliente: ');
        }
    }
}
