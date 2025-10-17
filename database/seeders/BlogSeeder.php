<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Blog;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $blogs = [
            [
                'title' => 'Comment rédiger un CV qui attire l\'attention des recruteurs',
                'slug' => 'comment-rediger-cv-attire-attention-recruteurs',
                'excerpt' => 'Découvrez les secrets pour créer un CV percutant qui vous démarque de la concurrence et attire l\'œil des recruteurs.',
                'content' => 'Dans le monde professionnel d\'aujourd\'hui, votre CV est votre première impression. Il doit captiver l\'attention des recruteurs en quelques secondes seulement. Voici nos conseils pour créer un CV qui se démarque :

## 1. Structure et mise en page
- Utilisez une mise en page claire et professionnelle
- Organisez les informations par ordre d\'importance
- Utilisez des puces pour faciliter la lecture
- Limitez votre CV à 2 pages maximum

## 2. Informations essentielles
- Coordonnées complètes et professionnelles
- Photo professionnelle (optionnelle mais recommandée)
- Résumé professionnel accrocheur
- Expérience professionnelle détaillée
- Formation et diplômes
- Compétences techniques et linguistiques

## 3. Personnalisation
- Adaptez votre CV à chaque poste
- Utilisez les mots-clés du secteur
- Mettez en avant vos réalisations chiffrées
- Soyez honnête et authentique

Un CV bien rédigé peut faire la différence entre être convoqué en entretien ou être écarté. Prenez le temps de le perfectionner !',
                'author_name' => 'Sarah Benali',
                'category' => 'Conseils',
                'status' => 'draft',
                'tags' => ['CV', 'Recrutement', 'Conseils'],
                'views' => 156,
                'reading_time' => 5,
                'featured_image' => null,
            ],
            [
                'title' => 'Les compétences digitales les plus recherchées en 2024',
                'slug' => 'competences-digitales-recherchees-2024',
                'excerpt' => 'Explorez les compétences numériques essentielles que les entreprises recherchent activement cette année.',
                'content' => 'Le monde du travail évolue rapidement avec l\'avènement des nouvelles technologies. Les entreprises recherchent de plus en plus de profils maîtrisant certaines compétences digitales spécifiques. Voici un aperçu des compétences les plus demandées en 2024 :

## 1. Intelligence Artificielle et Machine Learning
- Compréhension des algorithmes d\'IA
- Utilisation d\'outils d\'IA générative
- Analyse prédictive et data science
- Automatisation des processus

## 2. Cybersécurité
- Protection des données sensibles
- Gestion des risques informatiques
- Conformité RGPD et réglementations
- Audit de sécurité

## 3. Cloud Computing
- Migration vers le cloud
- Gestion des infrastructures cloud
- Sécurité cloud
- Optimisation des coûts

## 4. Développement Web et Mobile
- Frameworks modernes (React, Vue.js, Angular)
- Développement mobile (Flutter, React Native)
- APIs et microservices
- DevOps et CI/CD

## 5. Marketing Digital
- SEO et référencement naturel
- Publicité en ligne (Google Ads, Facebook Ads)
- Analytics et mesure de performance
- Content marketing et réseaux sociaux

Ces compétences sont devenues indispensables dans la plupart des secteurs d\'activité. Investir dans leur apprentissage vous donnera un avantage concurrentiel significatif sur le marché de l\'emploi.',
                'author_name' => 'Ahmed Belkacem',
                'category' => 'Formation',
                'status' => 'published',
                'tags' => ['Compétences', 'Digital', 'Tendances'],
                'views' => 132,
                'reading_time' => 7,
                'featured_image' => null,
            ],
        ];

        foreach ($blogs as $blog) {
            Blog::create($blog);
        }
    }
}