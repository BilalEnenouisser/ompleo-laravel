<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = \App\Models\Company::all();
        $recruiter = \App\Models\User::where('user_type', 'recruiter')->first();

        if ($companies->count() > 0 && $recruiter) {
            $jobs = [
                [
                    'company_id' => $companies->first()->id,
                    'recruiter_id' => $recruiter->id,
                    'title' => 'Développeur Full Stack Senior',
                    'slug' => 'developpeur-full-stack-senior',
                    'description' => 'Nous recherchons un développeur full stack expérimenté pour rejoindre notre équipe dynamique. Vous travaillerez sur des projets innovants et utiliserez les dernières technologies.',
                    'requirements' => [
                        'Maîtrise de React.js et Node.js',
                        'Expérience avec les bases de données (MongoDB, PostgreSQL)',
                        'Connaissance des services cloud (AWS, Azure)',
                        'Expérience en développement agile',
                        'Maîtrise de Git et des outils de CI/CD'
                    ],
                    'benefits' => [
                        'Salaire compétitif',
                        'Formation continue',
                        'Environnement de travail flexible',
                        'Assurance santé',
                        'Équipe dynamique et motivée'
                    ],
                    'salary_min' => 80000,
                    'salary_max' => 120000,
                    'location' => 'Alger',
                    'type' => 'CDI',
                    'experience_level' => 'Senior (5+ ans)',
                    'tags' => ['React', 'Node.js', 'MongoDB', 'AWS', 'Agile'],
                    'status' => 'published',
                    'application_deadline' => now()->addDays(30),
                ],
                [
                    'company_id' => $companies->skip(1)->first()->id ?? $companies->first()->id,
                    'recruiter_id' => $recruiter->id,
                    'title' => 'Chef de Projet Marketing Digital',
                    'slug' => 'chef-projet-marketing-digital',
                    'description' => 'Rejoignez notre équipe marketing et pilotez des campagnes digitales innovantes. Expérience en gestion d\'équipe requise.',
                    'requirements' => [
                        'Expérience en marketing digital',
                        'Gestion d\'équipe',
                        'Connaissance des outils analytics',
                        'Créativité et innovation'
                    ],
                    'benefits' => [
                        'Salaire attractif',
                        'Formation continue',
                        'Équipe jeune et dynamique'
                    ],
                    'salary_min' => 60000,
                    'salary_max' => 90000,
                    'location' => 'Oran',
                    'type' => 'CDI',
                    'experience_level' => 'Intermédiaire (3+ ans)',
                    'tags' => ['Marketing', 'Digital', 'Gestion', 'Équipe'],
                    'status' => 'published',
                    'application_deadline' => now()->addDays(25),
                ],
            ];

            foreach ($jobs as $jobData) {
                \App\Models\Job::create($jobData);
            }
        }
    }
}
