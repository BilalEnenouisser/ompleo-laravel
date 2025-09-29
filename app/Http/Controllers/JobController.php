<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index(Request $request)
    {
        // Fake data for jobs
        $jobs = collect([
            (object) [
                'id' => 1,
                'title' => 'Développeur Full Stack Senior',
                'company' => (object) [
                    'name' => 'TechCorp Algeria',
                    'logo' => asset('images/companies/techcorp.png')
                ],
                'location' => 'Alger',
                'salary_range' => '80,000 - 120,000 DA',
                'type' => 'CDI',
                'description' => 'Nous recherchons un développeur full stack expérimenté pour rejoindre notre équipe dynamique. Vous travaillerez sur des projets innovants et utiliserez les dernières technologies.',
                'tags' => ['React', 'Node.js', 'MongoDB', 'AWS'],
                'created_at' => now()->subDays(2)
            ],
            (object) [
                'id' => 2,
                'title' => 'Chef de Projet Marketing Digital',
                'company' => (object) [
                    'name' => 'Marketing Plus',
                    'logo' => asset('images/companies/marketing-plus.png')
                ],
                'location' => 'Oran',
                'salary_range' => '60,000 - 90,000 DA',
                'type' => 'CDI',
                'description' => 'Rejoignez notre équipe marketing et pilotez des campagnes digitales innovantes. Expérience en gestion d\'équipe requise.',
                'tags' => ['Marketing', 'Digital', 'Gestion', 'Équipe'],
                'created_at' => now()->subDays(5)
            ],
            (object) [
                'id' => 3,
                'title' => 'Ingénieur DevOps',
                'company' => (object) [
                    'name' => 'CloudTech Solutions',
                    'logo' => asset('images/companies/cloudtech.png')
                ],
                'location' => 'Constantine',
                'salary_range' => '70,000 - 100,000 DA',
                'type' => 'CDI',
                'description' => 'Expert en DevOps recherché pour optimiser nos infrastructures cloud et automatiser nos processus de déploiement.',
                'tags' => ['DevOps', 'AWS', 'Docker', 'Kubernetes'],
                'created_at' => now()->subDays(1)
            ],
            (object) [
                'id' => 4,
                'title' => 'Designer UX/UI',
                'company' => (object) [
                    'name' => 'Creative Studio',
                    'logo' => asset('images/companies/creative-studio.png')
                ],
                'location' => 'Télétravail',
                'salary_range' => '50,000 - 80,000 DA',
                'type' => 'Freelance',
                'description' => 'Créatif et passionné par l\'expérience utilisateur, vous concevrez des interfaces intuitives et esthétiques.',
                'tags' => ['UX', 'UI', 'Figma', 'Prototypage'],
                'created_at' => now()->subDays(3)
            ],
            (object) [
                'id' => 5,
                'title' => 'Analyste Financier',
                'company' => (object) [
                    'name' => 'Finance Pro',
                    'logo' => asset('images/companies/finance-pro.png')
                ],
                'location' => 'Alger',
                'salary_range' => '65,000 - 95,000 DA',
                'type' => 'CDI',
                'description' => 'Analyste financier expérimenté pour analyser les performances et proposer des stratégies d\'optimisation.',
                'tags' => ['Finance', 'Analyse', 'Excel', 'Reporting'],
                'created_at' => now()->subDays(7)
            ],
            (object) [
                'id' => 6,
                'title' => 'Développeur Mobile React Native',
                'company' => (object) [
                    'name' => 'MobileFirst',
                    'logo' => asset('images/companies/mobilefirst.png')
                ],
                'location' => 'Blida',
                'salary_range' => '75,000 - 110,000 DA',
                'type' => 'CDI',
                'description' => 'Développeur mobile spécialisé React Native pour créer des applications cross-platform performantes.',
                'tags' => ['React Native', 'Mobile', 'iOS', 'Android'],
                'created_at' => now()->subDays(4)
            ]
        ]);

        // Apply filters
        if ($request->filled('search')) {
            $jobs = $jobs->filter(function ($job) use ($request) {
                return stripos($job->title, $request->search) !== false || 
                       stripos($job->company->name, $request->search) !== false ||
                       stripos($job->description, $request->search) !== false;
            });
        }

        if ($request->filled('location')) {
            $jobs = $jobs->filter(function ($job) use ($request) {
                return stripos($job->location, $request->location) !== false;
            });
        }

        if ($request->filled('category')) {
            // Simple category filtering based on tags
            $jobs = $jobs->filter(function ($job) use ($request) {
                return in_array($request->category, array_map('strtolower', $job->tags));
            });
        }

        // Paginate results
        $perPage = 6;
        $currentPage = $request->get('page', 1);
        $total = $jobs->count();
        $jobs = $jobs->forPage($currentPage, $perPage);

        // Featured companies
        $featuredCompanies = collect([
            (object) [
                'name' => 'TechCorp Algeria',
                'logo' => asset('images/companies/techcorp.png'),
                'jobs_count' => 12
            ],
            (object) [
                'name' => 'Marketing Plus',
                'logo' => asset('images/companies/marketing-plus.png'),
                'jobs_count' => 8
            ],
            (object) [
                'name' => 'CloudTech Solutions',
                'logo' => asset('images/companies/cloudtech.png'),
                'jobs_count' => 15
            ]
        ]);

        return view('jobs.index', compact('jobs', 'featuredCompanies'));
    }

    public function show($id)
    {
        // Fake job data
        $job = (object) [
            'id' => $id,
            'title' => 'Développeur Full Stack Senior',
            'company' => (object) [
                'name' => 'TechCorp Algeria',
                'logo' => asset('images/companies/techcorp.png'),
                'description' => 'TechCorp Algeria est une entreprise leader dans le domaine des technologies de l\'information en Algérie.',
                'website' => 'https://techcorp.dz',
                'size' => '50-100 employés',
                'industry' => 'Technologies de l\'information'
            ],
            'location' => 'Alger',
            'salary_range' => '80,000 - 120,000 DA',
            'type' => 'CDI',
            'experience_level' => 'Senior (5+ ans)',
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
            'tags' => ['React', 'Node.js', 'MongoDB', 'AWS', 'Agile'],
            'created_at' => now()->subDays(2),
            'application_deadline' => now()->addDays(30)
        ];

        return view('jobs.show', compact('job'));
    }

    public function create()
    {
        return view('jobs.create');
    }
}

