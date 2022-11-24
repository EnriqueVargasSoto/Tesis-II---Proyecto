<li class="@yield('administracion-active')">
    <a href="{{ route('Inicio') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Home</span>
    </a>
</li>
@if (auth()->user()->can('haveaccess', 'clientes.index') ||
    auth()->user()->can('haveaccess', 'tipoDeEmpleados.index') ||
    auth()->user()->can('haveaccess', 'empleados.index') ||
    auth()->user()->can('haveaccess', 'proveedores.index'))
    <li class="@yield('administracion-active')">
        <a><i class="fa fa-th-large"></i> <span class="nav-label">Administracion</span>
            <span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
            @if (auth()->user()->can('haveaccess', 'clientes.index'))
                <li class="@yield('Clientes-active')"><a href="{{ route('Clientes.index') }}">Clientes</a></li>
            @endif
            @if (auth()->user()->can('haveaccess', 'tipoDeEmpleados.index'))
                <li class="@yield('TipoEmpleado-active')"><a href="{{ route('TipoEmpleado.index') }}">Tipo
                        Empleado</a>
                </li>
            @endif
            @if (auth()->user()->can('haveaccess', 'empleados.index'))
                <li class="@yield('Empleados-active')"><a href="{{ route('Empleados.index') }}">Empleados</a></li>
            @endif
            @if (auth()->user()->can('haveaccess', 'proveedores.index'))
                <li class="@yield('Proveedores-active')"><a href="{{ route('Proveedor.index') }}">Proveedores</a></li>
            @endif
        </ul>
    </li>
@endif
@if (auth()->user()->can('haveaccess', 'pedidos.index'))
    <li class="@yield('ventas-active')">
        <a><i class="fa fa-th-large"></i> <span class="nav-label">Pedidos</span>
            <span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
            @if (auth()->user()->can('haveaccess', 'pedidos.index'))
                <li class="@yield('PedidoMesa-active')"><a href="{{ route('Pedido.index') }}">Pedidos-Mesa</a></li>
            @endif
        </ul>
    </li>
@endif
@if (auth()->user()->can('haveaccess', 'facturar.index'))
    <li class="@yield('facturar-active')">
        <a><i class="fa fa-th-large"></i> <span class="nav-label">Facturar</span>
            <span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
            @if (auth()->user()->can('haveaccess', 'facturar.index'))
                <li class="@yield('PedidoFacturar-active')"><a
                        href="{{ route('Facturar.index') }}">Facturar-Pedidos</a></li>
            @endif
            @if (auth()->user()->can('haveaccess', 'documentoVenta.index'))
                <li class="@yield('documentoVenta-active')"><a
                        href="{{ route('documentoVenta.index') }}">Documento de Ventas</a></li>
            @endif
        </ul>
    </li>
@endif
@if (auth()->user()->can('haveaccess', 'documentoDeCompras.index'))
    <li class="@yield('compras-active')">
        <a><i class="fa fa-shopping-cart"></i> <span class="nav-label">Compras</span>
            <span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
            @if (auth()->user()->can('haveaccess', 'documentoDeCompras.index'))
                <li class="@yield('DocCompra-active')"><a href="{{ route('DocCompra.index') }}">Doc Compra</a></li>
            @endif
        </ul>
    </li>
@endif
@if (auth()->user()->can('haveaccess', 'reporte.pedidos') ||
    auth()->user()->can('haveaccess', 'reporte.ventas')||
    auth()->user()->can('haveaccess', 'reporte.productos'))
    <li class="@yield('reportes-active')">
        <a><i class="fa fa-file-o"></i> <span class="nav-label">Reportes</span>
            <span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
            @if (auth()->user()->can('haveaccess', 'reporte.pedidos'))
                <li class="@yield('ReportePedidos-active')"><a href="{{ route('Reporte.pedido.index') }}">Reportes
                        Pedidos</a></li>
            @endif
            @if (auth()->user()->can('haveaccess', 'reporte.ventas'))
                <li class="@yield('ReporteVentas-active')"><a href="{{ route('Reporte.venta.index') }}">Reportes
                        Ventas Grafico</a></li>
            @endif
            @if (auth()->user()->can('haveaccess', 'reporte.productos'))
                <li class="@yield('ReporteProductos-active')"><a href="{{ route('Reporte.producto.index') }}">Reportes
                        Productos Grafico</a></li>
            @endif
        </ul>
    </li>
