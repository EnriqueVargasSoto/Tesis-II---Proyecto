<?php

use App\Http\Controllers\Administracion\ClienteController;
use App\Http\Controllers\Administracion\TipoEmpleadoController;
use App\Http\Controllers\Administracion\EmpleadoController;
use App\Http\Controllers\Administracion\TipoMesaController;
use App\Http\Controllers\Administracion\TipoPlatoController;
use App\Http\Controllers\Administracion\MesaController;
use App\Http\Controllers\Mantenimiento\AmbienteController;
use App\Http\Controllers\Consultas\ConsultaController;
use App\Http\Controllers\Abastecimiento\UnidadController;
use App\Http\Controllers\Abastecimiento\InsumoController;
use App\Http\Controllers\Administracion\ProveedorController;
use App\Http\Controllers\Mantenimiento\DepositoController;
use App\Http\Controllers\Compras\DocCompraController;
use App\Http\Controllers\Mantenimiento\CajaController;
use App\Http\Controllers\Administracion\PlatoController;
use App\Http\Controllers\BebidaController;
use App\Http\Controllers\EmpresaPersonalController;
use App\Http\Controllers\Facturar\DocumentoVentaController;
use App\Http\Controllers\Facturar\FacturarController;
use App\Http\Controllers\Ventas\PedidoController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\Mantenimiento\NumeracionController;
use App\Http\Controllers\Reporte\ReporteController;
use App\Http\Controllers\TipoBebidaController;
use App\Models\Facturar\DocumentoVenta;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::get('/', function () {
    if (Auth::user()) {
        return view('Layout.index');
    } else {
        return view('auth.login');
    }
});

//--------Inicio de la Pagina
Route::prefix('Inicio')->group(function () {
    Route::get('/', [InicioController::class, 'index'])->name('Inicio')->middleware('auth');
});
//--------Clientes
Route::prefix('Cliente')->group(function () {
    Route::get('/', [ClienteController::class, 'index'])->name('Clientes.index')->middleware('auth');
    Route::get('/getTable', [ClienteController::class, 'getTable'])->name('Clientes.getTable')->middleware('auth');
    Route::get('/edit/{id}', [ClienteController::class, 'edit'])->name('Clientes.edit')->middleware('auth');
    Route::get('/crear', [ClienteController::class, 'crear'])->name('Clientes.crear')->middleware('auth');
    Route::post('/store', [ClienteController::class, 'store'])->name('Clientes.store')->middleware('auth');
    Route::put('/editar/{id}', [ClienteController::class, 'editar'])->name('Clientes.editar')->middleware('auth');
    Route::get('/eliminar/{id}', [ClienteController::class, 'eliminar'])->name('Clientes.eliminar')->middleware('auth');
});
//------Tipo Empleados
Route::prefix('TipoEmpleado')->group(function () {
    Route::get('/', [TipoEmpleadoController::class, 'index'])->name('TipoEmpleado.index')->middleware('auth');
    Route::get('/getTable', [TipoEmpleadoController::class, 'getTable'])->name('TipoEmpleado.getTable')->middleware('auth');
    Route::post('/store', [TipoEmpleadoController::class, 'store'])->name('TipoEmpleado.store')->middleware('auth');
    Route::put('/editar/{id}', [TipoEmpleadoController::class, 'editar'])->name('TipoEmpleado.editar')->middleware('auth');
    Route::get('/eliminar/{id}', [TipoEmpleadoController::class, 'eliminar'])->name('TipoEmpleado.eliminar')->middleware('auth');
});
//------Empleados
Route::prefix('Empleado')->group(function () {
    Route::get('/', [EmpleadoController::class, 'index'])->name('Empleados.index')->middleware('auth');
    Route::get('/getTable', [EmpleadoController::class, 'getTable'])->name('Empleados.getTable')->middleware('auth');
    Route::get('/edit/{id}', [EmpleadoController::class, 'edit'])->name('Empleados.edit')->middleware('auth');
    Route::get('/crear', [EmpleadoController::class, 'crear'])->name('Empleados.crear')->middleware('auth');
    Route::post('/store', [EmpleadoController::class, 'store'])->name('Empleados.store')->middleware('auth');
    Route::put('/editar/{id}', [EmpleadoController::class, 'editar'])->name('Empleados.editar')->middleware('auth');
    Route::get('/eliminar/{id}', [EmpleadoController::class, 'eliminar'])->name('Empleados.eliminar')->middleware('auth');
});
//------Tipo Mesa
Route::prefix('TipoMesa')->group(function () {
    Route::get('/', [TipoMesaController::class, 'index'])->name('TipoMesa.index')->middleware('auth');
    Route::get('/getTable', [TipoMesaController::class, 'getTable'])->name('TipoMesa.getTable')->middleware('auth');
    Route::post('/store', [TipoMesaController::class, 'store'])->name('TipoMesa.store')->middleware('auth');
    Route::put('/editar/{id}', [TipoMesaController::class, 'editar'])->name('TipoMesa.editar')->middleware('auth');
    Route::get('/eliminar/{id}', [TipoMesaController::class, 'eliminar'])->name('TipoMesa.eliminar')->middleware('auth');
    Route::get('/mesas/{id}', [TipoMesaController::class, 'mesas'])->name('TipoMesa.mesas')->middleware('auth');
});
//--------Mesa
Route::prefix('Mesa')->group(function () {
    Route::get('/getTable', [MesaController::class, 'getTable'])->name('Mesa.getTable')->middleware('auth');
    Route::post('/store', [MesaController::class, 'store'])->name('Mesa.store')->middleware('auth');
    Route::post('/editar', [MesaController::class, 'editar'])->name('Mesa.editar')->middleware('auth');
    Route::get('/eliminar', [MesaController::class, 'eliminar'])->name('Mesa.eliminar')->middleware('auth');
});

