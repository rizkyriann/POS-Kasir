<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\MenuCategory;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'owner@cafe.test'],
            ['name' => 'Owner Cafe', 'password' => Hash::make('password'), 'role' => 'owner']
        );

        User::query()->updateOrCreate(
            ['email' => 'admin@cafe.test'],
            ['name' => 'Admin Cafe', 'password' => Hash::make('password'), 'role' => 'admin']
        );

        User::query()->updateOrCreate(
            ['email' => 'kasir@cafe.test'],
            ['name' => 'Kasir Cafe', 'password' => Hash::make('password'), 'role' => 'kasir']
        );

        foreach (['Coffee', 'Non Coffee', 'Snack', 'Main Course', 'Dessert'] as $categoryName) {
            MenuCategory::query()->firstOrCreate(['name' => $categoryName], ['is_active' => true]);
        }

        $coffee = MenuCategory::query()->where('name', 'Coffee')->first();
        $snack = MenuCategory::query()->where('name', 'Snack')->first();

        Menu::query()->firstOrCreate(['name' => 'Americano'], [
            'menu_category_id' => $coffee->id,
            'price' => 18000,
            'description' => 'Espresso dengan air panas.',
            'is_available' => true,
        ]);

        Menu::query()->firstOrCreate(['name' => 'Cappuccino'], [
            'menu_category_id' => $coffee->id,
            'price' => 24000,
            'description' => 'Espresso, steamed milk, dan foam.',
            'is_available' => true,
        ]);

        Menu::query()->firstOrCreate(['name' => 'French Fries'], [
            'menu_category_id' => $snack->id,
            'price' => 20000,
            'description' => 'Kentang goreng renyah.',
            'is_available' => true,
        ]);

        foreach ([
            'cafe_name' => 'Cafe POS',
            'cafe_address' => 'Jl. Contoh No. 1',
            'cafe_phone' => '081234567890',
            'receipt_footer_text' => 'Terima kasih atas kunjungan Anda.',
            'cafe_logo' => null,
        ] as $key => $value) {
            Setting::setValue($key, $value);
        }
    }
}
