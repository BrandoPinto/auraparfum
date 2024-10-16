<?php

namespace App\Http\Controllers\Perfume;

use App\Http\Controllers\Controller;
use App\Models\Container;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class EnvaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $containers = Container::where('state', 1)->get();
        return view('pages.envases.index', compact('containers'));
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
            $ml = $request->input('ml');
            $cost = $request->input('cost');

            $new_container = new Container();
            $new_container->ml   = $ml;
            $new_container->cost = $cost;
            $new_container->save();

            return redirect()->back()->with('success', 'Envase creado con exito.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Hubo un error al crear el envase');
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
            $containers_id = $request->input('containers_id');
            $container = Container::findOrFail($containers_id);

            $container->ml = $request->input('ml');
            $container->cost = $request->input('cost');
            $container->save();

            return redirect()->back()->with('success', 'Envase actualizado correctamente.');
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Envase no encontrado.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Ocurrió un error al actualizar el envase');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            // Encuentra el tipo de fragancia por su ID
            $container = Container::findOrFail($id);

            // Elimina el tipo de fragancia
            $container->state = 0;
            $container->save();

            return redirect()->back()->with('success', 'El envase fue eliminado con éxito.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Hubo un error al eliminar el envase');
        }
    }
}
