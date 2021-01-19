<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StockOutStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stock_out_status')->delete();

        DB::unprepared("
            insert into stock_out_status (status) values ('Draft');
            insert into stock_out_status (status) values ('Pending');
            insert into stock_out_status (status) values ('Approved');
            insert into stock_out_status (status) values ('Rejected');
        ");
    }
}
