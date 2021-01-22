<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StockOutTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stock_out_type')->delete();

        DB::unprepared("
            insert into stock_out_type (name, description) values ('Permintaan', 'Transfer products to customers.');
            insert into stock_out_type (name, description) values ('Retur', 'Return products to suppliers.');
        ");
    }
}
