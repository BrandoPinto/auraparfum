<?php

namespace App\Http\Controllers\Perfume;

use App\Http\Controllers\Controller;
use App\Models\TypeFragrance;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class TiposPerfumeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types_fragrances = TypeFragrance::where('state', 1)->get();

        return view('pages.perfumes.tipos_perfume', compact('types_fragrances'));
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
            $name_type = $request->input('name_type');

            $type = new TypeFragrance();
            $type->name_type = $name_type;
            $type->state = 1;
            $type->save();

            return redirect()->back()->with('success', 'Nuevo tipo creado con exito.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Hubo un error al crear el nuevo tipo: ' . $e->getMessage());
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
    public function update(Request $request)
    {
        try {
            // Validar los datos del formulario
            $request->validate([
                'name_type' => 'required|string|max:255',
            ]);
            $typefragrance_id = $request->input('typefragrance_id');
            $tipoFragancia = TypeFragrance::findOrFail($typefragrance_id);

            $tipoFragancia->name_type = $request->input('name_type');
            $tipoFragancia->save();

            return redirect()->back()->with('success', 'Tipo de perfume actualizado correctamente.');
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Tipo de perfume no encontrado.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Ocurrió un error al actualizar el tipo de perfume: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            // Encuentra el tipo de fragancia por su ID
            $type = TypeFragrance::findOrFail($id);

            // Elimina el tipo de fragancia
            $type->state = 0;
            $type->save();

            return redirect()->back()->with('success', 'El tipo de perfume fue eliminado con éxito.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Hubo un error al eliminar el tipo de pergume: ' . $e->getMessage());
        }
    }
}
