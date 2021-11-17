<?php

use App\Permission;
use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            array('name' => 'Admin', 'display_name' => 'مدير النظام', 'description' => ' لديه كل صلاحيات السيستم'),
            array('name' => 'employee', 'display_name' => 'مشرف', 'description' => ' لديه صلاحيات العرض فقط'),
        ];

        foreach ($roles as $role) {
            Role::insert([
                'name'         => $role['name'],
                'display_name' => $role['display_name'],
                'description'  => $role['description'],
            ]);
        }


        $permissions = [
            array('name' => 'city_index', 'display_name' => 'كل المدن', 'description' => '', 'route' => 'city.index', 'group' => '1'),
            array('name' => 'city_store', 'display_name' => 'اضافة مدينة', 'description' => '', 'route' => 'city.store', 'group' => '1'),
            array('name' => 'city_show', 'display_name' => 'عرض مدينة', 'description' => '', 'route' => 'city.show', 'group' => '1'),
            array('name' => 'city_update', 'display_name' => 'تعديل مدينة', 'description' => '', 'route' => 'city.update', 'group' => '1'),
            array('name' => 'city_eit', 'display_name' => 'تحديث مدينة', 'description' => '', 'route' => 'city.edit', 'group' => '1'),
            array('name' => 'city_destroy', 'display_name' => 'حذف مدينة', 'description' => '', 'route' => 'city.destroy', 'group' => '1'),

            array('name' => 'city_district_index', 'display_name' => 'كل المناطق', 'description' => '', 'route' => 'city.district.index ', 'group' => '2'),
            array('name' => 'city_district_store', 'display_name' => 'اضافة منطقة', 'description' => '', 'route' => 'city.district.store ', 'group' => '2'),
            array('name' => 'city_district_show', 'display_name' => 'عرض منطقة', 'description' => '', 'route' => 'city.district.show', 'group' => '2'),
            array('name' => 'city_district_edit', 'display_name' => 'تعديل منطقة', 'description' => '', 'route' => 'city.district.edit', 'group' => '2'),
            array('name' => 'city_district_update', 'display_name' => 'تحديث منطقة', 'description' => '', 'route' => 'city.district.update', 'group' => '2'),
            array('name' => 'city_district_destroy', 'display_name' => 'حذف منطقة', 'description' => '', 'route' => 'city.district.destroy', 'group' => '2'),

            array('name' => 'user_index', 'display_name' => 'كل الموظفين', 'description' => '', 'route' => 'user.index', 'group' => '3'),
            array('name' => 'user_store', 'display_name' => 'اضافة موظف', 'description' => '', 'route' => 'user.store', 'group' => '3'),
            array('name' => 'user_show', 'display_name' => 'عرض موظف', 'description' => '', 'route' => 'user.show', 'group' => '3'),
            array('name' => 'user_update', 'display_name' => 'تعديل موظف', 'description' => '', 'route' => 'user.update', 'group' => '3'),
            array('name' => 'user_eit', 'display_name' => 'تحديث موظف', 'description' => '', 'route' => 'user.edit', 'group' => '3'),
            array('name' => 'user_destroy', 'display_name' => 'حذف موظف', 'description' => '', 'route' => 'user.destroy', 'group' => '3'),

            array('name' => 'store_index', 'display_name' => 'كل المؤسسات', 'description' => '', 'route' => 'store.index', 'group' => '4'),
            array('name' => 'store_store', 'display_name' => 'اضافة مؤسسة', 'description' => '', 'route' => 'store.store', 'group' => '4'),
            array('name' => 'store_show', 'display_name' => 'عرض مؤسسة', 'description' => '', 'route' => 'store.show', 'group' => '4'),
            array('name' => 'store_update', 'display_name' => 'تعديل مؤسسة', 'description' => '', 'route' => 'store.update', 'group' => '4'),
            array('name' => 'store_eit', 'display_name' => 'تحديث مؤسسة', 'description' => '', 'route' => 'store.edit', 'group' => '4'),
            array('name' => 'store_destroy', 'display_name' => 'حذف مؤسسة', 'description' => '', 'route' => 'store.destroy', 'group' => '4'),

            array('name' => 'product_index', 'display_name' => 'كل المنتجات', 'description' => '', 'route' => 'product.index', 'group' => '5'),
            array('name' => 'product_store', 'display_name' => 'اضافة منتج', 'description' => '', 'route' => 'product.store', 'group' => '5'),
            array('name' => 'product_show', 'display_name' => 'عرض منتج', 'description' => '', 'route' => 'product.show', 'group' => '5'),
            array('name' => 'product_update', 'display_name' => 'تعديل منتج', 'description' => '', 'route' => 'product.update', 'group' => '5'),
            array('name' => 'product_eit', 'display_name' => 'تحديث منتج', 'description' => '', 'route' => 'product.edit', 'group' => '5'),
            array('name' => 'product_destroy', 'display_name' => 'حذف منتج', 'description' => '', 'route' => 'product.destroy', 'group' => '5'),

            array('name' => 'car_index', 'display_name' => 'كل السيارات', 'description' => '', 'route' => 'car.index', 'group' => '6'),
            array('name' => 'car_store', 'display_name' => 'اضافة سيارة', 'description' => '', 'route' => 'car.store', 'group' => '6'),
            array('name' => 'car_show', 'display_name' => 'عرض سيارة', 'description' => '', 'route' => 'car.show', 'group' => '6'),
            array('name' => 'car_update', 'display_name' => 'تعديل سيارة', 'description' => '', 'route' => 'car.update', 'group' => '6'),
            array('name' => 'car_eit', 'display_name' => 'تحديث سيارة', 'description' => '', 'route' => 'car.edit', 'group' => '6'),
            array('name' => 'car_destroy', 'display_name' => 'حذف سيارة', 'description' => '', 'route' => 'car.destroy', 'group' => '6'),

            array('name' => 'category_index', 'display_name' => 'كل الاصناف', 'description' => '', 'route' => 'category.index', 'group' => '7'),
            array('name' => 'category_store', 'display_name' => 'اضافة تصنيف', 'description' => '', 'route' => 'category.store', 'group' => '7'),
            array('name' => 'category_show', 'display_name' => 'عرض تصنيف', 'description' => '', 'route' => 'category.show', 'group' => '7'),
            array('name' => 'category_update', 'display_name' => 'تعديل تصنيف', 'description' => '', 'route' => 'category.update', 'group' => '7'),
            array('name' => 'category_eit', 'display_name' => 'تحديث تصنيف', 'description' => '', 'route' => 'category.edit', 'group' => '7'),
            array('name' => 'category_destroy', 'display_name' => 'حذف تصنيف', 'description' => '', 'route' => 'car.destroy', 'group' => '7'),

            array('name' => 'category_variety_index', 'display_name' => 'كل وحدات التصنيفات', 'description' => '', 'route' => 'category.variety.index ', 'group' => '8'),
            array('name' => 'category_variety_store', 'display_name' => 'اضافة وحدة تصنيف', 'description' => '', 'route' => 'category.variety.store ', 'group' => '8'),
            array('name' => 'category_variety_show', 'display_name' => 'عرض وحدة تصنيف', 'description' => '', 'route' => 'category.variety.show', 'group' => '8'),
            array('name' => 'category_variety_edit', 'display_name' => 'تعديل وحدة تصنيف', 'description' => '', 'route' => 'category.variety.edit', 'group' => '8'),
            array('name' => 'category_variety_update', 'display_name' => 'تحديث وحدة تصنيف', 'description' => '', 'route' => 'category.variety.update', 'group' => '8'),
            array('name' => 'category_variety_destroy', 'display_name' => 'حذف وحدة تصنيف', 'description' => '', 'route' => 'category.variety.destroy', 'group' => '8'),

            array('name' => 'color_index', 'display_name' => 'كل الالوان', 'description' => '', 'route' => 'color.index', 'group' => '8'),
            array('name' => 'color_store', 'display_name' => 'اضافة لون', 'description' => '', 'route' => 'color.store', 'group' => '8'),
            array('name' => 'color_show', 'display_name' => 'عرض لون', 'description' => '', 'route' => 'color.show', 'group' => '8'),
            array('name' => 'color_update', 'display_name' => 'تعديل لون', 'description' => '', 'route' => 'color.update', 'group' => '8'),
            array('name' => 'color_eit', 'display_name' => 'تحديث لون', 'description' => '', 'route' => 'color.edit', 'group' => '8'),
            array('name' => 'color_destroy', 'display_name' => 'حذف لون', 'description' => '', 'route' => 'color.destroy', 'group' => '8'),

            array('name' => 'unit_index', 'display_name' => 'كل الوحدات', 'description' => '', 'route' => 'unit.index', 'group' => '9'),
            array('name' => 'unit_store', 'display_name' => 'اضافة وحدة', 'description' => '', 'route' => 'unit.store', 'group' => '9'),
            array('name' => 'unit_show', 'display_name' => 'عرض وحدة', 'description' => '', 'route' => 'unit.show', 'group' => '9'),
            array('name' => 'unit_update', 'display_name' => 'تعديل وحدة', 'description' => '', 'route' => 'unit.update', 'group' => '9'),
            array('name' => 'unit_eit', 'display_name' => 'تحديث وحدة', 'description' => '', 'route' => 'unit.edit', 'group' => '9'),
            array('name' => 'unit_destroy', 'display_name' => 'حذف وحدة', 'description' => '', 'route' => 'unit.destroy', 'group' => '9'),

            array('name' => 'client_index', 'display_name' => 'كل العملاء', 'description' => '', 'route' => 'client.index', 'group' => '10'),
            array('name' => 'client_store', 'display_name' => 'اضافة عميل', 'description' => '', 'route' => 'client.store', 'group' => '10'),
            array('name' => 'client_show', 'display_name' => 'عرض عميل', 'description' => '', 'route' => 'client.show', 'group' => '10'),
            array('name' => 'client_update', 'display_name' => 'تعديل عميل', 'description' => '', 'route' => 'client.update', 'group' => '10'),
            array('name' => 'client_eit', 'display_name' => 'تحديث عميل', 'description' => '', 'route' => 'client.edit', 'group' => '10'),
            array('name' => 'client_destroy', 'display_name' => 'حذف عميل', 'description' => '', 'route' => 'client.destroy', 'group' => '10'),

            array('name' => 'role_index', 'display_name' => 'كل الصلاحيات', 'description' => '', 'route' => 'role.index', 'group' => '11'),
            array('name' => 'role_store', 'display_name' => 'اضافة صلاحية', 'description' => '', 'route' => 'role.store', 'group' => '11'),
            array('name' => 'role_show', 'display_name' => 'عرض صلاحية', 'description' => '', 'route' => 'role.show', 'group' => '11'),
            array('name' => 'role_update', 'display_name' => 'تعديل صلاحية', 'description' => '', 'route' => 'role.update', 'group' => '11'),
            array('name' => 'role_eit', 'display_name' => 'تحديث صلاحية', 'description' => '', 'route' => 'role.edit', 'group' => '11'),
            array('name' => 'role_destroy', 'display_name' => 'حذف صلاحية', 'description' => '', 'route' => 'role.destroy', 'group' => '11'),


        ];

        foreach ($permissions as $permission) {
            Permission::insert([
                'name'         => $permission['name'],
                'display_name' => $permission['display_name'],
                'description'  => $permission['description'],
                'route'        => $permission['route'],
                'group'        => $permission['group'],
            ]);
        }


    }
}
