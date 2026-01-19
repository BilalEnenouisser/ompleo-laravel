<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Company;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        // Get real statistics from database
        $stats = [
            'jobs_count' => Job::published()->count(),
            'companies_count' => Company::where('is_active', true)->count(),
            'candidates_count' => User::where('user_type', 'candidate')->count()
        ];

        // Get 6 companies with published job counts for home page (3x2 grid)
        $companies = Company::where('is_active', true)
            ->withCount(['jobs' => function($query) {
                $query->where('status', 'published');
            }])
            ->having('jobs_count', '>', 0)
            ->orderBy('jobs_count', 'desc')
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();

        // Get 6 latest published blogs for featured articles
        $featuredBlogs = \App\Models\Blog::where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();

        // Get 3 featured jobs (prioritize featured, then most recent)
        $jobs = Job::published()
            ->with('company')
            ->orderBy('is_featured', 'desc')
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        // Get latest jobs for search job section (8 jobs for the grid)
        $latestJobs = Job::published()
            ->orderBy('created_at', 'desc')
            ->limit(8)
            ->get();

        $features = [
            [
                'icon' => 'search',
                'title' => 'Recherche intelligente',
                'description' => 'Trouvez rapidement les emplois qui correspondent à vos compétences et aspirations grâce à notre algorithme intelligent.'
            ],
            [
                'icon' => 'lightning',
                'title' => 'Matching automatique',
                'description' => 'Notre système de matching connecte automatiquement les candidats aux offres qui leur correspondent le mieux.'
            ],
            [
                'icon' => 'check',
                'title' => 'Processus simplifié',
                'description' => 'Postulez en un clic et suivez l\'avancement de vos candidatures en temps réel.'
            ],
            [
                'icon' => 'users',
                'title' => 'Réseau professionnel',
                'description' => 'Connectez-vous avec des professionnels et développez votre réseau dans votre secteur d\'activité.'
            ],
            [
                'icon' => 'chart',
                'title' => 'Analytics avancés',
                'description' => 'Suivez les performances de vos offres et optimisez votre stratégie de recrutement.'
            ],
            [
                'icon' => 'shield',
                'title' => 'Sécurité garantie',
                'description' => 'Vos données sont protégées par les plus hauts standards de sécurité et de confidentialité.'
            ]
        ];

        return view('home', compact('stats', 'features', 'companies', 'featuredBlogs', 'jobs', 'latestJobs'));
    }
}

