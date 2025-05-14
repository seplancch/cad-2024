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

        $user = User::create([
            'username' => 'basj850331631',
            'name' => 'Jonathan Bailon',
            'email' => 'jonathan.bailon@cch.unam.mx',
            'password' => bcrypt('851788'),
            'tipo' => 'E'
        ]);

        //$role = Role::create(['name' => 'Admin', 'name' => 'Alumno', 'name' => 'Profesor']);
        $role = Role::create(['name' => 'Admin']);

        $permissions = Permission::pluck('id', 'id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);

        $user->assignRole([$role->id]);

        //\App\Models\User::factory(2)->create();
    }
}
