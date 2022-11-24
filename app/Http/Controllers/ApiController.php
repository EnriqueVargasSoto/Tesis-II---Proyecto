<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\Abastecimiento\TipoBebida;
use App\Models\Administracion\Cliente;
use App\Models\Bebida;
use App\Models\Plato;
use App\Models\Producto;
use App\Models\TipoPedido;
use App\Models\TipoPlato;
use App\Models\UserApp;
use App\Models\UserAppCliente;
use App\Models\Ventas\DetallePedido;
use App\Models\Ventas\DetallePedidoUbicacion;
use App\Models\Ventas\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    public function login(Request $request)
    {
        $consulta = UserApp::where('email', $request->email);
        return $consulta->count() != 0 ? (Hash::check($request->password, $consulta->first()->password) ? new UserResource($consulta->first()) : "Error") : "Error";
    }
    public function createUser(Request $request)
    {
        $message = "El usuario ya se registro";
        if (UserApp::where('email', $request->email)->count() == 0) {
            $data = $request->only(['email', 'password']);
            $data['password'] = bcrypt($request->password);
            $data['name'] = $request->nombres;
            $user = UserApp::create($data);
            $dataCliente = $request->except(['email', 'password']);
            $cliente = Cliente::create($dataCliente);
            $cliente->nombre=$request->nombres." ".$request->apellidoPaterno." ".$request->apellidoMaterno;
            $cliente->correo=$request->email;
            $cliente->save();
            $user_cliente = new UserAppCliente();
            $user_cliente->user_id = $user->id;
            $user_cliente->cliente_id = $cliente->id;
            $user_cliente->save();
            $message = "Exito";
        }
        return $message;
    }
    public function tipoplatos()
    {
        return TipoPlato::cursor()->filter(function ($plato) {
            $plato->url_imagen = "http://" . $_SERVER['SERVER_NAME'] . ":9000/" . str_replace('public', 'storage', $plato->url_imagen);
            return true;
        });
    }
    public function tipobebidas()
    {
        return TipoBebida::cursor()->filter(function ($bebida) {
            $bebida->url_imagen = "http://" . $_SERVER['SERVER_NAME'] . ":9000/" . str_replace('public', 'storage', $bebida->url_imagen);
            return true;
        });
    }
    public function platos(Request $request)
    {
        return Plato::where('tipoplato_id', $request->id)->get()->map(function ($plato) {
            $producto = $plato->producto;
            $producto->url_imagen = "http://" . $_SERVER['SERVER_NAME'] . ":9000/" . str_replace('public', 'storage', $producto->url_imagen);
            return $producto;
        });
    }
    public function bebidas(Request $request)
    {
        return Bebida::where('tipobebida_id', $request->id)->get()->map(function ($bebida) {
            $producto = $bebida->producto;
            $producto->url_imagen = "http://" . $_SERVER['SERVER_NAME'] . ":9000/" . str_replace('public', 'storage', $producto->url_imagen);
            return $producto;
        });
    }
    public function topproductos()
    {
        $pedidosDelivery = TipoPedido::where('tipo_pedido', 'Delivery')->first()->pedidos;

        if ($pedidosDelivery->count() == 0) {
            return Producto::take(5)->get()->map(function ($producto) {
                $producto->url_imagen = "http://" . $_SERVER['SERVER_NAME'] . ":9000/" . str_replace('public', 'storage', $producto->url_imagen);
                $producto;
            });
        } else {
            return DB::table("pedido as p")
                ->join("detalle_pedido as dp", "dp.pedido_id", "=", "p.id")
                ->join("producto as pr", "pr.id", "=", "dp.producto_id")
                ->selectRaw("pr.id,count(pr.id) as cantidad ")
                ->groupBy('pr.id')
                ->take(5)
                ->get()->map(function ($producto) {
                    $producto = Producto::findOrFail($producto->id);
                    $producto->url_imagen = "http://" . $_SERVER['SERVER_NAME'] . ":9000/" . str_replace('public', 'storage', $producto->url_imagen);
                    return $producto;
                });
        }
    }
    public function storePedidoDelivery(Request $request)
    {
        $detallepedido = json_decode($request->detalle);
        $user = UserApp::findOrFail($request->user_id);
        $pedidoDelivery = new Pedido();
        $pedidoDelivery->tipo_id = 2;
        $pedidoDelivery->cliente_id = $user->user_cliente->cliente->id;
        $pedidoDelivery->total = $request->total;
        $pedidoDelivery->save();
        $pedidoUbicacion = new DetallePedidoUbicacion();
        $pedidoUbicacion->latitud = $request->latitud;
        $pedidoUbicacion->longitud = $request->longitud;
        $pedidoUbicacion->direccion = $request->direccion;
        $pedidoUbicacion->pedido_id = $pedidoDelivery->id;
        $pedidoUbicacion->save();
        foreach ($detallepedido as $key => $value) {
            $detalle = new DetallePedido();
            $detalle->pedido_id = $pedidoDelivery->id;
            $detalle->producto_id = $value->id;
            $detalle->cantidad = $value->cantidad;
            $detalle->save();
        }
        return "Registro con Exito";
    }
    public function pedidos(Request $request)
    {
        $cliente = UserApp::findOrFail($request->user_id)->user_cliente->cliente;
        return $cliente->pedidos()->get()->map(function ($pedido) {
            unset($pedido->tipo_id);
            unset($pedido->cliente_id);
            $pedido->fecha = $pedido->created_at->format('Y-m-d h:i:s');
            $pedido->direccion = $pedido->pedido_ubicacion->direccion;
            unset($pedido->pedido_ubicacion);
            unset($pedido->created_at);
            unset($pedido->updated_at);
            return $pedido;
        });
    }
    public function pedidoHoy(Request $request)
    {

        return DB::table('pedido as p')
            ->join('clientes as c', 'c.id', '=', 'p.cliente_id')
            ->join('user_appcliente as uac', 'uac.cliente_id', '=', 'c.id')
            ->join('user_app as ua', 'ua.id', '=', 'uac.user_id')
            ->where('ua.id', $request->user_id)
            ->where('p.estado_pedido', 'PENDIENTE')
            ->whereDate('p.created_at', date('Y-m-d'))->count();
        //Si el valor es 0 , es que no hay un pedido pendiente de este cliente
    }
    public function datosUsuario(Request $request)
    {
        $cliente = UserApp::findOrFail($request->user_id)->user_cliente->cliente;
        $cliente->cantidadPedidos = $cliente->pedidos()->count();
        unset($cliente->created_at);
        unset($cliente->updated_at);
        return $cliente;
    }
    public function updateUsuario(Request $request)
    {
        $cliente = UserApp::findOrFail($request->user_id)->user_cliente->cliente;
        $cliente->nombres = $request->nombres;
        $cliente->apellidoPaterno = $request->apellidoPaterno;
        $cliente->apellidoMaterno = $request->apellidoMaterno;
        $cliente->dni = $request->dni;
        $cliente->telefono = $request->telefono;
        $cliente->direccion = $request->direccion;
        $cliente->save();
        return "Registro con Exito";
    }
    public function updatePassword(Request $request)
    {
        $consulta = UserApp::where('email', $request->email);
        if ($consulta->count() != 0) {
            if (Hash::check($request->password, $consulta->first()->password)) {
                $user = UserApp::findOrFail($consulta->first()->id);
                $user->password = bcrypt($request->password);
                $user->save();
                return "Contraseña Cambiada con Exito";
            } else {
                return "Ocurrio un Error";
            }
        } else {
            return "Ocurrio un Error";
        }
    }
    public function detallePedido(Request $request)
    {
        return Pedido::findOrFail($request->pedido_id)->detalle()->get()->map(function ($detalle) {

            $detalle->producto;
            unset($detalle->producto_id);
            unset($detalle->created_at);
            unset($detalle->updated_at);
            //producto
            $detalle->producto_id = $detalle->producto->id;
            $detalle->producto_imagen = $detalle->producto->url_imagen;
            $detalle->producto_precio = $detalle->producto->precio;
            $detalle->producto_nombre = $detalle->producto->nombre;
            $detalle->producto_imagen = "http://" . $_SERVER['SERVER_NAME'] . ":9000/" . str_replace('public', 'storage', $detalle->producto_imagen);
            unset($detalle->producto);

            return $detalle;
        });
    }
}
