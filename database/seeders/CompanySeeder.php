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
                'description' => 'Leader en technologies de l\'information en Algérie, nous développons des solutions innovantes pour les entreprises modernes. Notre équipe d\'experts accompagne nos clients dans leur transformation digitale.',
                'website' => 'https://techcorp.dz',
                'size' => '50-100 employés',
                'industry' => 'Technologies de l\'information',
                'specialisation' => 'Développement web et mobile',
                'years_experience' => 8,
                'location' => 'Alger',
                'is_active' => true,
            ],
            [
                'name' => 'Marketing Plus',
                'slug' => 'marketing-plus',
                'description' => 'Agence de marketing digital et communication créative. Nous aidons les entreprises à développer leur présence en ligne et à atteindre leurs objectifs commerciaux grâce à des stratégies marketing innovantes.',
                'website' => 'https://marketingplus.dz',
                'size' => '10-50 employés',
                'industry' => 'Marketing et Communication',
                'specialisation' => 'Marketing digital et branding',
                'years_experience' => 5,
                'location' => 'Oran',
                'is_active' => true,
            ],
            [
                'name' => 'CloudTech Solutions',
                'slug' => 'cloudtech-solutions',
                'description' => 'Solutions cloud et infrastructure IT de nouvelle génération. Nous proposons des services de migration cloud, de sécurité et d\'optimisation pour les entreprises qui souhaitent moderniser leur infrastructure.',
                'website' => 'https://cloudtech.dz',
                'size' => '20-50 employés',
                'industry' => 'Cloud Computing',
                'specialisation' => 'Infrastructure cloud et DevOps',
                'years_experience' => 6,
                'location' => 'Constantine',
                'is_active' => true,
            ],
            [
                'name' => 'DataFlow Analytics',
                'slug' => 'dataflow-analytics',
                'description' => 'Spécialiste en analyse de données et intelligence artificielle. Nous transformons les données en insights actionnables pour aider les entreprises à prendre des décisions éclairées et à optimiser leurs performances.',
                'website' => 'https://dataflow.dz',
                'size' => '15-30 employés',
                'industry' => 'Intelligence Artificielle',
                'specialisation' => 'Data Science et Machine Learning',
                'years_experience' => 4,
                'location' => 'Alger',
                'is_active' => true,
            ],
            [
                'name' => 'GreenEnergy Solutions',
                'slug' => 'greenenergy-solutions',
                'description' => 'Pionnier des énergies renouvelables en Algérie. Nous développons et installons des solutions solaires et éoliennes pour les particuliers et les entreprises, contribuant à un avenir plus durable.',
                'website' => 'https://greenenergy.dz',
                'size' => '30-60 employés',
                'industry' => 'Énergies Renouvelables',
                'specialisation' => 'Énergie solaire et éolienne',
                'years_experience' => 7,
                'location' => 'Oran',
                'is_active' => true,
            ],
            [
                'name' => 'FinTech Algeria',
                'slug' => 'fintech-algeria',
                'description' => 'Innovation financière et solutions de paiement digital. Nous révolutionnons le secteur bancaire algérien avec des solutions de paiement mobile, de transfert d\'argent et de gestion financière personnalisée.',
                'website' => 'https://fintech.dz',
                'size' => '25-50 employés',
                'industry' => 'FinTech',
                'specialisation' => 'Solutions de paiement digital',
                'years_experience' => 3,
                'location' => 'Alger',
                'is_active' => true,
            ],
            [
                'name' => 'MediCare Digital',
                'slug' => 'medicare-digital',
                'description' => 'Solutions digitales pour le secteur de la santé. Nous développons des plateformes de télémédecine, de gestion de dossiers patients et d\'intelligence artificielle médicale pour améliorer les soins de santé.',
                'website' => 'https://medicare.dz',
                'size' => '40-80 employés',
                'industry' => 'Santé Digitale',
                'specialisation' => 'Télémédecine et IA médicale',
                'years_experience' => 6,
                'location' => 'Constantine',
                'is_active' => true,
            ],
            [
                'name' => 'EduTech Innovation',
                'slug' => 'edutech-innovation',
                'description' => 'Plateforme d\'apprentissage en ligne et solutions éducatives innovantes. Nous créons des expériences d\'apprentissage personnalisées et des outils pédagogiques adaptés aux besoins du marché algérien.',
                'website' => 'https://edutech.dz',
                'size' => '20-40 employés',
                'industry' => 'Éducation Technologique',
                'specialisation' => 'E-learning et pédagogie digitale',
                'years_experience' => 4,
                'location' => 'Oran',
                'is_active' => true,
            ],
        ];

        foreach ($companies as $company) {
            \App\Models\Company::create($company);
        }
    }
}
