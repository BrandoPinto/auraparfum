<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Typeofpayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    /**
     * Constructor del controlador.
     */

    public function index()
    {
        $services = Service::join('typeofpayment', 'services.idtypeofpayment', '=', 'typeofpayment.idtypeofpayment')
            ->where('idUser', $idUser = Auth::id())->get();

        $typesofpayment = Typeofpayment::all();
        return view('pages.services.service_list', compact('services', 'typesofpayment'));
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
            $serviceName = $request->input('service');
            $idtypeofpayment = $request->input('idtypeofpayment');

            $service = new Service;
            $service->service = $serviceName;
            $service->idtypeofpayment = $idtypeofpayment;
            $service->idUser = $idUser;


            $service->save();

            return redirect()->back()->with('success', 'Servicio creado con éxito.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Hubo un error al crear el servicio: ' . $e->getMessage());
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
