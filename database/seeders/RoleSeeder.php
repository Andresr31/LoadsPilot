<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = new Role;
        $role->name = 'Admin';
        $role->description = 'Administrador del sistema';
        $role->save();

        $role = new Role;
        $role->name = 'Operator';
        $role->description = 'Operador del sistema';
        $role->save();
    }
}
