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
            // Get company IDs safely
            $companyIds = $companies->pluck('id')->toArray();
            $firstCompanyId = $companyIds[0];
            $secondCompanyId = isset($companyIds[1]) ? $companyIds[1] : $firstCompanyId;
            $thirdCompanyId = isset($companyIds[2]) ? $companyIds[2] : $firstCompanyId;
            $fourthCompanyId = isset($companyIds[3]) ? $companyIds[3] : $firstCompanyId;
            $fifthCompanyId = isset($companyIds[4]) ? $companyIds[4] : $firstCompanyId;
            $sixthCompanyId = isset($companyIds[5]) ? $companyIds[5] : $firstCompanyId;
            
            $jobs = [
                [
                    'company_id' => $firstCompanyId,
                    'recruiter_id' => $recruiter->id,
                    'title' => 'Développeur Full Stack Senior',
                    'slug' => 'developpeur-full-stack-senior',
                    'description' => 'Nous recherchons un développeur full stack expérimenté pour rejoindre notre équipe dynamique. Vous travaillerez sur des projets innovants utilisant les dernières technologies web et mobile. Vous serez responsable du développement d\'applications complètes, de la conception à la mise en production.',
                    'requirements' => [
                        'Maîtrise de React.js et Node.js',
                        'Expérience avec les bases de données (MongoDB, PostgreSQL)',
                        'Connaissance des services cloud (AWS, Azure)',
                        'Expérience en développement agile',
                        'Maîtrise de Git et des outils de CI/CD',
                        'Connaissance de Docker et Kubernetes',
                        'Expérience avec les API REST et GraphQL'
                    ],
                    'benefits' => [
                        'Salaire compétitif de 80,000 à 120,000 DA',
                        'Formation continue et certifications',
                        'Environnement de travail flexible et télétravail',
                        'Assurance santé complète',
                        'Équipe dynamique et projets innovants',
                        'Prime de performance et participation aux bénéfices'
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
                    'company_id' => $secondCompanyId,
                    'recruiter_id' => $recruiter->id,
                    'title' => 'Chef de Projet Marketing Digital',
                    'slug' => 'chef-projet-marketing-digital',
                    'description' => 'Rejoignez notre équipe marketing et pilotez des campagnes digitales innovantes. Vous serez responsable de la stratégie marketing digitale, de la gestion des réseaux sociaux, et de l\'optimisation des conversions. Expérience en gestion d\'équipe et en analytics requise.',
                    'requirements' => [
                        'Expérience en marketing digital (3+ ans)',
                        'Gestion d\'équipe et leadership',
                        'Connaissance des outils analytics (Google Analytics, Facebook Ads)',
                        'Créativité et innovation',
                        'Maîtrise des réseaux sociaux',
                        'Expérience en SEO/SEA',
                        'Connaissance des outils de marketing automation'
                    ],
                    'benefits' => [
                        'Salaire attractif de 60,000 à 90,000 DA',
                        'Formation continue et conférences',
                        'Équipe jeune et dynamique',
                        'Environnement créatif et stimulant',
                        'Possibilité d\'évolution rapide'
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
                [
                    'company_id' => $thirdCompanyId,
                    'recruiter_id' => $recruiter->id,
                    'title' => 'Data Scientist',
                    'slug' => 'data-scientist',
                    'description' => 'Nous recherchons un Data Scientist passionné par l\'intelligence artificielle et l\'analyse de données. Vous travaillerez sur des projets d\'IA et de machine learning pour optimiser nos processus métier et développer de nouveaux produits data-driven.',
                    'requirements' => [
                        'Master en Data Science ou équivalent',
                        'Maîtrise de Python et R',
                        'Expérience avec TensorFlow, PyTorch',
                        'Connaissance des bases de données SQL/NoSQL',
                        'Expérience en machine learning',
                        'Connaissance des outils de visualisation (Tableau, Power BI)',
                        'Expérience en cloud computing (AWS, GCP)'
                    ],
                    'benefits' => [
                        'Salaire compétitif de 100,000 à 150,000 DA',
                        'Projets d\'IA innovants',
                        'Formation continue et recherche',
                        'Environnement de travail moderne',
                        'Équipe d\'experts en data science'
                    ],
                    'salary_min' => 100000,
                    'salary_max' => 150000,
                    'location' => 'Alger',
                    'type' => 'CDI',
                    'experience_level' => 'Senior (4+ ans)',
                    'tags' => ['Data Science', 'Machine Learning', 'Python', 'IA'],
                    'status' => 'published',
                    'application_deadline' => now()->addDays(35),
                ],
                [
                    'company_id' => $fourthCompanyId,
                    'recruiter_id' => $recruiter->id,
                    'title' => 'Ingénieur DevOps',
                    'slug' => 'ingenieur-devops',
                    'description' => 'Rejoignez notre équipe technique en tant qu\'Ingénieur DevOps. Vous serez responsable de l\'infrastructure cloud, de l\'automatisation des déploiements, et de l\'optimisation de nos environnements de production. Expérience en containerisation et orchestration requise.',
                    'requirements' => [
                        'Expérience en DevOps (3+ ans)',
                        'Maîtrise de Docker et Kubernetes',
                        'Connaissance d\'AWS, Azure ou GCP',
                        'Expérience avec Terraform, Ansible',
                        'Maîtrise de Git et CI/CD',
                        'Connaissance de monitoring (Prometheus, Grafana)',
                        'Expérience en sécurité cloud'
                    ],
                    'benefits' => [
                        'Salaire de 90,000 à 130,000 DA',
                        'Technologies de pointe',
                        'Formation et certifications cloud',
                        'Environnement de travail flexible',
                        'Projets d\'infrastructure à grande échelle'
                    ],
                    'salary_min' => 90000,
                    'salary_max' => 130000,
                    'location' => 'Constantine',
                    'type' => 'CDI',
                    'experience_level' => 'Intermédiaire (3+ ans)',
                    'tags' => ['DevOps', 'Cloud', 'Docker', 'Kubernetes'],
                    'status' => 'published',
                    'application_deadline' => now()->addDays(28),
                ],
                [
                    'company_id' => $fifthCompanyId,
                    'recruiter_id' => $recruiter->id,
                    'title' => 'UX/UI Designer',
                    'slug' => 'ux-ui-designer',
                    'description' => 'Nous recherchons un UX/UI Designer créatif pour concevoir des interfaces utilisateur exceptionnelles. Vous travaillerez sur des applications web et mobile, en collaborant étroitement avec nos équipes de développement pour créer des expériences utilisateur mémorables.',
                    'requirements' => [
                        'Portfolio démontrant une expertise UX/UI',
                        'Maîtrise de Figma, Sketch, Adobe XD',
                        'Connaissance des principes UX',
                        'Expérience en recherche utilisateur',
                        'Connaissance du design responsive',
                        'Expérience en prototypage',
                        'Collaboration avec les développeurs'
                    ],
                    'benefits' => [
                        'Salaire de 70,000 à 100,000 DA',
                        'Projets créatifs et innovants',
                        'Formation en design thinking',
                        'Environnement de travail inspirant',
                        'Équipe créative et passionnée'
                    ],
                    'salary_min' => 70000,
                    'salary_max' => 100000,
                    'location' => 'Oran',
                    'type' => 'CDI',
                    'experience_level' => 'Intermédiaire (2+ ans)',
                    'tags' => ['UX', 'UI', 'Design', 'Figma'],
                    'status' => 'published',
                    'application_deadline' => now()->addDays(20),
                ],
                [
                    'company_id' => $sixthCompanyId,
                    'recruiter_id' => $recruiter->id,
                    'title' => 'Développeur Mobile React Native',
                    'slug' => 'developpeur-mobile-react-native',
                    'description' => 'Rejoignez notre équipe mobile et développez des applications mobiles cross-platform avec React Native. Vous travaillerez sur des projets innovants et utiliserez les dernières technologies mobiles pour créer des expériences utilisateur exceptionnelles.',
                    'requirements' => [
                        'Expérience en React Native (2+ ans)',
                        'Connaissance de JavaScript/TypeScript',
                        'Expérience avec les APIs REST',
                        'Connaissance des stores (Redux, Context)',
                        'Expérience en déploiement mobile',
                        'Connaissance des plateformes iOS/Android',
                        'Expérience avec les outils de test'
                    ],
                    'benefits' => [
                        'Salaire de 75,000 à 110,000 DA',
                        'Projets mobiles innovants',
                        'Formation continue en mobile',
                        'Environnement de travail moderne',
                        'Équipe technique passionnée'
                    ],
                    'salary_min' => 75000,
                    'salary_max' => 110000,
                    'location' => 'Alger',
                    'type' => 'CDI',
                    'experience_level' => 'Intermédiaire (2+ ans)',
                    'tags' => ['React Native', 'Mobile', 'JavaScript', 'iOS', 'Android'],
                    'status' => 'published',
                    'application_deadline' => now()->addDays(22),
                ],
            ];

            foreach ($jobs as $jobData) {
                \App\Models\Job::create($jobData);
            }
        }
    }
}
