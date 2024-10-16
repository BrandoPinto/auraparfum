<?php

namespace App\Http\Controllers\Ventas;

use App\Http\Controllers\Controller;
use App\Models\BranchStock;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class VentasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.ventas.index');
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
            $customers_id = $request->input('customers_id');
            $typepayment_id = $request->input('typepayment_id');
            $date = now()->format('Y/m/d'); // Fecha actual en formato Y/m/d

            // Recoger los branchstock_ids de los perfumes seleccionados
            $branchstock_ids = $request->input('perfumes', []); // Se asegura de que sea un array, incluso si está vacío

            // Validar que todos los campos necesarios están presentes
            if (empty($branchstock_ids) || empty($customers_id) || empty($typepayment_id)) {
                return redirect()->back()->with('error', 'Todos los campos deben ser seleccionados.');
            }

            foreach ($branchstock_ids as $branchstock_id) {
                $branchStock = BranchStock::find($branchstock_id);

                if ($branchStock) {
                    // Crear el registro en la tabla sales
                    Sale::create([
                        'idUser' => $idUser,
                        'customers_id' => $customers_id,
                        'branchstock_id' => $branchstock_id,
                        'date' => $date,
                        'typepayment_id' => $typepayment_id
                    ]);

                    // Descontar 1 del stock del branch_stock
                    $branchStock->stock -= 1;
                    $branchStock->save();

                    // Log de éxito para cada registro procesado
                    Log::info('Venta registrada y stock actualizado', [
                        'branchstock_id' => $branchstock_id,
                        'new_stock' => $branchStock->stock
                    ]);
                } else {
                    // Log de error si no se encuentra el branchstock_id
                    Log::error('No se encontró el branchstock_id', ['branchstock_id' => $branchstock_id]);
                }
            }

            return redirect()->route('ventas.index')->with('success', 'Venta registrada con éxito.');
        } catch (\Exception $e) {
            // Log del error completo en caso de excepción
            Log::error('Error al registrar la venta', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Error al registrar la venta.');
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
