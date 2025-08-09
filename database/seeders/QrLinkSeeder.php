<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\QrLink;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class QrLinkSeeder extends Seeder
{
    public function run(): void
    {
        //TONEETOS
        DB::table('qr_links')->insert([
            [
                'user_id'=>'2',
                'event_name'=>'Toneetos Linktree',
                'file_type'=>'link',
                'file_data'=>'https://linktr.ee/Toneetos',
                'slug'=>'e735295f-04ff-41b4-837a-7820c6956c48',
                'temp_image_file'=>"", //sesuaikan,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
        ]);

        //TAROMA
        DB::table('qr_links')->insert([
            [
                'user_id'=>'3',
                'event_name'=>'Taroma',
                'file_type'=>'link',
                'file_data'=>'https://wepekasite.com/', //sesuaikan
                'slug'=>'130d1287-a7be-4a32-8545-4e0afe519f5b',
                'temp_image_file'=>"", //sesuaikan
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
        ]);

        //ENGLISH HOUSE
        DB::table('qr_links')->insert([
            [
                'user_id'=>'4',
                'event_name'=>'English House Linktree',
                'file_type'=>'link',
                'file_data'=>'https://linktr.ee/englishhousekediri',
                'slug'=>'01ce7314-9631-4abb-b283-afcab2909778',
                'temp_image_file'=>"", //sesuaikan
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now()
            ],
        ]);
    }
}
