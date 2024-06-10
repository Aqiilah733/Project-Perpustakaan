<?php

namespace Database\Seeders;

use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            "f_id" => '1',
            "f_nama" => 'qila',
            "f_username" => 'qila',
            "f_password" => Hash::make('654321'),
            "f_level" => 'Admin',
            "f_status" => 'Aktif',
            ]);
    }
}
