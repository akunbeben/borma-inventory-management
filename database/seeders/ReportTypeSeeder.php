<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReportTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('document_type')->delete();

        DB::unprepared("
            insert into document_type (document_name) values ('Laporan Stok');
            insert into document_type (document_name) values ('Laporan Stok Masuk');
            insert into document_type (document_name) values ('Laporan Stok Keluar');
            insert into document_type (document_name) values ('Laporan Data Promo');
        ");
    }
}
