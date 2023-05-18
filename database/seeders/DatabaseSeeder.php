<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Adding an admin user
        $user = \App\Models\User::factory()
            ->count(1)
            ->create([
                'email' => 'admin@admin.com',
                'password' => Hash::make('admin'),
            ]);
        $this->call(PermissionsSeeder::class);

        $this->call(UserSeeder::class);
        $this->call(CashSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(InventorySeeder::class);
        $this->call(PaymentMethodSeeder::class);
        $this->call(SaleSeeder::class);
        $this->call(ScheduleSeeder::class);
    }
}
