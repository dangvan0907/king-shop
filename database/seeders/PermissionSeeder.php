<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            [
                'name' => 'index-role',
                'display_name' => 'Index Role',
            ],
            [
                'name' => 'create-role',
                'display_name' => 'Create Role',
            ],
            [
                'name' => 'edit-role',
                'display_name' => 'Edit Role',
            ],
            [
                'name' => 'delete-role',
                'display_name' => 'Delete Role',
            ],
            [
                'name' => 'show-role',
                'display_name' => 'Show Role',
            ],
            [
                'name' => 'store-role',
                'display_name' => 'Store Role',
            ],
            [
                'name' => 'update-role',
                'display_name' => 'Update Role',
            ],
            [
                'name' => 'index-user',
                'display_name' => 'Index User',
            ],
            [
                'name' => 'create-user',
                'display_name' => 'Create User',
            ],
            [
                'name' => 'edit-user',
                'display_name' => 'Edit User',
            ],
            [
                'name' => 'delete-user',
                'display_name' => 'Delete User',
            ],
            [
                'name' => 'show-user',
                'display_name' => 'Show User',
            ],
            [
                'name' => 'store-user',
                'display_name' => 'store User',
            ],
            [
                'name' => 'update-user',
                'display_name' => 'Update User',
            ],
            [
                'name' => 'index-category',
                'display_name' => 'Index Category',
            ],
            [
                'name' => 'create-category',
                'display_name' => 'Create Category',
            ],
            [
                'name' => 'edit-category',
                'display_name' => 'Edit Category',
            ],
            [
                'name' => 'show-category',
                'display_name' => 'Show Category',
            ],
            [
                'name' => 'delete-category',
                'display_name' => 'Delete Category',
            ],
            [
                'name' => 'store-category',
                'display_name' => 'Store Category',
            ],
            [
                'name' => 'update-category',
                'display_name' => 'Update Category',
            ],
            [
                'name' => 'index-product',
                'display_name' => 'Index Product',
            ],
            [
                'name' => 'create-product',
                'display_name' => 'Create Product',
            ],
            [
                'name' => 'edit-product',
                'display_name' => 'Edit Product',
            ],
            [
                'name' => 'delete-product',
                'display_name' => 'Delete Product',
            ],
            [
                'name' => 'show-product',
                'display_name' => 'Show Product',
            ],
            [
                'name' => 'store-product',
                'display_name' => 'Store Product',
            ],
            [
                'name' => 'update-product',
                'display_name' => 'Update Product',
            ],
            [
                'name' => 'index-cart',
                'display_name' => 'Index cart',
            ],
            [
                'name' => 'create-cart',
                'display_name' => 'Create cart',
            ],
            [
                'name' => 'edit-cart',
                'display_name' => 'Edit cart',
            ],
            [
                'name' => 'delete-cart',
                'display_name' => 'Delete cart',
            ],
            [
                'name' => 'show-cart',
                'display_name' => 'Show cart',
            ],
            [
                'name' => 'store-cart',
                'display_name' => 'Store cart',
            ],
            [
                'name' => 'update-cart',
                'display_name' => 'Update cart',
            ],
        ]);

    }
}