//-------------------Roles
Route::prefix('role')->group(function () {
    Route::get('/', [RoleController::class, 'index'])->name('roles.index')->middleware('auth')->middleware('auth');
    Route::get('/getTable', [RoleController::class, 'getTable'])->name('roles.getTable')->middleware('auth');
    Route::get('/registrar', [RoleController::class, 'create'])->name('roles.create')->middleware('auth')->middleware('auth');
    Route::post('/registrar', [RoleController::class, 'store'])->name('roles.store')->middleware('auth')->middleware('auth');
    Route::get('/actualizar/{id}', [RoleController::class, 'edit'])->name('roles.edit')->middleware('auth')->middleware('auth');
    Route::put('/actualizar/{id}', [RoleController::class, 'update'])->name('roles.update')->middleware('auth')->middleware('auth');
    Route::get('/datos/{id}', [RoleController::class, 'show'])->name('roles.show')->middleware('auth')->middleware('auth');
    Route::get('/destroy/{id}', [RoleController::class, 'destroy'])->name('roles.destroy')->middleware('auth')->middleware('auth');
});
//------Tipo Plato
Route::prefix('TipoPlato')->group(function () {
    Route::get('/', [TipoPlatoController::class, 'index'])->name('TipoPlato.index')->middleware('auth');
    Route::get('/getTable', [TipoPlatoController::class, 'getTable'])->name('TipoPlato.getTable')->middleware('auth');
    Route::post('/store', [TipoPlatoController::class, 'store'])->name('TipoPlato.store')->middleware('auth');
    Route::put('/editar/{id}', [TipoPlatoController::class, 'editar'])->name('TipoPlato.editar')->middleware('auth');
    Route::get('/eliminar/{id}', [TipoPlatoController::class, 'eliminar'])->name('TipoPlato.eliminar')->middleware('auth');
    Route::get('/platos/{id}', [TipoPlatoController::class, 'platos'])->name('TipoPlato.platos')->middleware('auth');
});
Route::prefix('TipoBebida')->group(function () {
    Route::get('/', [TipoBebidaController::class, 'index'])->name('TipoBebida.index')->middleware('auth');
    Route::get('/getTable', [TipoBebidaController::class, 'getTable'])->name('TipoBebida.getTable')->middleware('auth');
    Route::post('/store', [TipoBebidaController::class, 'store'])->name('TipoBebida.store')->middleware('auth');
    Route::put('/editar/{id}', [TipoBebidaController::class, 'editar'])->name('TipoBebida.editar')->middleware('auth');
    Route::get('/eliminar/{id}', [TipoBebidaController::class, 'eliminar'])->name('TipoBebida.eliminar')->middleware('auth');
    Route::get('/bebidas/{id}', [TipoBebidaController::class, 'bebidas'])->name('TipoBebida.bebidas')->middleware('auth');
});
//------Bebida
Route::prefix('Bebida')->group(function () {
    Route::get('/getTable', [BebidaController::class, 'getTable'])->name('Bebida.getTable')->middleware('auth');
    Route::post('/store', [BebidaController::class, 'store'])->name('Bebida.store')->middleware('auth');
    Route::post('/editar', [BebidaController::class, 'editar'])->name('Bebida.editar')->middleware('auth');
    Route::get('/eliminar', [BebidaController::class, 'eliminar'])->name('Bebida.eliminar')->middleware('auth');
    Route::get('/detalle', [BebidaController::class, 'detalle'])->name('Bebida.detalle')->middleware('auth');
});
//------Plato
Route::prefix('Plato')->group(function () {
    Route::get('/getTable', [PlatoController::class, 'getTable'])->name('Plato.getTable')->middleware('auth');
    Route::post('/store', [PlatoController::class, 'store'])->name('Plato.store')->middleware('auth');
    Route::post('/editar', [PlatoController::class, 'editar'])->name('Plato.editar')->middleware('auth');
    Route::get('/eliminar', [PlatoController::class, 'eliminar'])->name('Plato.eliminar')->middleware('auth');
    Route::get('/detalle', [PlatoController::class, 'detalle'])->name('Plato.detalle')->middleware('auth');
});
//------Ambiente
Route::prefix('Ambiente')->group(function () {
    Route::get('/', [AmbienteController::class, 'index'])->name('Ambiente.index')->middleware('auth');
    Route::get('/getTable', [AmbienteController::class, 'getTable'])->name('Ambiente.getTable')->middleware('auth');
    Route::post('/store', [AmbienteController::class, 'store'])->name('Ambiente.store')->middleware('auth');
    Route::put('/editar/{id}', [AmbienteController::class, 'editar'])->name('Ambiente.editar')->middleware('auth');
    Route::get('/eliminar/{id}', [AmbienteController::class, 'eliminar'])->name('Ambiente.eliminar')->middleware('auth');
    Route::get('/platos/{id}', [AmbienteController::class, 'platos'])->name('Ambiente.platos')->middleware('auth');
});
//------Unidad
Route::prefix('Unidad')->group(function () {
    Route::get('/', [UnidadController::class, 'index'])->name('Unidad.index')->middleware('auth');
    Route::get('/getTable', [UnidadController::class, 'getTable'])->name('Unidad.getTable')->middleware('auth');
    Route::post('/store', [UnidadController::class, 'store'])->name('Unidad.store')->middleware('auth');
    Route::put('/editar/{id}', [UnidadController::class, 'editar'])->name('Unidad.editar')->middleware('auth');
    Route::get('/eliminar/{id}', [UnidadController::class, 'eliminar'])->name('Unidad.eliminar')->middleware('auth');
    Route::get('/platos/{id}', [UnidadController::class, 'platos'])->name('Unidad.platos')->middleware('auth');
});
//------Insumos
Route::prefix('Insumo')->group(function () {
    Route::get('/', [InsumoController::class, 'index'])->name('Insumo.index')->middleware('auth');
    Route::get('/getTable', [InsumoController::class, 'getTable'])->name('Insumo.getTable')->middleware('auth');
    Route::post('/store', [InsumoController::class, 'store'])->name('Insumo.store')->middleware('auth');
    Route::put('/editar/{id}', [InsumoController::class, 'editar'])->name('Insumo.editar')->middleware('auth');
    Route::get('/eliminar/{id}', [InsumoController::class, 'eliminar'])->name('Insumo.eliminar')->middleware('auth');
    Route::get('/platos/{id}', [InsumoController::class, 'platos'])->name('Insumo.platos')->middleware('auth');
});
//---Proveedor
Route::prefix('Proveedor')->group(function () {
    Route::get('/', [ProveedorController::class, 'index'])->name('Proveedor.index')->middleware('auth');
    Route::get('/getTable', [ProveedorController::class, 'getTable'])->name('Proveedor.getTable')->middleware('auth');
    Route::get('/edit/{id}', [ProveedorController::class, 'edit'])->name('Proveedor.edit')->middleware('auth');
    Route::get('/crear', [ProveedorController::class, 'crear'])->name('Proveedor.crear')->middleware('auth');
    Route::post('/store', [ProveedorController::class, 'store'])->name('Proveedor.store')->middleware('auth');
    Route::put('/editar/{id}', [ProveedorController::class, 'editar'])->name('Proveedor.editar')->middleware('auth');
    Route::get('/eliminar/{id}', [ProveedorController::class, 'eliminar'])->name('Proveedor.eliminar')->middleware('auth');
});
//--Deposito
Route::prefix('Deposito')->group(function () {
    Route::get('/', [DepositoController::class, 'index'])->name('Deposito.index')->middleware('auth');
    Route::get('/getTable', [DepositoController::class, 'getTable'])->name('Deposito.getTable')->middleware('auth');
    Route::post('/store', [DepositoController::class, 'store'])->name('Deposito.store')->middleware('auth');
    Route::put('/editar/{id}', [DepositoController::class, 'editar'])->name('Deposito.editar')->middleware('auth');
    Route::get('/eliminar/{id}', [DepositoController::class, 'eliminar'])->name('Deposito.eliminar')->middleware('auth');
    Route::get('/platos/{id}', [DepositoController::class, 'platos'])->name('Deposito.platos')->middleware('auth');
});
Route::prefix('Caja')->group(function () {
    Route::get('/', [CajaController::class, 'index'])->name('Caja.index')->middleware('auth');
    Route::get('/getTable', [CajaController::class, 'getTable'])->name('Caja.getTable')->middleware('auth');
    Route::get('/generar', [CajaController::class, 'generar'])->name('Caja.generar')->middleware('auth');
    Route::get('/eliminar/{id}', [CajaController::class, 'eliminar'])->name('Caja.eliminar')->middleware('auth');
    Route::prefix('aperturaCaja')->group(function () {
        Route::post('/registrarApertura', [CajaController::class, 'registrarApertura'])->name('Caja.aperturaCaja.registrar');
    });
    Route::prefix('cerrarCaja')->group(function () {
        Route::post('/registrarCierre', [CajaController::class, 'registrarCierre'])->name('Caja.cierreCaja.registrar');
    });
});
Route::prefix('DocCompra')->group(function () {
    Route::get('/', [DocCompraController::class, 'index'])->name('DocCompra.index')->middleware('auth');
    Route::get('/getTable', [DocCompraController::class, 'getTable'])->name('DocCompra.getTable')->middleware('auth');
    Route::get('/edit/{id}', [DocCompraController::class, 'edit'])->name('DocCompra.edit')->middleware('auth');
    Route::get('/crear', [DocCompraController::class, 'crear'])->name('DocCompra.crear')->middleware('auth');
    Route::post('/store', [DocCompraController::class, 'store'])->name('DocCompra.store')->middleware('auth');
    Route::put('/editar/{id}', [DocCompraController::class, 'editar'])->name('DocCompra.editar')->middleware('auth');
    Route::get('/eliminar/{id}', [DocCompraController::class, 'eliminar'])->name('DocCompra.eliminar')->middleware('auth');
});
Route::prefix('Pedido')->group(function () {
    Route::get('/', [PedidoController::class, 'index'])->name('Pedido.index')->middleware('auth');
    Route::post('/registrarPedido', [PedidoController::class, 'registrar'])->name('Pedido.Mesa.registar')->middleware('auth');
    Route::post('/estadoPedido', [PedidoController::class, 'estadoPedido'])->name('Pedido.Mesa.estadoPedido')->middleware('auth');
    Route::get('/tipoAlimento', [PedidoController::class, 'tipoAlimento'])->name('Pedido.Mesa.tipoAlimento')->middleware('auth');

    Route::prefix('documentoVenta')->group(function () {
        Route::get('/', [DocumentoVentaController::class, 'index'])->name('documentoVenta.index');
        Route::get('/getTable', [DocumentoVentaController::class, 'getTable'])->name('documentoVenta.getTable');
        Route::get('/ticket/{id}', [DocumentoVentaController::class, 'ticket'])->name('documentoVenta.ticket');
        Route::post('/boletaStore', [DocumentoVentaController::class, 'boletaStore'])->name('documentoVenta.boletaStore');
        Route::post('/facturaStore', [DocumentoVentaController::class, 'facturaStore'])->name('documentoVenta.facturaStore');
        Route::post('/sunat/{id}',[DocumentoVentaController::class,'sunat'])->name('documentoVenta.sunat');
    });
});
Route::prefix('Facturar')->group(function () {
    Route::get('/', [FacturarController::class, 'index'])->name('Facturar.index')->middleware('auth');
    Route::post('/pago', [FacturarController::class, 'pago'])->name('Facturar.pago')->middleware('auth');
});
Route::prefix('Reporte')->group(function () {
    Route::get('/pedido/index', [ReporteController::class, 'reportepedidoindex'])->name('Reporte.pedido.index');
    Route::get('/pedidoget', [ReporteController::class, 'reportepedidoget'])->name('Reporte.pedidoget');
    Route::get('/pedidoget/pdf/{id}', [ReporteController::class, 'reportepedidogetpdf'])->name('Reporte.pedidoget.pdf');
    Route::get('/venta/index', [ReporteController::class, 'reportePedidoVentaindex'])->name('Reporte.venta.index');
    Route::get('/ventaget', [ReporteController::class, 'reportePedidoVentaGet'])->name('Reporte.ventaget');
    Route::get('/producto/index', [ReporteController::class, 'reportePedidoProductoindex'])->name('Reporte.producto.index');
    Route::get('/productoget', [ReporteController::class, 'reportePedidoProductoGet'])->name('Reporte.productoget');
});
Route::prefix('empresaPersonal')->group(function () {
    Route::get('/index', [EmpresaPersonalController::class, 'index'])->name('EmpresaPersonal.index');
    Route::get('/empresaPersonal', [EmpresaPersonalController::class, 'getEmpresaPersonal'])->name('EmpresaPersonal.empresaPersonal');
    Route::post('/store', [EmpresaPersonalController::class, 'store'])->name('EmpresaPersonal.store');
});
Route::prefix('numeracion')->middleware('auth')->group(function () {
    Route::get('/index', [NumeracionController::class, 'index'])->name('numeracion.index');
    Route::post('/store', [NumeracionController::class, 'store'])->name('numeracion.store');
    Route::post('/update/{id}', [NumeracionController::class, 'update'])->name('numeracion.update');
    Route::post('/destroy/{id}', [NumeracionController::class, 'destroy'])->name('numeracion.destroy');
    Route::post('/seleccionar/{id}', [NumeracionController::class, 'seleccionar'])->name('numeracion.seleccionar');
    Route::post('/deseleccionar/{id}', [NumeracionController::class, 'deseleccionar'])->name('numeracion.deseleccionar');
    Route::get('/getList', [NumeracionController::class, 'getList'])->name('numeracion.getList');
    Route::get('/getListNumeracion', [NumeracionController::class, 'getListNumeracion'])->name('tipoDocumento.getList');
});
Route::prefix('Consulta')->group(function () {
    Route::get('/getAmbiente', [ConsultaController::class, 'ambientes'])->name('Consulta.getAmabientes');
    Route::get('/getInsumos', [ConsultaController::class, 'insumos'])->name('Consulta.getInsumos');
    Route::get('/getCaja', [ConsultaController::class, 'caja'])->name('Consulta.getCaja');
    Route::get('/getPlatos', [ConsultaController::class, 'platos'])->name('Consulta.getPlatos');
    Route::get('/getMesas', [ConsultaController::class, 'mesas'])->name('Consulta.getMesas');
    Route::get('/getMonedas', [ConsultaController::class, 'monedas'])->name('Consulta.getMonedas');
    Route::get('/getBilletes', [ConsultaController::class, 'billetes'])->name('Consulta.getBilletes');
    Route::get('/getCentimos', [ConsultaController::class, 'centimos'])->name('Consulta.getCentimos');
    Route::get('/getPedidosMesas/{estado}', [ConsultaController::class, 'pedidosMesas'])->name('Consulta.getPedidosMesas');
    Route::get('/getPedidosDelivery/{estado}', [ConsultaController::class, 'pedidosDelivery'])->name('Consulta.getpedidosDelivery');
    Route::get('/getTipoTarjeta', [ConsultaController::class, 'tipoTarjeta'])->name('Consulta.getTipoTarjeta');
    Route::get('/getTarjetas/{tipo}', [ConsultaController::class, 'tarjetas'])->name('Consulta.getTarjetas');
    Route::get('/getTarjetasConsumo', [ConsultaController::class, 'tarjetasConsumo'])->name('Consulta.getTarjetasConsumo');
    Route::get('/verificarCaja', [ConsultaController::class, 'verificarCaja'])->name('Consulta.verificarCaja');
    Route::get('/getReporteAdmin', [ConsultaController::class, 'reporteAdmin'])->name('Consulta.getReporteAdmin');
    Route::get('/getVentas', [ConsultaController::class, 'getVentas'])->name('Consulta.getVentas');
    Route::get('/getTotalEstadoPedido/{pedido}', [ConsultaController::class, 'getTotalEstadoPedido'])->name('Consulta.getTotalEstadoPedido');
    Route::get('/getClienteMasPedidos', [ConsultaController::class, 'getClienteMasPedidos'])->name('Consulta.getClienteMasPedidos');
    Route::get('/getReportesVentasGraph', [ConsultaController::class, 'getReportesVentasGraph'])->name('Consulta.getReportesVentasGraph');
    Route::get('/getReportesTarjetasGraph', [ConsultaController::class, 'getReportesTarjetasGraph'])->name('Consulta.getReportesTarjetasGraph');
    Route::get('/getReportesProductosGraph', [ConsultaController::class, 'getReportesProductosGraph'])->name('Consulta.getReportesProductosGraph');
    Route::get('/getReportesEmpleadoGraph', [ConsultaController::class, 'getReportesEmpleadoGraph'])->name('Consulta.getReportesEmpleadoGraph');
    Route::get('/getHelp',[ConsultaController::class,'getHelp'])->name('Consulta.getHelp');
});
