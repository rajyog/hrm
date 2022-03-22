<?php


use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;


class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $permissions = [
           'Manage Role',
           'Create Role',
           'Edit Role',
           'Delete Role',
           'Manage Product',
           'Create Product',
           'Edit Product',
           'Delete Product'
        ];

        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
    }
}
