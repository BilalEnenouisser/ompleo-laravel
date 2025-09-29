@php
$jobs = [
    [
        'id' => 1,
        'title' => 'Community Manager',
        'company' => 'Impactome',
        'type' => 'CDI',
        'location' => 'Alger',
        'workType' => 'Présentiel',
        'postedDate' => 'Il y a 2 jours',
        'salary' => '60,000 - 80,000 DA',
        'slug' => 'community-manager-impactome'
    ],
    [
        'id' => 2,
        'title' => 'Conseiller Commercial',
        'company' => 'Condor',
        'type' => 'CDI',
        'location' => 'Kouba',
        'workType' => 'Hybride',
        'postedDate' => 'Il y a 3 jours',
        'salary' => '70,000 - 90,000 DA',
        'slug' => 'conseiller-commercial-condor'
    ],
    [
        'id' => 3,
        'title' => 'Frontend Developer',
        'company' => 'Impactome',
        'type' => 'CDI',
        'location' => 'Remote',
        'workType' => 'Télétravail',
        'postedDate' => 'Il y a 1 jour',
        'salary' => '80,000 - 120,000 DA',
        'slug' => 'frontend-developer-impactome'
    ],
    [
        'id' => 4,
        'title' => 'Graphic Designer',
        'company' => 'Condor',
        'type' => 'CDI',
        'location' => 'Hydra',
        'workType' => 'Présentiel',
        'postedDate' => 'Il y a 4 jours',
        'salary' => '65,000 - 85,000 DA',
        'slug' => 'graphic-designer-condor'
    ],
    [
        'id' => 5,
        'title' => 'Data Analyst',
        'company' => 'Sonatrach',
        'type' => 'CDI',
        'location' => 'Alger',
        'workType' => 'Hybride',
        'postedDate' => 'Il y a 2 jours',
        'salary' => '90,000 - 130,000 DA',
        'slug' => 'data-analyst-sonatrach'
    ],
    [
        'id' => 6,
        'title' => 'Product Manager',
        'company' => 'Ompleo',
        'type' => 'CDI',
        'location' => 'Remote',
        'workType' => 'Télétravail',
        'postedDate' => 'Il y a 1 jour',
        'salary' => '100,000 - 150,000 DA',
        'slug' => 'product-manager-ompleo'
    ],
];
@endphp

<section class="py-20 bg-[#dadad2] dark:bg-[#1f1f1f] relative overflow-hidden">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12 dark:text-gray-100">
            <h2 class="text-4xl font-bold text-gray-900 dark:text-gray-100 mb-4">
                Nos Offres d'emploi populaires
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($jobs as $job)
            <div class="bg-white dark:bg-[#2b2b2b] rounded-2xl p-6 shadow-md hover:shadow-xl transition-all duration-500 border border-gray-200 dark:border-[#333333] hover:-translate-y-2">
                <div class="flex items-start justify-between mb-4">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 group-hover:text-[#00b6b4] transition-colors duration-200">
                        {{ $job['title'] }}
                    </h3>
                </div>
                
                <div class="flex items-center gap-4 text-gray-600 dark:text-gray-400 mb-3">
                    <div class="flex items-center gap-1">
                        <svg class="w-4 h-4 text-[#00b6b4]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        <span class="font-medium text-gray-700 dark:text-gray-300">{{ $job['company'] }}</span>
                    </div>
                    <div class="flex items-center gap-1">
                        <svg class="w-4 h-4 text-[#00b6b4]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span>{{ $job['location'] }}</span>
                    </div>
                </div>
                
                <div class="flex items-center justify-between mb-6">
                    <span class="px-3 py-1 bg-[#00b6b4]/10 text-[#00b6b4] rounded-full text-sm font-medium">
                        {{ $job['type'] }}
                    </span>
                    <div class="flex items-center gap-1 text-sm text-gray-500 dark:text-gray-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>{{ $job['postedDate'] }}</span>
                    </div>
                </div>
                
                <div class="flex items-center justify-between mb-4">
                    <div class="text-lg font-bold text-gray-900 dark:text-gray-100">
                        {{ $job['salary'] }}
                    </div>
                </div>
                
                <a 
                    href="{{ route('jobs.show', $job['slug']) }}"
                    class="w-full bg-[#00b6b4] text-white py-3 rounded-xl font-medium transition-colors duration-200 flex items-center justify-center gap-2 hover:bg-[#009e9c] shadow-sm"
                >
                    Voir l'offre
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-12 dark:text-gray-100">
            <a 
                href="{{ route('jobs.index') }}"
                class="inline-flex items-center gap-2 px-8 py-3 bg-white dark:bg-[#2b2b2b] text-[#00b6b4] rounded-xl font-medium border border-[#00b6b4] hover:bg-[#00b6b4] hover:text-white transition-all duration-300"
            >
                Voir toutes les offres
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
    </div>
</section>
