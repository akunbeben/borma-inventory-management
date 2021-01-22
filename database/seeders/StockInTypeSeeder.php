<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StockInTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stock_in_type')->delete();

        DB::unprepared("
            insert into stock_in_type (name, description) values ('Penerimaan', 'Receive stocks from vendor.');
            insert into stock_in_type (name, description) values ('Balik Gudang', 'Receive returned stuff from customer.');
        ");
    }
}
