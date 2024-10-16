<?php

namespace App\Http\Controllers;

use App\Models\BranchStock;
use App\Models\Customer;
use App\Models\Fragrance;
use App\Models\Sale;
use App\Models\Typeofpayment;
use App\Models\TypePayment;
use App\Models\User;
use App\Models\UserBranch;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected function getMonthsArray()
    {
        return [
            1 => 'Enero',
            2 => 'Febrero',
            3 => 'Marzo',
            4 => 'Abril',
            5 => 'Mayo',
            6 => 'Junio',
            7 => 'Julio',
            8 => 'Agosto',
            9 => 'Septiembre',
            10 => 'Octubre',
            11 => 'Noviembre',
            12 => 'Diciembre'
        ];
    }
    public function index()
    {
        $userRole = auth()->user()->idRole;
        $idUser = auth()->user()->id;

        // Obtener los clientes asociados al usuario
        $customers = Customer::where('idUser', $idUser)->where('state', 1)->get();

        // Obtener el stock de los perfumes asociados a los branches del usuario
        $stock = UserBranch::join('branch_stock', 'user_branch.branch_id', '=', 'branch_stock.branch_id')
            ->join('fragrance', 'branch_stock.fragrance_id', '=', 'fragrance.fragrance_id')
            ->join('containers', 'branch_stock.containers_id', '=', 'containers.containers_id')
            ->where('user_branch.user_id', $idUser)
            ->select(
                'fragrance.name_fragrance as fragrance_name',
                'fragrance.fragrance_id',
                'branch_stock.branchstock_id',
                'branch_stock.stock',
                'containers.ml',
                'containers.cost'
            )
            ->get();

        $typePayment = TypePayment::where('state', 1)->get();

        //ADMIN
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

        $cantFragrances = Fragrance::where('state', 1)->count();
        $cantUsers = User::where('state', 1)->count();

        $topSellers = DB::table('sales')
            ->select('sales.idUser', 'users.name', 'users.cellphone', DB::raw('COUNT(sales.idUser) as quantity'))
            ->join('users', 'sales.idUser', '=', 'users.id')
            ->whereBetween('sales.date', [$startDate, $endDate])
            ->groupBy('sales.idUser', 'users.name', 'users.cellphone')
            ->orderBy('quantity', 'desc')
            ->limit(5)
            ->get();

        return view('dashboard', compact('userRole', 'customers', 'stock', 'typePayment', 'currentMonthName', 'totalIncome', 'totalSales', 'cantFragrances', 'cantUsers', 'topSellers'));
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
