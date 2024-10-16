<?php

namespace App\Http\Controllers\Ingresos;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IngresosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected function getMonthsArray()
    {
        return [
            1 => 'ENERO',
            2 => 'FEBRERO',
            3 => 'MARZO',
            4 => 'ABRIL',
            5 => 'MAYO',
            6 => 'JUNIO',
            7 => 'JULIO',
            8 => 'AGOSTO',
            9 => 'SEPTIEMBRE',
            10 => 'OCTUBRE',
            11 => 'NOVIEMBRE',
            12 => 'DICIEMBRE'
        ];
    }

    public function index(Request $request)
    {
        // Define las fechas de inicio y fin para el mes actual
        $startDate = Carbon::now()->startOfMonth()->format('Y-m-d');
        $endDate = Carbon::now()->endOfMonth()->format('Y-m-d');

        // Obtén los datos filtrados
        $filteredData = Sale::whereBetween('sales.date', [$startDate, $endDate])
            ->join('branch_stock', 'sales.branchstock_id', '=', 'branch_stock.branchstock_id')
            ->join('containers', 'branch_stock.containers_id', '=', 'containers.containers_id')
            ->join('fragrance', 'branch_stock.fragrance_id', '=', 'fragrance.fragrance_id')
            ->join('customers', 'sales.customers_id', '=', 'customers.customers_id')
            ->join('users', 'sales.idUser', '=', 'users.id')
            ->select('sales.date', 'fragrance.name_fragrance', 'containers.ml', 'containers.cost', 'customers.name as nombre_cliente', 'users.name as nombre_vendedor')
            ->get();

        // Calcular los totales
        $totalIncome = $filteredData->sum('cost');
        $totalSales = $filteredData->count();

        // Array de nombres de meses en español
        $months = $this->getMonthsArray();

        // Obtener el mes actual en número y en nombre
        $currentMonthNumber = Carbon::now()->month;
        $currentMonthName = $months[$currentMonthNumber];

        // Usa compact para pasar datos a la vista
        return view('pages.ingresos.index', compact('startDate', 'endDate', 'filteredData', 'totalIncome', 'totalSales', 'currentMonthName'));
    }

    public function fetchData(Request $request)
    {
        // Obtener fechas desde el formulario
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Verificar que las fechas no estén vacías
        if (empty($startDate) || empty($endDate)) {
            return redirect()->route('incomes.index')->withErrors('Las fechas de inicio y fin son requeridas.');
        }

        // Obtener el mes en español basado en el primer día del rango de fechas
        $months = $this->getMonthsArray();
        $currentMonthNumber = Carbon::parse($startDate)->month;
        $currentMonthName = $months[$currentMonthNumber];

        // Obtener los datos filtrados por el rango de fechas
        $filteredData = Sale::whereBetween('sales.date', [$startDate, $endDate])
            ->join('branch_stock', 'sales.branchstock_id', '=', 'branch_stock.branchstock_id')
            ->join('containers', 'branch_stock.containers_id', '=', 'containers.containers_id')
            ->join('fragrance', 'branch_stock.fragrance_id', '=', 'fragrance.fragrance_id')
            ->join('customers', 'sales.customers_id', '=', 'customers.customers_id')
            ->join('users', 'sales.idUser', '=', 'users.id')
            ->select('sales.date', 'fragrance.name_fragrance', 'containers.ml', 'containers.cost', 'customers.name as nombre_cliente', 'users.name as nombre_vendedor')
            ->get();

        // Calcular los totales
        $totalIncome = $filteredData->sum('cost');
        $totalSales = $filteredData->count();

        // Usa compact para pasar datos a la vista
        return view('pages.ingresos.index', compact('startDate', 'endDate', 'filteredData', 'totalIncome', 'totalSales', 'currentMonthName'));
    }


    public function ingresos_usuarios()
    {
        $idUser = Auth::id();

        // Define las fechas de inicio y fin para el mes actual
        $startDate = Carbon::now()->startOfMonth()->format('Y-m-d');
        $endDate = Carbon::now()->endOfMonth()->format('Y-m-d');

        // Obtén los datos filtrados
        $filteredData = Sale::whereBetween('sales.date', [$startDate, $endDate])
            ->join('branch_stock', 'sales.branchstock_id', '=', 'branch_stock.branchstock_id')
            ->join('containers', 'branch_stock.containers_id', '=', 'containers.containers_id')
            ->join('fragrance', 'branch_stock.fragrance_id', '=', 'fragrance.fragrance_id')
            ->join('customers', 'sales.customers_id', '=', 'customers.customers_id')
            ->join('users', 'sales.idUser', '=', 'users.id')
            ->select('sales.date', 'fragrance.name_fragrance', 'containers.ml', 'containers.cost', 'customers.name as nombre_cliente', 'users.name as nombre_vendedor')
            ->where('sales.idUser', $idUser)
            ->get();

        // Calcular los totales
        $totalIncome = $filteredData->sum('cost');
        $totalSales = $filteredData->count();

        // Array de nombres de meses en español
        $months = $this->getMonthsArray();

        // Obtener el mes actual en número y en nombre
        $currentMonthNumber = Carbon::now()->month;
        $currentMonthName = $months[$currentMonthNumber];

        return view('pages.ingresos.usuarios.ingresos_usuarios', compact('startDate', 'endDate', 'filteredData', 'totalIncome', 'totalSales', 'currentMonthName'));
    }

    public function fetchDataUsers(Request $request)
    {
        $idUser = Auth::id();

        // Obtener fechas desde el formulario
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Verificar que las fechas no estén vacías
        if (empty($startDate) || empty($endDate)) {
            return redirect()->route('incomes.index')->withErrors('Las fechas de inicio y fin son requeridas.');
        }

        // Obtener el mes en español basado en el primer día del rango de fechas
        $months = $this->getMonthsArray();
        $currentMonthNumber = Carbon::parse($startDate)->month;
        $currentMonthName = $months[$currentMonthNumber];

        // Obtener los datos filtrados por el rango de fechas
        $filteredData = Sale::whereBetween('sales.date', [$startDate, $endDate])
            ->join('branch_stock', 'sales.branchstock_id', '=', 'branch_stock.branchstock_id')
            ->join('containers', 'branch_stock.containers_id', '=', 'containers.containers_id')
            ->join('fragrance', 'branch_stock.fragrance_id', '=', 'fragrance.fragrance_id')
            ->join('customers', 'sales.customers_id', '=', 'customers.customers_id')
            ->join('users', 'sales.idUser', '=', 'users.id')
            ->select('sales.date', 'fragrance.name_fragrance', 'containers.ml', 'containers.cost', 'customers.name as nombre_cliente')
            ->where('sales.idUser', $idUser)
            ->get();

        // Calcular los totales
        $totalIncome = $filteredData->sum('cost');
        $totalSales = $filteredData->count();

        // Usa compact para pasar datos a la vista
        return view('pages.ingresos.usuarios.ingresos_usuarios', compact('startDate', 'endDate', 'filteredData', 'totalIncome', 'totalSales', 'currentMonthName'));
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
