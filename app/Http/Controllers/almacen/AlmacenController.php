<?php

namespace App\Http\Controllers\almacen;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Container;
use App\Models\Fragrance;
use App\Models\StockFuture;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class AlmacenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stock = Warehouse::join('fragrance', 'warehouse.fragrance_id', '=', 'fragrance.fragrance_id')
            ->join('containers', 'warehouse.containers_id', '=', 'containers.containers_id')->get();
        $branch = Branch::where('state', 1)->get();
        $fragrances = Fragrance::where('state', 1)->get();
        $containers = Container::where('state', 1)->get();

        $stock_future = StockFuture::join('fragrance', 'stock_future.fragrance_id', '=', 'fragrance.fragrance_id')
            ->join('containers', 'stock_future.containers_id', '=', 'containers.containers_id')
            ->where('stock_future.state', 0)
            ->orderBy('stock_future.date', 'desc')->get();

        return view('pages.almacen.index', compact('stock', 'fragrances', 'containers', 'branch', 'stock_future'));
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
            $fragrance_id = $request->input('fragrance_id');
            $containers_id = $request->input('containers_id');
            $stock = $request->input('stock');

            // Buscar el registro en el warehouse
            $warehouse = Warehouse::where('fragrance_id', $fragrance_id)
                ->where('containers_id', $containers_id)
                ->first();

            if ($warehouse) {
                // Si existe, sumar el nuevo stock al existente
                $warehouse->stock += $stock;
                $warehouse->save();
                $message = 'Stock actualizado con éxito.';
            } else {
                // Si no existe, crear un nuevo registro
                Warehouse::create([
                    'fragrance_id' => $fragrance_id,
                    'containers_id' => $containers_id,
                    'stock' => $stock
                ]);
                $message = 'Stock creado con éxito.';
            }

            return redirect()->back()->with('success', $message);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Hubo un error al crear/actualizar el Stock');
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
