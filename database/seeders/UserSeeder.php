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
        //CLIENT TEST
        DB::table('users')->insert([
            [
                'name'=>'client1',
                'email' => "client1@gmail.com",
                'password'=> Hash::make('client1'),
                'contact_name'=> 'Cody',
                'contact_number'=> '0811111111111',
                'logo_file'=>'',
                'role'=> 'client',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
        ]);
        
        //CLIENT REAL
        //TONEETOS
        DB::table('users')->insert([
            [
                'name'=>'Toneetos',
                'email' => "toneetos@gmail.com",
                'password'=> Hash::make('wepekastyle'), //sesuaikan
                'contact_name'=> '', //sesuaikan
                'contact_number'=> '', //sesuaikan
                'logo_file'=>'',
                'role'=> 'client',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
        ]);
        
        //TAROMA
        DB::table('users')->insert([
            [
                'name'=>'Taroma',
                'email' => "taroma@gmail.com",
                'password'=> Hash::make('wepekastyle'),
                'contact_name'=> '',
                'contact_number'=> '',
                'logo_file'=>'',
                'role'=> 'client',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
        ]);

        //ENGLISH HOUSE
        DB::table('users')->insert([
            [
                'name'=>'English House',
                'email' => "englishhouse@gmail.com", //sesuaikan
                'password'=> Hash::make('wepekastyle'), //sesuaikan
                'contact_name'=> '', //sesuaikan
                'contact_number'=> '', //sesuaikan
                'logo_file'=>'',
                'role'=> 'client',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
        ]);

        

        //ADMIN
        DB::table('users')->insert([
            [
                'name'=>'ADMIN',
                'email' => "wepekapparel@gmail.com",
                'password'=> Hash::make('wepekaapparelflytothemoon'),
                'contact_name'=> 'ADMIN',
                'contact_number'=> '082331577750',
                'logo_file'=>'',
                'role'=> 'admin',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
        ]);
    }
}
