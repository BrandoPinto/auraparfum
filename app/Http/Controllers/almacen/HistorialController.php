<?php

namespace App\Http\Controllers\almacen;

use App\Http\Controllers\Controller;
use App\Models\StockHistory;
use Illuminate\Http\Request;

class HistorialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $history = StockHistory::join('warehouse', 'stock_history.warehouse_id', '=', 'warehouse.warehouse_id')
            ->join('fragrance', 'warehouse.fragrance_id', '=', 'fragrance.fragrance_id')
            ->join('containers', 'warehouse.containers_id', '=', 'containers.containers_id')
            ->join('branch', 'stock_history.branch_id', '=', 'branch.branch_id')
            ->select('fragrance.name_fragrance', 'containers.ml', 'branch.name_branch', 'stock_history.stock', 'stock_history.date')
            ->orderBy('stock_history.date', 'desc')
            ->get();

        return view('pages.historial.index', compact('history'));
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
        //
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
