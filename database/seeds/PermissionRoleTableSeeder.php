<?php

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{
    public function run()
    {
        $admin_permissions = Permission::all();
        Role::findOrFail(1)->permissions()->sync($admin_permissions->pluck('id'));
        $manager_permissions = $admin_permissions->filter(function ($permission) {
            return 
                substr($permission->title, 0, 5)  != 'role_' && 
                substr($permission->title, 0, 11) != 'permission_' && 

                substr($permission->title, 0, 8) != 'profile_' && 
                substr($permission->title, 0, 12) != 'certificate_' && 
                substr($permission->title, 0, 14) != 'product_create' && 
                substr($permission->title, 0, 14) != 'product_delete' && 
                substr($permission->title, 0, 12) != 'product_edit' && 
                substr($permission->title, 0, 14) != 'product_access' && 
                
                substr($permission->title, 0, 13) != 'region_delete' && 
                substr($permission->title, 0, 12) != 'place_delete';
        });
        $user_permissions = $admin_permissions->filter(function ($permission) {
            return 
                substr($permission->title, 0, 9)  != 'category_' && 
                substr($permission->title, 0, 12) != 'subcategory_' && 
                
                substr($permission->title, 0, 9)  != 'location_' && 
                substr($permission->title, 0, 7)  != 'region_' && 
                substr($permission->title, 0, 6)  != 'place_' && 
                
                substr($permission->title, 0, 14) != 'profile_delete' && 
                substr($permission->title, 0, 18) != 'certificate_delete' && 

                substr($permission->title, 0, 5)  != 'user_' && 
                substr($permission->title, 0, 5)  != 'role_' && 
                substr($permission->title, 0, 11) != 'permission_';
        });
        Role::findOrFail(2)->permissions()->sync($manager_permissions);
        Role::findOrFail(3)->permissions()->sync($user_permissions);
    }
}