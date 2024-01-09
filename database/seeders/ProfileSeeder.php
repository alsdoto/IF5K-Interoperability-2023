<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $profile =  [
            'name' => 'riyan',
            'no_telp' => '089605201376',
            'alamat' => 'dibumi',
            'tempat_lahir' => 'cim',
            'tgl_lahir' => '0',
            'bio' => 'Apapun yang kita mau ya ada',
            'pp' => NULL,
            'users_id' => 1,
            // password
        ];
        DB::table('profile')->insert($profile);
    }
}
