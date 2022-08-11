<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ImportFile;


class UploadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $admin = new ImportFile;
        $admin->file = asset("https://whattheysaidapi.developer-ha.xyz/uploads/".'sample.xlsx');
        $admin->save();
    }
}
