<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Fake data for the homepage
        $stats = [
            'jobs_count' => 10000,
            'companies_count' => 5000,
            'candidates_count' => 50000
        ];

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

        return view('home', compact('stats', 'features'));
    }
}

