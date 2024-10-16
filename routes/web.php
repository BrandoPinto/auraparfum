<?php

use App\Http\Controllers\almacen\AlmacenController;
use App\Http\Controllers\almacen\FuturoStockController;
use App\Http\Controllers\almacen\HistorialController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Ingresos\IngresosController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Perfume\EnvaseController;
use App\Http\Controllers\Perfume\PerfumeController;
use App\Http\Controllers\Perfume\TiposPerfumeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\Service\ServiceController;
use App\Http\Controllers\sucursales\SucursalesController;
use App\Http\Controllers\Users\UsersController;
use App\Http\Controllers\Ventas\VentasController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('content.authentications.auth-login-basic');
});
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    //Almacen:
    Route::resource('/almacen', AlmacenController::class);

    //Historial
    Route::resource('/historial', HistorialController::class);

    //Futuro
    Route::resource('/futuro', FuturoStockController::class);
    Route::post('/futuro/update/{id}', [FuturoStockController::class, 'update'])->name('futuro.update');


    //Customer
    Route::get("/perfumes/listado", [CustomerController::class, 'index'])->name('perfumes');
    Route::post("/nuevo-cliente", [CustomerController::class, 'store'])->name('new.customer');

    //Perfume
    Route::resource('/perfumes', PerfumeController::class);
    Route::resource('/tipos', TiposPerfumeController::class);
    Route::post('/perfumes/stock', [PerfumeController::class, 'stock_branch'])->name('stock.sucursal');

    //Envases
    Route::resource('/envases', EnvaseController::class);

    //Sucursales
    Route::resource('/sucursales', SucursalesController::class);
    Route::post('/sucursales/assignTeamLeader', [SucursalesController::class, 'assignTeamLeader'])->name('sucursales.assignTeamLeader');
    Route::post('/sucursales/assignSeller', [SucursalesController::class, 'assignSeller'])->name('sucursales.assignSeller');
    Route::post('/sucursales/desasignarSeller', [SucursalesController::class, 'desasignarSeller'])->name('sucursales.desasignarSeller');
    Route::post('sucursales/desasignar/{teamLeaderId}/{branchId}', [SucursalesController::class, 'desasignarTeamLeader'])->name('sucursales.desasignar');
    Route::post('/sucursales/nuevo/vendedor', [SucursalesController::class, 'new_seller'])->name('new.seller');
    Route::get('/sucursales/{branch_id}', [SucursalesController::class, 'show'])->name('sucursales.show');
    Route::get('/sucursales/usuario/listado', [SucursalesController::class, 'sucursal_usuario'])->name('sucursal.usuario.listado');
    Route::post('/sucursales/usuario/detalle', [SucursalesController::class, 'sucursal_usuario_detalle'])->name('sucursal.usuario.detalle');


    //Users
    Route::resource('/usuarios', UsersController::class);
    Route::get('/users/{id}/profile', [UsersController::class, 'showProfile'])->name('users.profile');
    Route::get('/usuarios/mi/perfil', [UsersController::class, 'profile'])->name('users.my.profile');
    Route::get('/vendedores', [UsersController::class, 'sellers_list'])->name('sellers.list');
    Route::put('/users/actualizar/perfil', [UsersController::class, 'myprofile_update'])->name('users.update.profile');


    Route::get('/usuarios/{id}/detalles', [UsersController::class, 'show_details'])->name('users.profile');
    Route::get('/filter-by-date', [UsersController::class, 'filterByDate'])->name('filter.by.date');

    //Clientes
    Route::resource('/clientes', ClientesController::class);


    //Ingresos
    Route::resource('/ingresos', IngresosController::class);
    Route::get('/ingresos', [IngresosController::class, 'index'])->name('ingresos.index');
    Route::post('/ingresos/data', [IngresosController::class, 'fetchData'])->name('ingresos.data');
    Route::get('/ingresos/usuarios/reporte', [IngresosController::class, 'ingresos_usuarios'])->name('ingresos.usuarios');
    Route::post('/ingresos/data/usuarios', [IngresosController::class, 'fetchDataUsers'])->name('ingresos.data.usuarios');

    //Ventas
    Route::resource('ventas', VentasController::class);

    //Services
    Route::get("/servicios", [ServiceController::class, 'index'])->name('services');
    Route::post('/nuevo/servicio', [ServiceController::class, 'store'])->name('new.service');
});

require __DIR__ . '/auth.php';
