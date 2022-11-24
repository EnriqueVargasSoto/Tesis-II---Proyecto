<?php

namespace Database\Seeders;

use App\Models\Mantenimiento\TipoDocumento;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            UserSeeder::class,
            TipoEmpleadoSeeder::class,
            RolesSeeder::class,
            AmbienteSeeder::class,
            TipoProductoSeeder::class,
            TipoPedidoSeeder::class,
            ClienteSeeder::class,
            PermisosSeeder::class,
            TipoMovimientoSeeder::class,
            MonedaSeeder::class,
            BilleteSeeder::class,
            TipoTarjetaSeeder::class,
            TarjetaSeeder::class,
            TipoDocumentoSeeder::class,
            NumeracionSeeder::class
        ]);
    }
}
