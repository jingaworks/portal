<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            PermissionsTableSeeder::class,
            RolesTableSeeder::class,
            PermissionRoleTableSeeder::class,
            UsersTableSeeder::class,
            RoleUserTableSeeder::class,
            RegionsTableSeeder::class,
            PlacesTableSeeder::class,
            CategoryTableSeeder::class,
            SubcategoryTableSeeder::class,
            ProductsTableSeeder::class,
        ]);
    }
}