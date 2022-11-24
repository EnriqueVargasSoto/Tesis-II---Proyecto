<?php

namespace Database\Seeders;

use App\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class PermisosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //--Administracion
        $permiso = new Permission();
        $permiso->name = "Clientes";
        $permiso->slug = "clientes.index";
        $permiso->description = "Acceso a Clientes";
        $permiso->save();

        $permiso = new Permission();
        $permiso->name = "Tipos de Empleados";
        $permiso->slug = "tipoDeEmpleados.index";
        $permiso->description = "Acceso a Tipos de Empleados";
        $permiso->save();

        $permiso = new Permission();
        $permiso->name = "Empleados";
        $permiso->slug = "empleados.index";
        $permiso->description = "Acceso a Empleados";
        $permiso->save();

        $permiso = new Permission();
        $permiso->name = "Proveedores";
        $permiso->slug = "proveedores.index";
        $permiso->description = "Acceso a Proveedores";
        $permiso->save();

        //------------------ Pedidos
        $permiso = new Permission();
        $permiso->name = "Pedidos";
        $permiso->slug = "pedidos.index";
        $permiso->description = "Acceso a Pedidos-Mesa";
        $permiso->save();
        //------------------- Facturar


        $permiso = new Permission();
        $permiso->name = "Facturar";
        $permiso->slug = "facturar.index";
        $permiso->description = "Acceso a Mostrador";
        $permiso->save();

        //------------------- Compras
        $permiso = new Permission();
        $permiso->name = "Documento de Compra";
        $permiso->slug = "documentoDeCompras.index";
        $permiso->description = "Acceso a Documentos de Compras";
        $permiso->save();
        //----------------------- Reportes
        $permiso = new Permission();
        $permiso->name = "Reporte de Pedidos";
        $permiso->slug = "reporte.pedidos";
        $permiso->description = "Acceso a Pedidos";
        $permiso->save();
        //------------------------Abastecimiento

        $permiso = new Permission();
        $permiso->name = "Roles";
        $permiso->slug = "roles.index";
        $permiso->description = "Acceso a Roles";
        $permiso->save();

        $permiso = new Permission();
        $permiso->name = "Tipos de Mesas";
        $permiso->slug = "tipoMesas.index";
        $permiso->description = "Acceso a Tipos de Mesas";
        $permiso->save();

        $permiso = new Permission();
        $permiso->name = "Tipos de Platos";
        $permiso->slug = "tipoPlatos.index";
        $permiso->description = "Acceso a Tipos de Platos";
        $permiso->save();

        $permiso = new Permission();
        $permiso->name = "Tipos de Bebidas";
        $permiso->slug = "tipoBebidas.index";
        $permiso->description = "Acceso a Tipos de Bebidas";
        $permiso->save();

        $permiso = new Permission();
        $permiso->name = "Insumos";
        $permiso->slug = "insumos.index";
        $permiso->description = "Acceso a Insumos";
        $permiso->save();

        $permiso = new Permission();
        $permiso->name = "Unidades";
        $permiso->slug = "unidades.index";
        $permiso->description = "Acceso a Unidades";
        $permiso->save();
        //------ Mantenimiento
        $permiso = new Permission();
        $permiso->name = "Ambientes";
        $permiso->slug = "ambientes.index";
        $permiso->description = "Acceso a Ambientes";
        $permiso->save();

        $permiso = new Permission();
        $permiso->name = "Depositos";
        $permiso->slug = "depositos.index";
        $permiso->description = "Acceso a Depositos";
        $permiso->save();

        $permiso = new Permission();
        $permiso->name = "Cajas";
        $permiso->slug = "cajas.index";
        $permiso->description = "Acceso a Cajas";
        $permiso->save();

        //------------- Datos de la Empresa
        $permiso = new Permission();
        $permiso->name = "Datos de la Empresa";
        $permiso->slug = "Empresa.index";
        $permiso->description = "Acceso a Empresa";
        $permiso->save();

        $permiso = new Permission();
        $permiso->name = "Reportes Ventas Grafico";
        $permiso->slug = "reporte.ventas";
        $permiso->description = "Reporte  de Ventas";
        $permiso->save();

        $permiso = new Permission();
        $permiso->name = "Reportes Productos Grafico";
        $permiso->slug = "reporte.productos";
        $permiso->description = "Reporte de Productos";
        $permiso->save();


        $permiso = new Permission();
        $permiso->name = "Documento de Ventas";
        $permiso->slug = "documentoVenta.index";
        $permiso->description = "Documento de Ventas";
        $permiso->save();
    }
}
