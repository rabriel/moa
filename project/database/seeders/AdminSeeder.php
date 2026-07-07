<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::updateOrCreate(
            ['email' => 'mari@mallofthenorth.co.za'],
            [
                'name' => 'Mall of the North Admin',
                'password' => '$2y$10$kwHAXSvRMzqzqDvLGg2bBOhMgsM.CZl75XfJeMTZaIJ/2eL13Hhj2',
                'is_active' => true,
            ]
        );
    }
}
