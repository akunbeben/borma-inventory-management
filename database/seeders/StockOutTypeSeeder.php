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
            insert into stock_out_type (name, description) values ('Receiving', 'Receive stocks from vendor.');
            insert into stock_out_type (name, description) values ('Returned Warehouse', 'Receive returned stuff from customer.');
        ");
    }
}
