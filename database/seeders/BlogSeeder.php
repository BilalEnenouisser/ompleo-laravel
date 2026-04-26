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
                'views' => 135,
                'reading_time' => 7,
                'featured_image' => null,
            ],
            [
                'title' => 'Comment réussir son entretien d\'embauche en 2024',
                'slug' => 'reussir-entretien-embauche-2024',
                'excerpt' => 'Découvrez les stratégies gagnantes pour impressionner les recruteurs et décrocher le poste de vos rêves.',
                'content' => 'L\'entretien d\'embauche reste l\'étape cruciale du processus de recrutement. Avec l\'évolution des pratiques RH, voici comment vous préparer efficacement :

## Préparation avant l\'entretien
- Recherchez l\'entreprise et ses valeurs
- Préparez des questions pertinentes
- Répétez votre présentation personnelle
- Préparez des exemples concrets de vos réalisations

## Le jour J
- Arrivez 10 minutes en avance
- Habillez-vous de manière professionnelle
- Maintenez un contact visuel
- Soyez authentique et confiant

## Questions fréquentes et réponses
- "Parlez-moi de vous" : Structurez votre réponse
- "Pourquoi voulez-vous ce poste ?" : Montrez votre motivation
- "Quelles sont vos faiblesses ?" : Soyez honnête mais constructif
- "Avez-vous des questions ?" : Préparez 3-4 questions pertinentes

## Après l\'entretien
- Envoyez un email de remerciement
- Restez patient et positif
- Continuez vos recherches en parallèle

Un entretien réussi se prépare en amont. La confiance et l\'authenticité sont vos meilleurs atouts !',
                'author_name' => 'Fatima Zohra',
                'category' => 'Conseils',
                'status' => 'published',
                'tags' => ['Entretien', 'Recrutement', 'Conseils'],
                'views' => 89,
                'reading_time' => 6,
                'featured_image' => null,
            ],
            [
                'title' => 'L\'évolution du télétravail en Algérie',
                'slug' => 'evolution-teletravail-algerie',
                'excerpt' => 'Analyse de l\'adoption du télétravail en Algérie et ses impacts sur le marché de l\'emploi.',
                'content' => 'Le télétravail a connu une croissance exponentielle en Algérie depuis 2020. Cette transformation du monde du travail présente de nouveaux défis et opportunités.

## L\'état actuel du télétravail
- 35% des entreprises algériennes proposent du télétravail
- Secteurs les plus concernés : IT, marketing, finance
- Défis techniques : connectivité internet, équipements

## Avantages pour les employés
- Équilibre vie professionnelle/personnelle
- Réduction des déplacements
- Autonomie et flexibilité
- Économies sur les transports

## Défis pour les employeurs
- Gestion des équipes à distance
- Sécurité des données
- Mesure de la productivité
- Communication et collaboration

## Compétences requises
- Maîtrise des outils collaboratifs
- Autonomie et discipline
- Communication digitale
- Gestion du temps

## Perspectives d\'avenir
Le télétravail hybride semble être la solution d\'avenir, combinant flexibilité et collaboration. Les entreprises qui s\'adaptent rapidement auront un avantage concurrentiel sur le marché du travail.',
                'author_name' => 'Karim Boudjedra',
                'category' => 'Tendances',
                'status' => 'published',
                'tags' => ['Télétravail', 'Tendances', 'Algérie'],
                'views' => 156,
                'reading_time' => 8,
                'featured_image' => null,
            ],
            [
                'title' => 'Les métiers de la tech qui recrutent en 2024',
                'slug' => 'metiers-tech-recruent-2024',
                'excerpt' => 'Découvrez les postes tech les plus demandés et les salaires moyens en Algérie.',
                'content' => 'Le secteur technologique continue de croître en Algérie, créant de nombreuses opportunités d\'emploi. Voici les métiers les plus recherchés :

## Développement Web
- **Développeur Full Stack** : 80,000 - 120,000 DA
- **Développeur Frontend** : 60,000 - 90,000 DA
- **Développeur Backend** : 70,000 - 100,000 DA

## Data & Intelligence Artificielle
- **Data Scientist** : 100,000 - 150,000 DA
- **Data Analyst** : 70,000 - 100,000 DA
- **Ingénieur IA** : 120,000 - 180,000 DA

## Cybersécurité
- **Analyste sécurité** : 90,000 - 130,000 DA
- **Pentester** : 100,000 - 140,000 DA
- **Responsable sécurité** : 120,000 - 160,000 DA

## Cloud & DevOps
- **Ingénieur DevOps** : 90,000 - 130,000 DA
- **Architecte Cloud** : 110,000 - 150,000 DA
- **Ingénieur SRE** : 100,000 - 140,000 DA

## Compétences transversales
- Maîtrise de l\'anglais technique
- Certifications professionnelles
- Expérience en projets open source
- Soft skills : communication, travail d\'équipe

Le marché tech algérien offre de belles perspectives pour les profils qualifiés !',
                'author_name' => 'Nour El Houda',
                'category' => 'Tech',
                'status' => 'published',
                'tags' => ['Tech', 'Emploi', 'Salaires'],
                'views' => 203,
                'reading_time' => 9,
                'featured_image' => null,
            ],
            [
                'title' => 'Comment négocier son salaire en entretien',
                'slug' => 'negocier-salaire-entretien',
                'excerpt' => 'Stratégies et conseils pour négocier efficacement votre rémunération lors d\'un entretien d\'embauche.',
                'content' => 'La négociation salariale est un moment crucial de l\'entretien d\'embauche. Voici comment aborder cette étape avec confiance :

## Préparation avant la négociation
- Recherchez les salaires moyens du poste
- Évaluez votre valeur sur le marché
- Préparez vos arguments (expérience, compétences)
- Définissez votre fourchette salariale

## Stratégies de négociation
- Attendez que l\'employeur mentionne le salaire en premier
- Justifiez votre demande avec des exemples concrets
- Considérez l\'ensemble de la rémunération (primes, avantages)
- Restez professionnel et positif

## Éléments à négocier
- Salaire de base
- Primes de performance
- Avantages en nature
- Formation et développement
- Horaires de travail

## Phrases utiles
- "Basé sur mon expérience et mes compétences..."
- "J\'aimerais discuter de la rémunération globale..."
- "Pouvez-vous me donner plus de détails sur..."
- "Serait-il possible de revoir cette proposition ?"

## Erreurs à éviter
- Négocier trop tôt dans l\'entretien
- Être agressif ou inflexible
- Accepter la première offre sans réfléchir
- Négliger les avantages non-financiers

Une négociation réussie se base sur la préparation et la confiance en votre valeur !',
                'author_name' => 'Sara Amrani',
                'category' => 'Conseils',
                'status' => 'published',
                'tags' => ['Négociation', 'Salaire', 'Conseils'],
                'views' => 124,
                'reading_time' => 5,
                'featured_image' => null,
            ],
            [
                'title' => 'L\'entrepreneuriat digital en Algérie',
                'slug' => 'entrepreneuriat-digital-algerie',
                'excerpt' => 'Guide complet pour lancer votre startup digitale en Algérie et réussir dans l\'écosystème tech local.',
                'content' => 'L\'écosystème entrepreneurial algérien connaît une transformation digitale majeure. Voici comment naviguer dans ce paysage en évolution :

## L\'écosystème startup algérien
- Incubateurs et accélérateurs en croissance
- Financement disponible (investisseurs locaux et internationaux)
- Communauté entrepreneuriale active
- Support gouvernemental pour l\'innovation

## Secteurs porteurs
- **FinTech** : Solutions de paiement, banque digitale
- **EdTech** : Plateformes d\'apprentissage en ligne
- **HealthTech** : Télémédecine, gestion de santé
- **AgriTech** : Solutions pour l\'agriculture
- **E-commerce** : Marketplaces et solutions logistiques

## Étapes pour lancer votre startup
1. **Validation de l\'idée** : Étude de marché, MVP
2. **Équipe fondatrice** : Compétences complémentaires
3. **Business plan** : Modèle économique viable
4. **Financement** : Bootstrap, investisseurs, subventions
5. **Développement** : Produit, équipe, clients

## Défis spécifiques
- Réglementation et conformité
- Accès au financement
- Talents techniques
- Infrastructure digitale

## Ressources utiles
- Incubateurs : Algérie Digitale, Startup DZ
- Événements : Startup Weekend, Tech Days
- Communautés : Facebook groups, LinkedIn
- Formation : MOOCs, certifications

L\'entrepreneuriat digital offre de belles opportunités pour ceux qui osent innover !',
                'author_name' => 'Yacine Khelil',
                'category' => 'Entrepreneuriat',
                'status' => 'published',
                'tags' => ['Startup', 'Digital', 'Innovation'],
                'views' => 178,
                'reading_time' => 10,
                'featured_image' => null,
            ],
        ];

        foreach ($blogs as $blog) {
            Blog::create($blog);
        }
    }
}