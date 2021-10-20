<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Product;
use App\Models\Role;
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
            'email'=>'superadmin@example.com' ,
            'password'=>'password' ,
            'is_superadmin'=>'1']);
        User::factory()->create([
            'name'=>'Admin' ,
            'email'=>'admin@example.com' ,
            'password'=>'password' ,
            'is_admin'=>'1']);
        User::factory()->create([
            'name'=>'Staff' ,
            'email'=>'staff@example.com' ,
            'password'=>'password' ,
            'is_staff'=>'1']);
        User::factory(20)->create();
        Permission::factory()->create(['name' => 'create-user' , 'label' => 'ایجاد کاربر']);
        Permission::factory()->create(['name' => 'show-users' , 'label' => 'مشاهده کاربران']);
        Permission::factory()->create(['name' => 'edit-user' , 'label' => 'ویرایش کاربر']);
        Permission::factory()->create(['name' => 'edit-user-role' , 'label' => 'ویرایش مقام کاربر']);
        Permission::factory()->create(['name' => 'delete-user' , 'label' => 'حذف کاربر']);
        Permission::factory()->create(['name' => 'show-permissions' , 'label' => 'مشاهده دسترسی ها']);
        Permission::factory()->create(['name' => 'create-permission' , 'label' => 'ایجاد دسترسی']);
        Permission::factory()->create(['name' => 'edit-permission' , 'label' => 'ویرایش دسترسی']);
        Permission::factory()->create(['name' => 'delete-permission' , 'label' => 'حذف دسترسی']);
        Permission::factory()->create(['name' => 'show-roles' , 'label' => 'مشاهده مقام ها']);
        Permission::factory()->create(['name' => 'create-role' , 'label' => 'ایجاد مقام']);
        Permission::factory()->create(['name' => 'edit-role' , 'label' => 'ویرایش مقام']);
        Permission::factory()->create(['name' => 'delete-role' , 'label' => 'حذف مقام']);
        Permission::factory()->create(['name' => 'show-products' , 'label' => 'مشاهده محصولات']);
        Permission::factory()->create(['name' => 'show-products-list' , 'label' => 'مشاهده لیست محصولات']);
        Permission::factory()->create(['name' => 'show-user-products' , 'label' => 'مشاهده محصولات کاربر']);
        Permission::factory()->create(['name' => 'create-product' , 'label' => 'ایجاد محصول']);
        Permission::factory()->create(['name' => 'edit-product' , 'label' => 'ویرایش محصول']);
        Permission::factory()->create(['name' => 'delete-product' , 'label' => 'حذف محصول']);
        Permission::factory()->create(['name' => 'show-comments' , 'label' => 'مشاهده نظرات']);
        Permission::factory()->create(['name' => 'show-comments-list' , 'label' => 'مشاهده لیست نظرات']);
        Permission::factory()->create(['name' => 'show-user-comments' , 'label' => 'مشاهده نظرات کاربر']);
        Permission::factory()->create(['name' => 'edit-comment' , 'label' => 'ویرایش نظر']);
        Permission::factory()->create(['name' => 'delete-comment' , 'label' => 'حذف نظر']);
        Permission::factory()->create(['name' => 'show-categories' , 'label' => 'مشاهده دسته بندی ها']);
        Permission::factory()->create(['name' => 'create-category' , 'label' => 'ایجاد دسته بندی']);
        Permission::factory()->create(['name' => 'edit-category' , 'label' => 'ویرایش دسته بندی']);
        Permission::factory()->create(['name' => 'delete-category' , 'label' => 'حذف دسته بندی']);
        Permission::factory()->create(['name' => 'show-discounts' , 'label' => 'مشاهده تخفیف ها']);
        Permission::factory()->create(['name' => 'show-user-discounts' , 'label' => 'مشاهده تخفیف های کاربر']);
        Permission::factory()->create(['name' => 'create-discount' , 'label' => 'ایجاد تخفیف']);
        Permission::factory()->create(['name' => 'edit-discount' , 'label' => 'ویرایش تخفیف']);
        Permission::factory()->create(['name' => 'delete-discount' , 'label' => 'حذف تخفیف']);
        Permission::factory()->create(['name' => 'show-staff-users' , 'label' => 'مشاهده مدیران']);
        Permission::factory()->create(['name' => 'staff-user-permissions' , 'label' => 'مدیریت دسترسی مدیران']);
        Permission::factory()->create(['name' => 'show-orders' , 'label' => 'مشاهده سفارشات']);
        Permission::factory()->create(['name' => 'edit-order' , 'label' => 'ویرایش سفارش']);
        Permission::factory()->create(['name' => 'delete-order' , 'label' => 'حذف سفارش']);


        Product::factory(50)->create();

        Role::factory()->create(['name' => 'admin' , 'label' => 'ادمین']);
        Role::factory()->create(['name' => 'staff' , 'label' => 'کارمند']);
        Role::factory()->create(['name' => 'superuser' , 'label' => 'کاربر ویژه']);

    }
}
