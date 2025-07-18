<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name'=>'client1',
                'email' => "client1@gmail.com",
                'password'=> Hash::make('client1'),
                'contact_name'=> 'Cody',
                'contact_number'=> '0811111111111',
                'role'=> 'client',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
        ]);

        DB::table('users')->insert([
            [
                'name'=>'ADMIN',
                'email' => "wepekapparel@gmail.com",
                'password'=> Hash::make('wepekaapparelflytothemoon'),
                'contact_name'=> 'ADMIN',
                'contact_number'=> '082331577750',
                'role'=> 'admin',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
        ]);
    }
}