@endif
@if (auth()->user()->can('haveaccess', 'roles.index') ||
    auth()->user()->can('haveaccess', 'tipoMesas.index') ||
    auth()->user()->can('haveaccess', 'tipoPlatos.index') ||
    auth()->user()->can('haveaccess', 'tipoBebidas.index') ||
    auth()->user()->can('haveaccess', 'insumos.index') ||
    auth()->user()->can('haveaccess', 'unidades.index'))
    <li class="@yield('abastecimiento-active')">
        <a><i class="fa fa-th-large"></i> <span class="nav-label">Abastecimiento</span>
            <span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
            @if (auth()->user()->can('haveaccess', 'roles.index'))
                <li class="@yield('roles-active')"><a href="{{ route('roles.index') }}">Roles</a></li>
            @endif
            @if (auth()->user()->can('haveaccess', 'tipoMesas.index'))
                <li class="@yield('TipoMesa-active')"><a href="{{ route('TipoMesa.index') }}">Tipos de Mesas</a></li>
            @endif
            {{-- <li class="@yield('mesas-active')"><a href="index.html">Mesas</a></li> --}}
            @if (auth()->user()->can('haveaccess', 'tipoPlatos.index'))
                <li class="@yield('TipoPlato-active')"><a href="{{ route('TipoPlato.index') }}">Tipos de Platos</a>
                </li>
            @endif
            @if (auth()->user()->can('haveaccess', 'tipoBebidas.index'))
                <li class="@yield('TipoBebida-active')"><a href="{{ route('TipoBebida.index') }}">Tipos de
                        Bebidas</a>
                </li>
            @endif
            @if (auth()->user()->can('haveaccess', 'unidades.index'))
                <li class="@yield('Unidad-active')"><a href="{{ route('Unidad.index') }}">Unidades</a></li>
            @endif
            @if (auth()->user()->can('haveaccess', 'insumos.index'))
                <li class="@yield('Insumo-active')"><a href="{{ route('Insumo.index') }}">Insumo </a></li>
            @endif
        </ul>
    </li>
@endif
@if (auth()->user()->can('haveaccess', 'ambientes.index') ||
    auth()->user()->can('haveaccess', 'depositos.index') ||
    auth()->user()->can('haveaccess', 'cajas.index'))
    <li class="@yield('mantenimiento-active')">
        <a><i class="fa fa-th-large"></i> <span class="nav-label">Mantenimiento</span>
            <span class="fa arrow"></span></a>
        <ul class="nav nav-second-level">
            @if (auth()->user()->can('haveaccess', 'ambientes.index'))
                <li class="@yield('Ambiente-active')"><a href="{{ route('Ambiente.index') }}">Ambientes</a></li>
            @endif
            @if (auth()->user()->can('haveaccess', 'depositos.index'))
                <li class="@yield('Deposito-active')"><a href="{{ route('Deposito.index') }}">Depositos</a></li>
            @endif
            @if (auth()->user()->can('haveaccess', 'cajas.index'))
                <li class="@yield('Caja-active')"><a href="{{ route('Caja.index') }}">Cajas</a></li>
            @endif
            <li class="@yield('Numeracion-active')"><a href="{{ route('numeracion.index') }}">Numeracion</a></li>
        </ul>
    </li>
@endif
@if (auth()->user()->can('haveaccess', 'Empresa.index'))
    <li class="@yield('administracion-active')">
        <a href="{{ route('EmpresaPersonal.index') }}"><i class="fa fa-th-large"></i> <span
                class="nav-label">Datos de la Empresa</span>
        </a>
    </li>
@endif
