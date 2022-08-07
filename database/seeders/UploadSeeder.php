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
        $admin->file = asset("http://127.0.0.1:8000/uploads/".'bulk1.xlsx');
        $admin->save();
    }
}
