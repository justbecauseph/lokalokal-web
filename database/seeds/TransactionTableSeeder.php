<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class TransactionTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $moduleId = DB::table('modules')->insertGetId([
            'name'         => 'transaction',
            'display_name' => 'Transaction',
            'icon'         => 'icon-list'
        ]);

        // Permissions
        DB::table('permissions')->insert([
            [
                'name'         => 'read-transactions',
                'display_name' => 'Read Transactions',
                'guard_name'   => 'web',
                'module_id'    => $moduleId
            ]
        ]);

        // Assign permissions to admin role
        $admin = Role::findByName('admin');
        $admin->givePermissionTo(Permission::all());

        $partner = Role::findByName('partner');
        $partner->givePermissionTo('read-transactions');

        // Assign permissions to user role
        $user = Role::findByName('user');
        $user->givePermissionTo('read-transactions');
    }
}
