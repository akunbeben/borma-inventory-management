<?php

namespace Database\Seeders;

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
        $this->call(DivisionsSeeder::class);
        $this->call(AdministratorSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ProductTypeSeeder::class);
        $this->call(StockInTypeSeeder::class);
        $this->call(StockInStatusSeeder::class);
        $this->call(StockOutTypeSeeder::class);
        $this->call(StockOutStatusSeeder::class);
    }
}
