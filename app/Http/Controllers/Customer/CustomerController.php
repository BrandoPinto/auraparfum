<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::where('idUser', $idUser = Auth::id())->get();
        $services = Service::all();
        $date = Carbon::now()->format('Y-m-d');
        return view('pages.customers.customer_list', compact('customers', 'services', 'date'));
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
    { {
            try {
                $idUser = Auth::id();
                $name = $request->input('name');
                $cellphone = $request->input('cellphone');
                $dni = $request->input('dni');
                $email = $request->input('email');

                $customer = new Customer;
                $customer->name = $name;
                $customer->cellphone = $cellphone;
                $customer->dni = $dni;
                $customer->email = $email;
                $customer->idUser = $idUser;
                $customer->save();


                return redirect()->back()->with('success', 'Cliente registrado con exito');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Hubo un error al crear nuevo cliente');
            }
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
