<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        // Fake data for about page
        $stats = [
            'jobs_count' => 10000,
            'companies_count' => 5000,
            'candidates_count' => 50000
        ];

        $values = [
            [
                'icon' => 'heart',
                'title' => 'Transparence',
                'description' => 'Nous croyons en la transparence totale dans nos processus de recrutement et nos relations avec nos utilisateurs.'
            ],
            [
                'icon' => 'users',
                'title' => 'Diversité',
                'description' => 'Nous célébrons la diversité et l\'inclusion, créant un environnement où chacun peut s\'épanouir.'
            ],
            [
                'icon' => 'lightning',
                'title' => 'Innovation',
                'description' => 'Nous repoussons constamment les limites pour améliorer l\'expérience de recrutement.'
            ],
            [
                'icon' => 'check',
                'title' => 'Qualité',
                'description' => 'Nous nous engageons à fournir des services de la plus haute qualité à nos utilisateurs.'
            ],
            [
                'icon' => 'dollar',
                'title' => 'Équité',
                'description' => 'Nous nous battons pour un recrutement équitable et sans discrimination.'
            ],
            [
                'icon' => 'heart',
                'title' => 'Empathie',
                'description' => 'Nous comprenons les défis de la recherche d\'emploi et du recrutement.'
            ]
        ];

        $team = [
            [
                'name' => 'Ahmed Khelil',
                'position' => 'Fondateur & CEO',
                'initials' => 'AK',
                'description' => 'Passionné par l\'innovation et l\'entrepreneuriat, Ahmed a créé OMPLEO pour révolutionner le recrutement en Algérie.'
            ],
            [
                'name' => 'Sarah Merabet',
                'position' => 'CTO',
                'initials' => 'SM',
                'description' => 'Experte en technologie, Sarah dirige notre équipe technique pour créer des solutions innovantes.'
            ],
            [
                'name' => 'Yasmine Benali',
                'position' => 'Head of Marketing',
                'initials' => 'YB',
                'description' => 'Créative et stratégique, Yasmine développe notre présence sur le marché algérien.'
            ]
        ];

        $timeline = [
            [
                'year' => '2020',
                'title' => 'Les débuts',
                'description' => 'Fondation d\'OMPLEO avec la vision de révolutionner le recrutement en Algérie.'
            ],
            [
                'year' => '2021',
                'title' => 'Première version',
                'description' => 'Lancement de notre plateforme avec 100 entreprises partenaires et 1000 candidats.'
            ],
            [
                'year' => '2023',
                'title' => 'Expansion',
                'description' => 'Plus de 5000 entreprises et 50000 candidats nous font confiance.'
            ],
            [
                'year' => '2024',
                'title' => 'Innovation continue',
                'description' => 'Lancement de nouvelles fonctionnalités d\'IA et d\'expansion régionale.'
            ]
        ];

        return view('about', compact('stats', 'values', 'team', 'timeline'));
    }
}

