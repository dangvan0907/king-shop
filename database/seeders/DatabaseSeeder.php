<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Permission;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PermissionSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
        ]);
        $users = User::all();
        $roles = Role::all();
        foreach ($users as $user) {
            foreach ($roles as $role) {
                if ($user->id == $role->id) {
                    $user->roles()->attach($role->id);
                }
            }
        }
        $admin = Role::where('name', '=', 'admin')->first();
        $user = Role::where('name', '=', 'user')->first();

        $admin->permissions()->attach(
            Permission::whereNotIn(
                'name',
                ['index-role', 'create-role', 'edit-role', 'delete-role'])
                ->pluck('id')
                ->toArray()
        );
        $user->permissions()->attach(
            Permission::whereNotIn(
                'name',
                ['index-role', 'create-role', 'edit-role', 'delete-role',
                    'index-user', 'create-user', 'edit-user', 'delete-user',
                    'index-category', 'create-category', 'edit-category', 'delete-category'])
                ->pluck('id')
                ->toArray()
        );
        $products = Product::all();
        $categories = Category::all();
        foreach ($products as $product) {
            $product->categories()->attach($categories->random(1)->pluck('id'));
        }



    }
}
