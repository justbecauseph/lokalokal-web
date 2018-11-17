<?php

use Illuminate\Database\Seeder;
use LokaLocal\Branch;
use LokaLocal\Sku;
use LokaLocal\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class BranchTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $moduleId = DB::table('modules')->insertGetId([
            'name'         => 'branch',
            'display_name' => 'Branch',
            'icon'         => 'icon-location-pin'
        ]);

        DB::table('permissions')->insert([
            [
                'name'         => 'read-branches',
                'display_name' => 'Read Branches',
                'guard_name'   => 'web',
                'module_id'    => $moduleId
            ],
            [
                'name'         => 'update-branches',
                'display_name' => 'Update Branches',
                'guard_name'   => 'web',
                'module_id'    => $moduleId
            ]
        ]);

        // Create partner user
        $user = User::create([
            'name'     => 'partner',
            'email'    => 'partner@lokalocal.ph',
            'password' => bcrypt('partner'),
            'avatar'   => 'avatar.png'
        ]);
        // Assign admin role to default user
        $user->assignRole('partner');
        // Generate avatar to defautl user
        $avatar = Avatar::create($user->name)->getImageObject()->encode('png');
        Storage::put('avatars/' . $user->id . '/avatar.png', (string)$avatar);

        // Assign permissions to admin role
        $admin = Role::findByName('admin');
        $admin->givePermissionTo(Permission::all());

        $branch = Branch::create([
            'name'      => 'LOFT - Ortigas',
            'address'   => 'Penthouse 1, One Corporate Center Meralco Ave cor Julia Vargas Ave, Ortigas Center, Pasig, 1605 Metro Manila',
            'latitude'  => '14.585142',
            'longitude' => '121.060546',
            'user_id'   => $user->id
        ]);

        $sku = [
            [
                'name'      => 'Espresso',
                'desc'      => 'Espresso (/ɛˈsprɛsoʊ/, Italian: [esˈprɛsso]) is coffee brewed by expressing or forcing a small amount of nearly boiling water under pressure through finely ground coffee beans. Espresso is generally thicker than coffee brewed by other methods, has a higher concentration of suspended and dissolved solids, and has crema on top (a foam with a creamy consistency).',
                'code'      => 'espresso',
                'amount'    => 90,
                'avatar'    => 'storage/img/espresso.jpg',
                'branch_id' => $branch->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name'      => 'Americano',
                'desc'      => 'Caffè Americano (Italian pronunciation: [kafˈfɛ ameriˈkaːno]) or Americano (shortened from Italian: caffè americano or American; Spanish: café americano, literally American coffee) is a type of coffee drink prepared by diluting an espresso with hot water, giving it a similar strength to, but different flavor from traditionally brewed coffee.',
                'code'      => 'americano',
                'amount'    => 110,
                'avatar'    => 'storage/img/americano.jpg',
                'branch_id' => $branch->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name'      => 'Cafe Latte',
                'desc'      => 'A latte (/ˈlɑːteɪ/ or /ˈlæteɪ/) is a coffee drink made with espresso and steamed milk.',
                'code'      => 'caffe-latte',
                'amount'    => 110,
                'avatar'    => 'storage/img/caffe-latte.jpg',
                'branch_id' => $branch->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name'      => 'Cold Brew',
                'desc'      => 'Not to be confused with iced coffee (in which espresso-based coffees are served over ice, usually with milk and syrup), cold brew coffee is simply coffee, brewed cold.',
                'code'      => 'cold-brew',
                'amount'    => 150,
                'avatar'    => 'storage/img/cold-brew.jpg',
                'branch_id' => $branch->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name'      => 'Iced Tea',
                'desc'      => 'Iced tea is a form of cold tea. Though usually served in a glass with ice, it can refer to any tea that has been chilled or cooled. It may be sweetened with sugar, syrup and/or apple slices. Iced tea is also a popular packaged drink',
                'code'      => 'iced-tea',
                'amount'    => 100,
                'avatar'    => 'storage/img/iced-tea.jpg',
                'branch_id' => $branch->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name'      => 'Long Coffee',
                'desc'      => 'The long coffee has a length that is 3 times the length of the espresso coffee',
                'code'      => 'long-coffee',
                'amount'    => 120,
                'avatar'    => 'storage/img/long-coffee.jpg',
                'branch_id' => $branch->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name'      => 'Premium Water',
                'desc'      => 'Best water ever',
                'code'      => 'premium-water',
                'amount'    => 500,
                'avatar'    => 'storage/img/premium-water.jpg',
                'branch_id' => $branch->id,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        Sku::insert($sku);
    }
}
