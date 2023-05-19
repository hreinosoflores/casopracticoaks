<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            'role_list',
            'role_create',
            'role_edit',
            'role_delete',
            'user_list',
            'user_create',
            'user_edit',
            'user_delete',
            'home',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $user_super_administrador = User::create([
            'name' => 'admin',
            'primerApellido' => 'apellidoPaterno',
            'segundoApellido' => 'aéllido materno',
            'nombreUser' => 'usuario admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => hash('sha256', 'password'), // password
            // 'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            // 'password' => bcrypt('password'),
        ]);

        $rol_super_administrador = Role::create(['name' => 'super_administrador']);

        $rol_super_administrador->syncPermissions([
            'role_list',
            'role_create',
            'role_edit',
            'role_delete',
            'user_list',
            'user_create',
            'user_edit',
            'user_delete',
            'home',
        ]);

        $user_super_administrador->assignRole([$rol_super_administrador->id]);
    }
}
