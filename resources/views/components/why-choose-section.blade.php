@php
$features = [
    [
        'icon' => 'target',
        'title' => 'Plateforme intelligente',
        'description' => 'Trouvez l\'essentiel, postulez en un clic.',
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
        <div class="absolute -top-20 -left-20 w-80 h-80 bg-[#00b6b4]/30 dark:bg-[#00b6b4]/20 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute top-40 right-10 w-96 h-96 bg-[#00b6b4] opacity-20 dark:opacity-10 rounded-full blur-[100px] animate-ping-slow"></div>
    </div>

    <!-- Title -->
    <h2 class="relative z-10 text-4xl md:text-5xl font-bold text-center mb-20 text-gray-900 dark:text-gray-100">
        Pourquoi choisir <span class="text-[#00b6b4] dark:text-[#00b6b4]">Ompleo</span> ?
    </h2>

    <!-- Feature Cards -->
    <div class="relative z-10 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
        @foreach($features as $index => $feature)
        <div class="relative bg-white/80 dark:bg-[#2b2b2b]/80 border border-white/30 dark:border-[#333333]/50 shadow-xl backdrop-blur-md rounded-[2rem_0.5rem_2rem_0.5rem] p-8 transition-transform hover:scale-105 hover:rotate-[-1deg]">
            <div class="flex items-center justify-center w-14 h-14 mb-6 rounded-xl bg-[#00b6b4]/10 dark:bg-[#00b6b4]/20 text-[#00b6b4]">
                @if($feature['icon'] === 'target')
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                @elseif($feature['icon'] === 'shield')
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                @elseif($feature['icon'] === 'briefcase')
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V8a2 2 0 012-2V6"></path>
                    </svg>
                @elseif($feature['icon'] === 'clock')
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                @endif
            </div>
            <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100 mb-2">{{ $feature['title'] }}</h3>
            <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">{{ $feature['description'] }}</p>
        </div>
        @endforeach
    </div>
</section>
