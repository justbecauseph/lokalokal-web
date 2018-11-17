<?php

use Illuminate\Database\Seeder;
use LokaLocal\Sku;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SkuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $moduleId = DB::table('modules')->insertGetId([
            'name'         => 'sku',
            'display_name' => 'SKU',
            'icon'         => 'icon-layers'
        ]);

        DB::table('permissions')->insert([
            [
                'name' => 'read-skus',
                'display_name' => 'Read SKU',
                'guard_name' => 'web',
                'module_id' => $moduleId
            ],
            [
                'name' => 'create-skus',
                'display_name' => 'Create SKU',
                'guard_name' => 'web',
                'module_id' => $moduleId
            ],
            [
                'name' => 'update-skus',
                'display_name' => 'Update SKU',
                'guard_name' => 'web',
                'module_id' => $moduleId
            ]
        ]);

        // Assign permissions to admin role
        $admin = Role::findByName('admin');
        $admin->givePermissionTo(Permission::all());

        $admin = Role::findByName('partner');
        $admin->givePermissionTo('read-skus', 'create-skus', 'update-skus');
    }
}
