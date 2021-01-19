<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StockInStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stock_in_status')->delete();

        DB::unprepared("
            insert into stock_in_status (status) values ('Draft');
            insert into stock_in_status (status) values ('Pending');
            insert into stock_in_status (status) values ('Approved');
            insert into stock_in_status (status) values ('Rejected');
        ");
    }
}
