<?php

namespace App\Http\Controllers\Perfume;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\BranchStock;
use App\Models\Customer;
use App\Models\Fragrance;
use App\Models\Gender;
use App\Models\Service;
use App\Models\StockHistory;
use App\Models\TypeFragrance;
use App\Models\Warehouse;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PerfumeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fragrances = Fragrance::join('type_fragrance', 'fragrance.typefragrance_id', '=', 'type_fragrance.typefragrance_id')
            ->join('gender', 'fragrance.gender_id', '=', 'gender.gender_id')
            ->where('fragrance.state', 1)->get();
        $types_fragrances = TypeFragrance::where('state', 1)->get();
        $genders = Gender::all();


        return view('pages.perfumes.index', compact('fragrances', 'types_fragrances', 'genders'));
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
            $name_fragrance = $request->input('fragrance');
            $typefragrance_id = $request->input('typefragrance_id');
            $gender_id = $request->input('gender_id');

            $new_fragrance = new Fragrance();
            $new_fragrance->name_fragrance = $name_fragrance;
            $new_fragrance->typefragrance_id = $typefragrance_id;
            $new_fragrance->gender_id = $gender_id;
            $new_fragrance->save();

            return redirect()->back()->with('success', 'Perfume creado con exito.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Hubo un error al crear el perfume: ' . $e->getMessage());
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
    public function stock_branch(Request $request)
    {
        try {
            $stockToMove = $request->input('stock');
            $branch_id = $request->input('branch_id');
            $warehouse_id = $request->input('warehouse_id');

            // Obtener el registro de warehouse
            $warehouse = Warehouse::find($warehouse_id);
            $stock_history = new StockHistory();
            if (!$warehouse) {
                return redirect()->back()->with('error', 'No se encontró el registro en el almacén.');
            }

            if ($stockToMove > $warehouse->stock) {
                return redirect()->back()->with('error', 'El stock a mover es mayor al stock disponible en el almacén.');
            }

            $fragrance_id = $warehouse->fragrance_id;
            $containers_id = $warehouse->containers_id;

            // Buscar el registro en branch_stock
            $branchStock = BranchStock::where('branch_id', $branch_id)
                ->where('fragrance_id', $fragrance_id)
                ->where('containers_id', $containers_id)
                ->first();

            if ($branchStock) {
                // Si existe, sumar el nuevo stock al existente
                $branchStock->stock += $stockToMove;
                $branchStock->save();
                $stock_history->warehouse_id = $warehouse_id;
                $stock_history->branch_id = $branch_id;
                $stock_history->stock = $stockToMove;
                $stock_history->date = now();
                $stock_history->save();
                $message = 'Stock actualizado con éxito en la sucursal.';
            } else {
                // Si no existe, crear un nuevo registro
                BranchStock::create([
                    'branch_id' => $branch_id,
                    'fragrance_id' => $fragrance_id,
                    'containers_id' => $containers_id,
                    'stock' => $stockToMove
                ]);
                $message = 'Stock creado con éxito en la sucursal.';
                $stock_history->warehouse_id = $warehouse_id;
                $stock_history->branch_id = $branch_id;
                $stock_history->stock = $stockToMove;
                $stock_history->date = now();
                $stock_history->save();
            }

            // Restar el stock del warehouse
            $warehouse->stock -= $stockToMove;
            $warehouse->save();


            return redirect()->back()->with('success', $message);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Hubo un error al mover el stock.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $fragrance_id = $request->input('fragrance_id');
            $fragrance = Fragrance::findOrFail($fragrance_id);

            $fragrance->name_fragrance = $request->input('name_fragrance');
            $fragrance->stock = $request->input('stock_fragrance');

            $fragrance->save();

            return redirect()->back()->with('success', 'Perfume actualizado correctamente.');
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Perfume no encontrado.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Ocurrió un error al actualizar el perfume: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $type = Fragrance::findOrFail($id);

            $type->state = 0;
            $type->save();

            return redirect()->back()->with('success', 'El perfume fue eliminado con éxito.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Hubo un error al eliminar el perfume: ');
        }
    }
}
