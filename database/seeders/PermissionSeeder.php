<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\Administrator\User; // Pastikan path model User Anda benar

class PermissionSeeder extends Seeder
{
    public function run()
    {
        // 1. Bersihkan cache Spatie (Wajib dilakukan setiap kali seeding permission)
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 2. Daftar Hak Akses (Permissions) Standar
        $permissions = [
            'view-users',
            'create-users',
            'edit-users',
            'delete-users',
            'view-roles',
            'create-roles',
            'edit-roles',
            'delete-roles',
            'view-permissions',
            'create-permissions',
            'edit-permissions',
            'delete-permissions',
        ];

        // 3. Simpan ke database
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // 4. Buat Role Super Admin (jika belum ada)
        $superAdmin = Role::firstOrCreate(['name' => 'Super Admin']);

        // 5. Berikan SEMUA hak akses ke Super Admin
        $superAdmin->givePermissionTo(Permission::all());

        // 6. Tugaskan role Super Admin ke User ID 1 (Admin pertama di sistem Anda)
        $user = User::find(1);
        if ($user) {
            $user->assignRole($superAdmin);
        }
    }
}
