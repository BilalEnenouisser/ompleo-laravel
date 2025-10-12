<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = [
            [
                'name' => 'TechCorp Algeria',
                'slug' => 'techcorp-algeria',
                'description' => 'Leader en technologies de l\'information en Algérie',
                'website' => 'https://techcorp.dz',
                'size' => '50-100 employés',
                'industry' => 'Technologies de l\'information',
                'location' => 'Alger',
                'is_active' => true,
            ],
            [
                'name' => 'Marketing Plus',
                'slug' => 'marketing-plus',
                'description' => 'Agence de marketing digital et communication',
                'website' => 'https://marketingplus.dz',
                'size' => '10-50 employés',
                'industry' => 'Marketing et Communication',
                'location' => 'Oran',
                'is_active' => true,
            ],
            [
                'name' => 'CloudTech Solutions',
                'slug' => 'cloudtech-solutions',
                'description' => 'Solutions cloud et infrastructure IT',
                'website' => 'https://cloudtech.dz',
                'size' => '20-50 employés',
                'industry' => 'Cloud Computing',
                'location' => 'Constantine',
                'is_active' => true,
            ],
        ];

        foreach ($companies as $company) {
            \App\Models\Company::create($company);
        }
    }
}
