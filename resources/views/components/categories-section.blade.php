@php
$categories = [
    [
        'name' => 'Design & Création',
        'slug' => 'design-creation',
        'search' => 'design'
    ],
    [
        'name' => 'Développement & Informatique',
        'slug' => 'developpement-informatique',
        'search' => 'développement'
    ],
    [
        'name' => 'Finance & Comptabilité',
        'slug' => 'finance-comptabilite',
        'search' => 'finance'
    ],
    [
        'name' => 'Marketing & Croissance',
        'slug' => 'marketing-croissance',
        'search' => 'marketing'
    ],
    [
        'name' => 'Ressources Humaines',
        'slug' => 'ressources-humaines',
        'search' => 'rh'
    ],
    [
        'name' => 'Management & Direction',
        'slug' => 'management-direction',
        'search' => 'management'
    ],
    [
        'name' => 'Opérations & Logistique',
        'slug' => 'operations-logistique',
        'search' => 'opérations'
    ],
    [
        'name' => 'Support & Service Client',
        'slug' => 'support-service-client',
        'search' => 'support'
    ],
];
@endphp

<section class="relative py-20 bg-[#1f1f1f] overflow-hidden">
    <!-- Background Image -->
    <div class="absolute top-0 right-0 bottom-0 hidden lg:block pointer-events-none">
        <img src="{{ asset('storage/home_page/job/right.png') }}" alt="Background" class="h-full w-auto object-cover" style="object-position: right;">
    </div>
    
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <!-- Header -->
        <div class="text-center mb-12 pb-8">
            <div class="flex items-center justify-center gap-2 mb-4 pb-2">
                <img src="{{ asset('storage/home_page/job/icon2.svg') }}" alt="Icon" class="w-7 h-7">
                <span class="text-base" style="color: #d9d9d9;">Explorer les offres d'emploi</span>
            </div>
            <h2 class="text-5xl md:text-6xl font-bold text-white pb-4">
                Toutes les catégories
            </h2>
            <p class="text-lg text-white">
                Découvrez les meilleures catégories d'emplois
            </p>
        </div>

        <!-- Categories Grid (4x2) -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-12 justify-center max-w-3xl mx-auto">
            @foreach($categories as $category)
            <a href="{{ route('jobs.index', ['search' => $category['search']]) }}" class="block">
                <div class="p-[1px] hover:opacity-90 transition-opacity duration-300 cursor-pointer" style="background: linear-gradient(135deg, #165c5b, #00fadc, #165c5b); border-radius: 10px;">
                    <div class="rounded-xl text-center transition-all duration-300" style="background-color: #2B2B2B; border-radius: 10px; display: flex; align-items: center; justify-content: center; padding: 12px; box-shadow: 0 20px 22px rgba(0, 0, 0, 0.4); height: 90px;">
                        <span class="text-white font-medium text-sm leading-tight block" style="word-break: break-word; line-height: 1.4;">{!! str_replace(' & ', ' &<br>', $category['name']) !!}</span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>

        <!-- Bottom Button -->
        <div class="text-center">
            <a href="{{ route('jobs.index') }}" class="btn-premium-green mx-auto">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="11" cy="11" r="8"></circle>
                    <path d="m21 21-4.35-4.35"></path>
                </svg>
                <span>Voir toutes les catégories</span>
            </a>
        </div>
    </div>
</section>
