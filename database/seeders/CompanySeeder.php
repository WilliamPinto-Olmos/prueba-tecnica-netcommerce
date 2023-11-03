<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    const COMPANY_COUNT = 10;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::factory(self::COMPANY_COUNT)->create();
    }
}
