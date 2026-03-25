@php
// Optional per-card icon path; defaults to heroico.svg until custom assets are added
$defaultCategoryIcon = 'storage/home_page/heroico.svg';
$categories = [
    [
        'name' => 'Design & Création',
        'slug' => 'design-creation',
        'search' => 'design',
        'icon' => $defaultCategoryIcon,
    ],
    [
        'name' => 'Développement & Informatique',
        'slug' => 'developpement-informatique',
        'search' => 'développement',
        'icon' => $defaultCategoryIcon,
    ],
    [
        'name' => 'Finance & Comptabilité',
        'slug' => 'finance-comptabilite',
        'search' => 'finance',
        'icon' => $defaultCategoryIcon,
    ],
    [
        'name' => 'Marketing & Croissance',
        'slug' => 'marketing-croissance',
        'search' => 'marketing',
        'icon' => $defaultCategoryIcon,
    ],
    [
        'name' => 'Ressources Humaines',
        'slug' => 'ressources-humaines',
        'search' => 'rh',
        'icon' => $defaultCategoryIcon,
    ],
    [
        'name' => 'Management & Direction',
        'slug' => 'management-direction',
        'search' => 'management',
        'icon' => $defaultCategoryIcon,
    ],
    [
        'name' => 'Opérations & Logistique',
        'slug' => 'operations-logistique',
        'search' => 'opérations',
        'icon' => $defaultCategoryIcon,
    ],
    [
        'name' => 'Support & Service Client',
        'slug' => 'support-service-client',
        'search' => 'support',
        'icon' => $defaultCategoryIcon,
    ],
];
@endphp

<section class="platform-section relative bg-[#212221] overflow-hidden categories-section">
    <!-- Background Image -->
    <div class="absolute top-0 right-0 bottom-0 hidden lg:block pointer-events-none">
        <img src="{{ asset('storage/home_page/job/right.png') }}" alt="Background" class="h-full w-auto object-cover" style="object-position: right;">
    </div>
    
    <div class="platform-container relative z-10">
        <!-- Header -->
        <div class="text-center mb-12 pb-8">
            <div class="flex items-center justify-center gap-2 mb-4 pb-2">
                <img src="{{ asset('storage/home_page/job/icon2.svg') }}" alt="Icon" class="w-7 h-7">
                <span class="text-[0.9375rem]" style="color: #d9d9d9;">Explorer les offres d'emploi</span>
            </div>
            <h2 class="font-bold text-white pb-4 md:text-6xl">
                Toutes les catégories
            </h2>
            <p class="text-[0.9375rem] md:text-lg text-white">
                Découvrez les meilleures catégories d'emplois
            </p>
        </div>

        <!-- Categories Grid (4x2) -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-12 justify-center w-full max-w-[50rem] mx-auto">
            @foreach($categories as $category)
            <a href="{{ route('jobs.index', ['search' => $category['search']]) }}" class="block group">
                <div class="p-[1px] cursor-pointer transition-colors duration-300" style="background: linear-gradient(135deg, #165c5b, #00fadc, #165c5b); border-radius: 12px;">
                    <div class="rounded-xl flex flex-col items-center justify-center gap-1.5 min-h-[100px] py-3 px-5 sm:px-6 bg-[#2b2b2b] group-hover:bg-[#383838] transition-colors duration-300 shadow-[0_20px_22px_rgba(0,0,0,0.4)]" style="border-radius: 12px;">
                        <img src="{{ asset($category['icon'] ?? $defaultCategoryIcon) }}" alt="" class="w-6 h-6 shrink-0 object-contain pointer-events-none" width="24" height="24" aria-hidden="true">
                        <span class="text-white font-medium text-sm leading-tight text-center block w-full" style="word-break: break-word; line-height: 1.35;">{{ $category['name'] }}</span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>

        <!-- Bottom Button -->
        <div class="text-center">
            <a href="{{ route('jobs.index', ['tab' => 'category']) }}" class="btn-premium-green mx-auto">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="11" cy="11" r="8"></circle>
                    <path d="m21 21-4.35-4.35"></path>
                </svg>
                <span>Voir toutes les catégories</span>
            </a>
        </div>
    </div>
</section>
