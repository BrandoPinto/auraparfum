<?php

namespace App\Http\Controllers\sucursales;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\BranchStock;
use App\Models\TypeWork;
use App\Models\User;
use App\Models\UserBranch;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SucursalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener sucursales con la información del líder del equipo
        $branches = Branch::join('type_work', 'branch.typework_id', '=', 'type_work.typework_id')
            ->where('branch.state', 1)
            ->get();

        $types = TypeWork::where('state', 1)->get();
        return view('pages.sucursales.index', compact('branches', 'types'));
    }

    public function assignTeamLeader(Request $request)
    {
        $request->validate([
            'branch_id' => 'required|exists:branch,branch_id',
            'team_leader_id' => 'required|exists:users,id',
        ]);

        $existingAssignment = UserBranch::where('user_id', $request->team_leader_id)
            ->where('branch_id', $request->branch_id)
            ->first();

        if ($existingAssignment) {
            return redirect()->back()->with('error', 'El Team Leader ya está asignado a esta sucursal.');
        }

        $branch = new UserBranch();
        $branch->user_id = $request->team_leader_id;
        $branch->branch_id = $request->branch_id;
        $branch->save();

        return redirect()->back()->with('success', 'Team Leader asignado con éxito.');
    }
    public function assignSeller(Request $request)
    {
        $request->validate([
            'branch_id' => 'required|exists:branch,branch_id',
            'seller' => 'required|exists:users,id',
        ]);

        $exists = UserBranch::where('user_id', $request->seller)
            ->where('branch_id', $request->branch_id)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'El vendedor ya está asignado a esta sucursal.');
        }
        $branch = new UserBranch();
        $branch->user_id = $request->seller;
        $branch->branch_id = $request->branch_id;
        $branch->save();

        return redirect()->back()->with('success', 'Vendedor asignado con éxito.');
    }

    public function desasignarSeller(Request $request)
    {
        try {
            $branch_id = $request->input('branchId');
            $seller_id = $request->input('sellerId');

            // Registrar los datos recibidos para depuración
            Log::info('Branch ID recibido: ' . $branch_id);
            Log::info('Seller ID recibido: ' . $seller_id);

            // Elimina el registro de user_branch
            $deleted = DB::table('user_branch')
                ->where('branch_id', $branch_id)
                ->where('user_id', $seller_id)
                ->delete();

            if ($deleted) {
                return redirect()->route('sucursales.show', $branch_id)
                    ->with('success', 'Vendedor desasignado correctamente.');
            } else {
                return redirect()->route('sucursales.show', $branch_id)
                    ->with('error', 'No se encontró el Vendedor para desasignar.');
            }
        } catch (\Exception $e) {
            Log::error('Error al desasignar el Vendedor: ' . $e->getMessage());

            return redirect()->route('sucursales.show', $request->branchId)
                ->with('error', 'Ocurrió un error al desasignar el Vendedor.');
        }
    }

    public function desasignarTeamLeader(Request $request)
    {
        try {
            // Verifica los datos recibidos
            $branch_id = $request->input('branchId');
            $user_id = $request->input('teamLeaderId');

            // Registrar los datos recibidos para depuración
            Log::info('Branch ID recibido: ' . $branch_id);
            Log::info('User ID recibido: ' . $user_id);

            // Verifica si los datos están vacíos
            if (empty($branch_id) || empty($user_id)) {
                Log::error('Branch ID o User ID está vacío.');
                return redirect()->route('sucursales.show', ['branch_id' => $branch_id])
                    ->with('error', 'Los datos necesarios no se recibieron.');
            }

            // Elimina el registro de user_branch
            $deleted = DB::table('user_branch')
                ->where('branch_id', $branch_id)
                ->where('user_id', $user_id)
                ->delete();

            // Verifica si se eliminó algún registro
            if ($deleted) {
                return redirect()->route('sucursales.show', $branch_id)
                    ->with('success', 'Team Leader desasignado correctamente.');
            } else {
                return redirect()->route('sucursales.show', $branch_id)
                    ->with('error', 'No se encontró el Team Leader para desasignar.');
            }
        } catch (\Exception $e) {
            // Registrar el error
            Log::error('Error al desasignar el Team Leader: ' . $e->getMessage());

            // Redirige con un mensaje de error
            return redirect()->route('sucursales.show', $request->branchId)
                ->with('error', 'Ocurrió un error al desasignar el Team Leader.');
        }
    }

    public function show($branch_id)
    {
        try {
            // Obtén la sucursal
            $branch = Branch::findOrFail($branch_id);

            // Obtén el team leader y los vendedores usando la tabla user_branch
            $userBranches = UserBranch::where('branch_id', $branch_id)
                ->join('users', 'user_branch.user_id', '=', 'users.id')
                ->select('users.id', 'users.name', 'users.email', 'users.cellphone', 'users.idRole')
                ->get();

            // Filtra al team leader y los vendedores
            $team_leader = $userBranches->firstWhere('idRole', 2); // Solo un team leader
            $sellersBranches = $userBranches->where('idRole', 3); // Vendedores

            // Obtén el stock de la sucursal
            $stock = BranchStock::join('fragrance', 'branch_stock.fragrance_id', '=', 'fragrance.fragrance_id')
                ->join('containers', 'branch_stock.containers_id', '=', 'containers.containers_id')
                ->select('fragrance.name_fragrance', 'containers.ml', 'branch_stock.stock')
                ->where('branch_stock.branch_id', $branch_id)
                ->get();
            $teamLeaders = User::whereIn('idRole', [2])
                ->where('state', 1)
                ->get();

            $sellers = User::whereIn('idRole', [3])
                ->where('state', 1)
                ->get();

            return view('pages.sucursales.detalle', compact('branch', 'sellersBranches', 'branch_id', 'team_leader', 'stock', 'teamLeaders', 'sellers'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocurrió un error al obtener los datos de la sucursal.');
        }
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
            $name_branch = $request->input('name_branch');
            $location = $request->input('location') ?: null;
            $typework_id = $request->input('typework_id');

            $branch = new Branch();
            $branch->name_branch = $name_branch;
            $branch->location = $location;
            $branch->typework_id = $typework_id;
            $branch->state = 1;
            $branch->save();

            return redirect()->back()->with('success', 'Nueva sucursal creada con éxito.');
        } catch (\Exception $e) {
            Log::error('Error al crear la nueva sucursal: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Hubo un error al crear la nueva sucursal' . $e);
        }
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
                'name_branch' => 'required|string|max:255',
            ]);

            $branch_id = $request->input('branch_id');
            $branch = Branch::findOrFail($branch_id);

            $branch->name_branch = strtoupper($request->input('name_branch'));
            $branch->save();

            return redirect()->back()->with('success', 'Sucursal actualizada correctamente.');
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Sucursal no encontrada.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Ocurrió un error al actualizar la sucursal');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            // Encuentra el tipo de fragancia por su ID
            $type = Branch::findOrFail($id);

            // Elimina el tipo de fragancia
            $type->state = 0;
            $type->save();

            return redirect()->back()->with('success', 'Sucursal eliminada con éxito.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Hubo un error al eliminar sucursal');
        }
    }


    public function new_seller(Request $request)
    {
        try {
            // Validar los datos del formulario
            $request->validate([
                'name' => 'required|string|max:255',
                'cellphone' => 'required|numeric',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8',
                'branch_id' => 'required|exists:branch,branch_id',
            ]);

            // Crear el nuevo vendedor
            User::create([
                'name' => strtoupper($request->name),
                'cellphone' => $request->cellphone,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'branch_id' => $request->branch_id,
                'idRole' => 3,
            ]);

            // Redirigir con éxito
            return redirect()->route('sucursales.show', $request->branch_id)
                ->with('success', 'Vendedor agregado exitosamente');
        } catch (\Exception $e) {
            // Manejar el error y redirigir con un mensaje de error
            return redirect()->route('sucursales.show', $request->branch_id)
                ->with('error', 'Hubo un problema al agregar el vendedor: ' . $e->getMessage());
        }
    }
    public function sucursal_usuario()
    {
        // Obtén el ID del usuario autenticado
        $userId = Auth::id();

        // Obtén las sucursales asociadas a este usuario
        $branches = Branch::whereIn('branch_id', function ($query) use ($userId) {
            $query->select('branch_id')
                ->from('user_branch')
                ->where('user_id', $userId);
        })->get();

        // Pasa las sucursales a la vista
        return view('pages.sucursales.users.sucursal_user', compact('branches'));
    }

    public function sucursal_usuario_detalle(Request $request)
    {
        try {
            $branch_id = $request->input('branch_id');

            $stock = BranchStock::join('fragrance', 'branch_stock.fragrance_id', '=', 'fragrance.fragrance_id')
                ->join('containers', 'branch_stock.containers_id', '=', 'containers.containers_id')
                ->select('fragrance.name_fragrance', 'containers.ml', 'branch_stock.stock', 'containers.cost')
                ->where('branch_stock.branch_id', $branch_id)
                ->get();

            $stockBajo = $stock->filter(function ($item) {
                return $item->stock <= 5;
            });

            // Pasar los datos de stock a la vista
            return view('pages.sucursales.users.sucursal_detalle', compact('stock', 'stockBajo'));
        } catch (\Exception $e) {
            // Si ocurre un error, redirigir de nuevo con un mensaje de error
            Log::error('Error al crear la nueva sucursal: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al obtener los datos de stock.');
        }
    }
}
