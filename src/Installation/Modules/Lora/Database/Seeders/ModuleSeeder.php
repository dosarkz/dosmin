<?php

namespace Dosarkz\Lora\Installation\Modules\Lora\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Dosarkz\Lora\Installation\Modules\Lora\Models\MenuItem;
use Dosarkz\Lora\Installation\Modules\Lora\Models\Role;
use Dosarkz\Lora\Installation\Modules\Lora\Models\MenuRole;
use Dosarkz\Lora\Installation\Modules\Lora\Models\Module;
use Dosarkz\Lora\Installation\Modules\Lora\Models\Menu;


class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Module::firstOrCreate([
            'name_ru' => 'Системный модуль Lora',
            'name_en' => 'Lora module',
            'menu_active' => true,
            'description_ru' => 'Системный модуль lora',
            'description_en' => 'The module lora',
            'version' => 0.01,
            'status_id' => 1,
            'alias' => 'accounts',
            'installed' => true,
        ]);

        $admin = Role::whereAlias('admin')->first();

        if (!$admin) {
            Role::create([
                'name_ru' => 'Администратор',
                'name_en' => 'Admin',
                'alias' => 'admin',
                'status_id' => 1
            ]);
        }

        $manager = Role::whereAlias('manager')->first();

        if (!$manager) {
            Role::create([
                'name_ru' => 'Менеджер',
                'name_en' => 'Manager',
                'alias' => 'manager',
                'status_id' => 1
            ]);
        }

        $user = Role::whereAlias('user')->first();

        if (!$user) {
            Role::create([
                'name_ru' => 'Пользователь',
                'name_en' => 'User',
                'alias' => 'user',
                'status_id' => 1
            ]);
        }

        $adminRole = Role::where('alias', 'admin')->first();
        $managerRole = Role::where('alias', 'manager')->first();

        $menu = Menu::firstOrCreate([
            'name_ru' => 'Lora',
            'name_en' => 'Lora',
            'alias' => 'lora',
            'type_id' => Menu::TYPE_LEFT_SIDE_MENU,
            'status_id' => 1,
            'position' => 1,
        ]);


        MenuItem::firstOrCreate([
            'title_ru' => 'Панель инструментов',
            'title_en' => 'Dashboard',
            'url' => route('lora.dashboard.index', [], false),
            'icon' => 'fa-columns',
            'menu_id' => $menu->id,
            'position' => 1,
            'status_id' => 1
        ]);

        $menuItemLayoutSettings = MenuItem::firstOrCreate([
            'title_ru' => 'Настроика шаблона',
            'title_en' => 'Layout settings',
            'url' => "#",
            'icon' => 'fa-sliders-h',
            'position' => 2,
            'menu_id' => $menu->id,
            'status_id' => 1
        ]);

        $menuItem = MenuItem::firstOrCreate([
            'title_ru' => 'Меню',
            'title_en' => 'Menu',
            'url' => route('lora.menus.index', [], false),
            'icon' => 'fa-route',
            'position' => 1,
            'menu_id' => $menu->id,
            'parent_id' => $menuItemLayoutSettings->id,
            'status_id' => 1
        ]);

        MenuItem::firstOrCreate([
            'title_ru' => 'Список',
            'title_en' => 'List',
            'url' => route('lora.menus.index', [], false),
            'icon' => 'fa-list-ul',
            'menu_id' => $menu->id,
            'parent_id' => $menuItem->id,
            'position' => 2,
            'status_id' => 1
        ]);

        MenuItem::firstOrCreate([
            'title_ru' => 'Добавить',
            'title_en' => 'Add',
            'url' => route('lora.menus.create', [], false),
            'icon' => 'fa-plus-circle',
            'menu_id' => $menu->id,
            'parent_id' => $menuItem->id,
            'position' => 1,
            'status_id' => 1
        ]);

        $accountManagementMenuItem = MenuItem::firstOrCreate([
            'title_ru' => 'Аккаунт',
            'title_en' => 'Account',
            'url' => route('lora.accounts.index', [], false),
            'icon' => 'fa-user',
            'position' => 3,
            'menu_id' => $menu->id,
            'status_id' => 1
        ]);

        MenuItem::firstOrCreate([
            'title_ru' => 'Пользователи',
            'title_en' => 'Super Users',
            'url' => route('lora.accounts.index', [], false),
            'icon' => 'fa-user',
            'position' => 1,
            'menu_id' => $menu->id,
            'parent_id' => $accountManagementMenuItem->id,
            'status_id' => 1
        ]);

        $MenuItem = MenuItem::firstOrCreate([
            'title_ru' => 'Роли',
            'title_en' => 'Roles',
            'url' => route('lora.roles.index', [], false),
            'icon' => 'fa-user-circle',
            'position' => 1,
            'menu_id' => $menu->id,
            'parent_id' => $accountManagementMenuItem->id,
            'status_id' => 1
        ]);

        MenuItem::firstOrCreate([
            'title_ru' => 'Добавить',
            'title_en' => 'Add',
            'url' => route('lora.roles.create', [], false),
            'icon' => 'fa-plus-circle',
            'menu_id' => $menu->id,
            'parent_id' => $MenuItem->id,
            'position' => 1,
            'status_id' => 1
        ]);

        MenuItem::firstOrCreate([
            'title_ru' => 'Список',
            'title_en' => 'List',
            'url' => route('lora.roles.index', [], false),
            'icon' => 'fa-list-ul',
            'menu_id' => $menu->id,
            'parent_id' => $MenuItem->id,
            'position' => 1,
            'status_id' => 1
        ]);

        MenuRole::firstOrCreate([
            'role_id' => $adminRole->id,
            'menu_id' => $menu->id,
        ]);

        MenuRole::firstOrCreate([
            'role_id' => $managerRole->id,
            'menu_id' => $menu->id,
        ]);
    }
}
