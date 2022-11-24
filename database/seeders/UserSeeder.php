<?php

namespace Database\Seeders;

use App\Models\User;
use App\Permission\Models\Role;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $consulta = User::where('name', 'Administrador');
        if ($consulta->count() == 0) {
            $administrador = new User();
            $administrador->name = "Administrador";
            $administrador->email = "admin@restaurant.com";
            $administrador->password = bcrypt('12345678');
            $administrador->save();
        }
        else{
            $administrador=$consulta->first();
        }


        $roladmin = Role::create([
            'name' => 'Admin',
            'slug' => 'admin',
            'description' => 'Administrado',
            'full-access' => 'yes',
            'eliminar' => 'no'
        ]);


        // $administrado->roles()->sync([$rolcliente->id]);
        $administrador->roles()->sync([$roladmin->id]);
    }
}
