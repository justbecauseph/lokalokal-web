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
                'name' => 'read-sku',
                'display_name' => 'Read SKU',
                'guard_name' => 'web',
                'module_id' => $moduleId
            ],
            [
                'name' => 'create-sku',
                'display_name' => 'Create SKU',
                'guard_name' => 'web',
                'module_id' => $moduleId
            ],
            [
                'name' => 'update-sku',
                'display_name' => 'Update SKU',
                'guard_name' => 'web',
                'module_id' => $moduleId
            ]
        ]);

        // Assign permissions to admin role
        $admin = Role::findByName('admin');
        $admin->givePermissionTo(Permission::all());

        $admin = Role::findByName('partner');
        $admin->givePermissionTo('read-sku', 'create-sku', 'update-sku');
    }
}
