<?php

namespace Database\Seeders;

use App\Models\Administrator;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('administrators')->delete();

        Administrator::create([
            'id' => Str::uuid(),
            'npk' => '20202121',
            'name' => 'Benny Rahmat',
            'password' => bcrypt('12345678'),
            'division_id' => 1,
        ]);
    }
}
