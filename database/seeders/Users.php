<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
//use Laravel\Jetstream\Rules\Role;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class Users extends Seeder
{

    private $permissions = [
        'role-list',
        'role-create',
        'role-edit',
        'role-delete',
        'user-list',
        'user-create',
        'user-edit',
        'user-delete'
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        /*\App\Models\User::factory()->create([
            'numero_cuenta' => '151788',
            'name' => 'Jonathan Bailon',
            'email' => 'jonathan.bailon@cch.unam.mx',
            'password' => bcrypt('000000'),
            'fnacimiento' => '19991212',
            'plantel' => 5,
            'semestre' => 6,
            'sexo' => 1,
        ]);*/

        $user = User::create([
            'username' => '851788',
            'name' => 'Jonathan Bailon',
            'email' => 'jonathan.bailon@cch.unam.mx',
            'password' => bcrypt('000000'),
            'tipo' => 'P'
        ]);

        //$role = Role::create(['name' => 'Admin', 'name' => 'Alumno', 'name' => 'Profesor']);
        $role = Role::create(['name' => 'Admin']);

        $permissions = Permission::pluck('id', 'id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);


        $user = User::create([
            'username' => '885650',
            'name' => 'Jesus Daniel Bobadilla Calva',
            'email' => 'jesus.bobadilla@cch.unam.mx',
            'password' => bcrypt('000000'),
            'tipo' => 'P',
        ]);

        $user->assignRole([$role->id]);

        \App\Models\User::factory(2)->create();
    }
}
