<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Customer;
use App\Models\Role;
use App\Models\Sale;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::join('roles', 'users.idRole', '=', 'roles.id')
            ->where('users.state', 1)
            ->select('users.*', 'roles.name as role_name')
            ->get();
        $roles = Role::all();
        $branch = Branch::where('state', 1)->get();

        return view('pages.usuarios.index', compact('users', 'roles', 'branch'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    public function profile()
    {

        return view('pages.usuarios.perfil');
    }

    public function sellers_list()
    {
        $idUser = Auth::user()->id;

        // Encontrar el branch_id del usuario autenticado
        $branchId = DB::table('user_branch')
            ->where('user_id', $idUser)
            ->value('branch_id');

        // Obtener todos los usuarios que están en el mismo branch_id excepto el usuario autenticado
        $users = User::join('user_branch', 'users.id', '=', 'user_branch.user_id')
            ->where('user_branch.branch_id', $branchId)
            ->where('users.id', '!=', $idUser) // Excluir el usuario autenticado
            ->get();


        return view('pages.usuarios.sellers', compact('users'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar la entrada
        try {
            $name = $request->input('name');
            $cellphone = $request->input('cellphone');
            $idRole = $request->input('idRole');
            $email = $request->input('email');
            $dni = $request->input('dni');
            $password = $request->input('password');

            // Verificar si el DNI o el celular ya existen en la base de datos
            if (User::where('dni', $dni)->exists()) {
                return redirect()->back()->with('error', 'El DNI ya está en uso.')
                    ->withInput()
                    ->withErrors(['roles' => 'Se necesita la lista de roles']);
            }

            if (User::where('cellphone', $cellphone)->exists()) {
                return redirect()->back()->with('error', 'El número de celular ya está en uso.')
                    ->withInput()
                    ->withErrors(['roles' => 'Se necesita la lista de roles']);
            }

            // Crear un nuevo usuario
            $user = new User();
            $user->name = $name;
            $user->cellphone = $cellphone;
            $user->idRole = $idRole;
            $user->email = $email;
            $user->dni = $dni;
            $user->password = bcrypt($password);
            $user->save();

            return redirect()->route('usuarios.index')->with('success', 'Nuevo usuario creado con éxito.');
        } catch (\Exception $e) {
            Log::error('Error al crear un nuevo usuario: ' . $e->getMessage(), [
                'request_data' => $request->all(),
                'stack_trace' => $e->getTraceAsString()
            ]);
            $roles = Role::all(); // Asegúrate de pasar los roles necesarios
            return redirect()->route('usuarios.index')->with('error', 'Hubo un error al crear nuevo usuario: ' . $e->getMessage())
                ->withInput()
                ->with('roles', $roles);
        }
    }


    public function show_details($id)
    {
        $user = User::findOrFail($id);
        $customers = Customer::where('state', 1)
            ->where('idUser', $id)->get();

        return view('pages.usuarios.users_details', compact('user', 'customers', 'id'));
    }

    public function filterByDate(Request $request)
    {
        // Validar la entrada
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // Obtener los datos del formulario
        $id = $request->input('id');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $formattedStartDate = \Carbon\Carbon::parse($startDate)->format('d/m/Y');
        $formattedEndDate = \Carbon\Carbon::parse($endDate)->format('d/m/Y');
        // Obtener el usuario y sus clientes asociados
        $user = User::findOrFail($id);
        $customers = Customer::where('state', 1)
            ->where('idUser', $id)->get();

        // Obtener las ventas filtradas por fecha y unirse con branch_stock, containers, fragrance y customers
        $filteredData = Sale::where('sales.idUser', $id)
            ->whereBetween('sales.date', [$startDate, $endDate])
            ->join('branch_stock', 'sales.branchstock_id', '=', 'branch_stock.branchstock_id')
            ->join('containers', 'branch_stock.containers_id', '=', 'containers.containers_id')
            ->join('fragrance', 'branch_stock.fragrance_id', '=', 'fragrance.fragrance_id')
            ->join('customers', 'sales.customers_id', '=', 'customers.customers_id')
            ->select('sales.date', 'fragrance.name_fragrance', 'containers.ml', 'containers.cost', 'customers.name as nombre_cliente')
            ->get();

        // Calcular la suma total de los costos
        $totalCost = $filteredData->sum('cost');

        // Pasar los datos a la vista
        return view('pages.usuarios.users_details', compact('user', 'customers', 'filteredData', 'totalCost', 'formattedStartDate', 'formattedEndDate', 'id'));
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
        try {
            $id = $request->input('id');
            $user = User::findOrFail($id);

            $user->name = $request->input('name');
            $user->cellphone = $request->input('cellphone');
            $user->email = $request->input('email');
            if (!empty($request->input('password'))) {
                $user->password = Hash::make($request->input('password'));
            }

            $user->save();

            return redirect()->back()->with('success', 'Usuario actualizado correctamente.');
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Usuario no encontrado.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Ocurrió un error al actualizar el usuario: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $type = User::findOrFail($id);

            $type->state = 0;
            $type->save();

            return redirect()->back()->with('success', 'El usuario fue eliminado con éxito.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Hubo un error al eliminar el usuario: ');
        }
    }
    public function myprofile_update(Request $request)
    {
        try {
            $user = $request->user();

            // Validación de datos
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'cellphone' => 'required|string|max:15',
                'dni' => 'required|string|max:15',
                'password' => 'nullable|string|min:5|confirmed',
            ]);

            // Actualización de datos
            $user->name = strtoupper($validatedData['name']); // Convertir nombre a mayúsculas
            $user->email = $validatedData['email'];
            $user->cellphone = $validatedData['cellphone'];
            $user->dni = $validatedData['dni'];

            // Actualizar contraseña solo si se proporciona
            if ($request->filled('password')) {
                $user->password = Hash::make($validatedData['password']);
            }

            $user->save();

            // Redirigir con mensaje de éxito
            return redirect()->back()->with('success', __('Perfil actualizado con éxito.'));
        } catch (Exception $e) {
            // Redirigir con mensaje de error
            return redirect()->back()->with('error', __('Hubo un error al actualizar el perfil: ') . $e->getMessage());
        }
    }
}
