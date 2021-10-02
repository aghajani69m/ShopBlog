<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Product;
use App\Models\User;
use Dotenv\Util\Str;
use Faker\Factory;
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
        // \App\Models\User::factory(10)->create();
        User::factory()->create([
            'name'=>'SuperAdmin' ,
            'email'=>'aghajani69m@gmail.com' ,
            'password'=>'password' ,
            'is_superadmin'=>'1']);
        User::factory(50)->create();
        Permission::factory()->create(['name' => 'create-user' , 'label' => 'ایجاد کاربر']);
        Permission::factory()->create(['name' => 'show-users' , 'label' => 'مشاهده کاربران']);
        Permission::factory()->create(['name' => 'edit-user' , 'label' => 'ویرایش کاربر']);
        Permission::factory()->create(['name' => 'delete-user' , 'label' => 'حذف کاربر']);
        Permission::factory()->create(['name' => 'show-permissions' , 'label' => 'مشاهده دسترسی ها']);
        Permission::factory()->create(['name' => 'create-permission' , 'label' => 'ایجاد دسترسی']);
        Permission::factory()->create(['name' => 'edit-permission' , 'label' => 'ویرایش دسترسی']);
        Permission::factory()->create(['name' => 'delete-permission' , 'label' => 'حذف دسترسی']);
        Permission::factory()->create(['name' => 'show-roles' , 'label' => 'مشاهده مقام ها']);
        Permission::factory()->create(['name' => 'create-role' , 'label' => 'ایجاد مقام']);
        Permission::factory()->create(['name' => 'edit-role' , 'label' => 'ویرایش مقام']);
        Permission::factory()->create(['name' => 'show-products' , 'label' => 'مشاهده محصولات']);
        Permission::factory()->create(['name' => 'create-product' , 'label' => 'ایجاد محصول']);
        Permission::factory()->create(['name' => 'edit-product' , 'label' => 'ویرایش محصول']);
        Permission::factory()->create(['name' => 'delete-product' , 'label' => 'حذف محصول']);
        Permission::factory()->create(['name' => 'show-comments' , 'label' => 'مشاهده نظرات']);
        Permission::factory()->create(['name' => 'edit-comment' , 'label' => 'ویرایش نظر']);
        Permission::factory()->create(['name' => 'delete-comment' , 'label' => 'حذف نظر']);
        Permission::factory()->create(['name' => 'show-staff-users' , 'label' => 'مشاهده مدیران']);
        Permission::factory()->create(['name' => 'staff-user-permissions' , 'label' => 'مدیریت دسترسی مدیران']);

        Product::factory(500)->create();


    }
}
