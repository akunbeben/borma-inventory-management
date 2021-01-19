<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        User::create([
            'id' => Str::uuid(),
            'npk' => '20201212',
            'name' => 'John Doe',
            'password' => bcrypt('12345678'),
            'division_id' => 3,
        ]);
    }
}
