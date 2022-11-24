<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/login_user',[ApiController::class,'login'])->name('login');
Route::post('/create_user',[ApiController::class,'createUser'])->name('createUser');
Route::get('/tipo_platos',[ApiController::class,'tipoplatos'])->name('getTipoPlatos');
Route::get('/tipo_bebidas',[ApiController::class,'tipobebidas'])->name('getTipoBebidas');
Route::get('/top_productos',[ApiController::class,'topproductos'])->name('getTopProductos');
Route::post('/platos',[ApiController::class,'platos'])->name('getPlatos');
Route::post('/bebidas',[ApiController::class,'bebidas'])->name('getBebidas');
Route::post('/pedidos',[ApiController::class,'pedidos'])->name('getPedidos');
Route::post('/detallePedido',[ApiController::class,'detallePedido'])->name('getDetallePedido');
Route::post('/pedidohoy',[ApiController::class,'pedidoHoy'])->name('getPedidoHoy');
Route::post('/getUser',[ApiController::class,'datosUsuario'])->name('getUser');
Route::post('/store_pedido_delivery',[ApiController::class,'storePedidoDelivery'])->name('storePedidoDelivery');

