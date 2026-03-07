@php
$features = [
    [
        'icon' => 'target',
        'title' => 'Plateforme intelligente',
        'description' => 'L’IA vous connecte aux emplois qui vous conviennent.',
    ],
    [
        'icon' => 'shield',
        'title' => 'Service équitable',
        'description' => 'Juste, quel que soit votre parcours.',
    ],
    [
        'icon' => 'briefcase',
        'title' => 'Écosystème complet',
        'description' => 'Offres, formation, assistance centralisées.',
    ],
    [
        'icon' => 'clock',
        'title' => 'Profils vérifiés',
        'description' => 'Candidatures sérieuses, certifiées.',
    ],
];
@endphp

<section class="relative py-28 px-4 bg-[#e0e3df] dark:bg-[#1f1f1f] overflow-hidden">
    <!-- Background bubbles -->
    <div class="absolute inset-0 z-0 overflow-hidden">
        <div class="absolute -top-20 -left-20 w-80 h-80 bg-[#00b6b4]/30 dark:bg-[#00b6b4]/20 rounded-full blur-3xl animate-bubble-float-1"></div>
        <div class="absolute top-40 right-10 w-96 h-96 bg-[#00b6b4] opacity-20 dark:opacity-10 rounded-full blur-[100px] animate-ping-slow hidden md:block"></div>
    </div>

    <!-- Title -->
    <h2 class="relative z-10 text-4xl md:text-5xl font-bold text-center mb-20 text-gray-900 dark:text-gray-100 scroll-animate" data-animate="title">
        Pourquoi choisir <span class="text-[#00b6b4] dark:text-[#00b6b4]">Ompleo</span> ?
    </h2>

    <!-- Feature Cards -->
    <div class="relative z-10 grid grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-10">
        @foreach($features as $index => $feature)
        <div class="relative md:bg-white/80 md:dark:bg-[#2b2b2b]/80 md:border md:border-white/30 md:dark:border-[#333333]/50 md:shadow-xl md:backdrop-blur-md md:rounded-[2rem_0.5rem_2rem_0.5rem] p-4 md:p-8 md:transition-all md:duration-500 hover:brightness-90 md:hover:shadow-2xl scroll-animate" data-animate="card" data-delay="{{ $index * 0.1 }}">
            <div class="flex items-center justify-center md:justify-center w-14 h-14 md:w-14 md:h-14 mb-4 md:mb-6 rounded-xl bg-[#00b6b4]/10 dark:bg-[#00b6b4]/20 text-[#00b6b4] mx-auto md:mx-0">
                @if($feature['icon'] === 'target')
                    <!-- Target icon from Lucide React -->
                    <svg class="w-7 h-7 md:w-7 md:h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10"></circle>
                        <circle cx="12" cy="12" r="6"></circle>
                        <circle cx="12" cy="12" r="2"></circle>
                    </svg>
                @elseif($feature['icon'] === 'shield')
                    <!-- Shield icon from Lucide React -->
                    <svg class="w-7 h-7 md:w-7 md:h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                    </svg>
                @elseif($feature['icon'] === 'briefcase')
                    <!-- Briefcase icon from Lucide React -->
                    <svg class="w-7 h-7 md:w-7 md:h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                        <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                    </svg>
                @elseif($feature['icon'] === 'clock')
                    <!-- Clock icon from Lucide React -->
                    <svg class="w-7 h-7 md:w-7 md:h-7" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <path d="M22 4 12 14.01l-3-3"></path>
                    </svg>
                @endif
            </div>
            <h3 class="text-sm md:text-lg font-bold text-gray-800 dark:text-gray-100 mb-2 text-center md:text-left">{{ $feature['title'] }}</h3>
            <p class="text-xs md:text-sm text-gray-600 dark:text-gray-400 leading-relaxed text-center md:text-left">{{ $feature['description'] }}</p>
        </div>
        @endforeach
    </div>
</section>
