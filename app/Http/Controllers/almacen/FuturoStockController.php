<?php

namespace App\Http\Controllers\almacen;

use App\Http\Controllers\Controller;
use App\Models\StockFuture;
use App\Models\Warehouse;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FuturoStockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        // Validar los datos
        $request->validate([
            'fragrance_id' => 'required|exists:fragrance,fragrance_id',
            'containers_id' => 'required|exists:containers,containers_id',
            'stock' => 'required|integer|min:1',
            'date' => 'required|date',
        ]);

        try {
            // Crear el registro en la tabla stock_future
            StockFuture::create([
                'fragrance_id' => $request->fragrance_id,
                'containers_id' => $request->containers_id,
                'stock' => $request->stock,
                'date' => $request->date,
            ]);

            // Redireccionar con un mensaje de éxito
            return redirect()->back()->with('success', 'Se registro correctamente el futuro stock');
        } catch (Exception $e) {
            // Manejar la excepción y redireccionar con un mensaje de error
            return redirect()->back()->with('error', 'Hubo un error al crear el futuro stock');
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
    public function update(Request $request, $id)
    {
        try {
            // Encontrar el registro
            $stockFuture = StockFuture::findOrFail($id);
            $fragrance_id = $stockFuture->fragrance_id;
            $containers_id = $stockFuture->containers_id;
            $stock = $stockFuture->stock;

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

            $stockFuture->state = 1; // Ajusta esto según tu modelo y lógica
            $stockFuture->save();

            // Redireccionar con un mensaje de éxito
            return redirect()->back()->with('success', $message);
        } catch (Exception $e) {
            // Manejar la excepción y redireccionar con un mensaje de error
            return redirect()->back()->with('error', 'Hubo un error al actualizar el Stock futuro');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            // Buscar el registro por ID
            $stockFuture = StockFuture::findOrFail($id);

            // Eliminar el registro
            $stockFuture->delete();

            // Redirigir con un mensaje de éxito
            return redirect()->back()->with('success', 'El futuro stock fue eliminado con éxito.');
        } catch (\Exception $e) {
            // Registrar el error para depuración
            Log::error('Error al eliminar el futuro stock.', [
                'id' => $id,
                'error' => $e->getMessage()
            ]);

            // Redirigir con un mensaje de error
            return redirect()->back()->with('error', 'Hubo un error al eliminar el futuro stock: ' . $e->getMessage());
        }
    }
}
