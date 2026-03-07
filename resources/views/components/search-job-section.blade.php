@php
use Illuminate\Support\Facades\Storage;
// Use the latestJobs passed from the controller, or fallback to empty collection
$latestJobs = $latestJobs ?? collect();
@endphp

<section class="relative py-20 bg-[#212221] overflow-hidden">
    <!-- Background Images -->
    <div class="absolute top-0 left-0 hidden lg:block pointer-events-none z-0">
        <img src="{{ asset('storage/home_page/search_job/left.png') }}" alt="Background" class="h-auto w-auto object-cover" style="object-position: left top;">
    </div>
    <div class="absolute bottom-0 right-0 hidden lg:block pointer-events-none z-0">
        <img src="{{ asset('storage/home_page/search_job/right.png') }}" alt="Background" class="h-auto w-auto object-cover" style="object-position: right bottom;">
    </div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- Left Section: Image with Border -->
            <div class="relative">
                <!-- Border Images -->
                <div class="absolute inset-0 pointer-events-none z-10">
                    <!-- Top Border -->
                    <div class="absolute top-0 left-0 right-0" style="height: 16px; background-image: url('{{ asset('storage/home_page/search_job/brdtopbtm.png') }}'); background-repeat: no-repeat; background-size: auto 16px; background-position: center top;"></div>
                    <!-- Bottom Border -->
                    <div class="absolute bottom-0 left-0 right-0" style="height: 16px; background-image: url('{{ asset('storage/home_page/search_job/brdtopbtm.png') }}'); background-repeat: no-repeat; background-size: auto 16px; background-position: center bottom;"></div>
                    <!-- Left Border -->
                    <div class="absolute top-0 bottom-0 left-0" style="width: 16px; background-image: url('{{ asset('storage/home_page/search_job/border.png') }}'); background-repeat: no-repeat; background-size: contain; background-position: left center;"></div>
                    <!-- Right Border -->
                    <div class="absolute top-0 bottom-0 right-0" style="width: 16px; background-image: url('{{ asset('storage/home_page/search_job/border.png') }}'); background-repeat: no-repeat; background-size: contain; background-position: right center;"></div>
                </div>
                <!-- Main Image -->
                <div class="relative" style="padding: 10px;">
                    <img src="{{ asset('storage/home_page/search_job/image_left.png') }}" alt="Job Search" class="w-full h-auto rounded-lg">
                </div>
            </div>

            <!-- Right Section: Content -->
            <div class="text-center lg:text-left">
                <!-- Title -->
                <h2 class="text-3xl md:text-5xl font-bold text-white mb-4">
                    Trouvez votre prochain poste
                </h2>
                
                <!-- Subtitle -->
                <p class="text-lg text-white mb-8">
                    Découvrez les dernières offres d'emploi sur OMPLEO
                </p>
                <!-- Search Input -->
                <div class="mb-8">
                    <form action="{{ route('jobs.index') }}" method="GET" class="relative">
                        <div class="p-[1px]" style="background: linear-gradient(135deg, #165c5b, #00fadc, #165c5b); border-radius: 10px;">
                            <div class="relative" style="border-radius: 10px;">
                                <input 
                                    type="text" 
                                    name="search"
                                    placeholder="Rechercher toutes les offres" 
                                    class="w-full px-6 py-4 pr-14 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#00fadc]/50 transition-all"
                                    style="background-color: #212221; border-radius: 10px; box-shadow: 0 20px 22px rgba(0, 0, 0, 0.4);"
                                >
                                <button 
                                    type="submit"
                                    class="absolute right-4 top-1/2 transform -translate-y-1/2 text-white hover:text-[#00fadc] transition-colors"
                                >
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <circle cx="11" cy="11" r="8"></circle>
                                        <path d="m21 21-4.35-4.35"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Latest Offers -->
                <div class="mb-8">
                    <p class="text-white mb-4 font-bold text-base">Dernières offres publiées :</p>
                    <div class="flex flex-wrap gap-3 items-center justify-center lg:justify-start">
                        @forelse($latestJobs as $job)
                            <a href="{{ route('jobs.show', $job->slug) }}" class="text-white hover:text-[#00fadc] transition-colors text-base">
                                {{ $job->title }}
                            </a>
                        @empty
                            <p class="text-gray-400 text-sm">Aucune offre disponible</p>
                        @endforelse
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 items-center lg:items-start search-job-buttons justify-center lg:justify-start">
                    <a href="{{ route('jobs.index') }}" class="btn-premium-green mx-auto lg:mx-0">
                        <img src="{{ asset('storage/home_page/search_job/icon2.svg') }}" alt="Icon">
                        <span>Parcourir toutes les offres</span>
                    </a>

                    <div class="rounded-full overflow-hidden">
                        <a href="#" class="btn-premium-dark mx-auto lg:mx-0">
                            <img src="{{ asset('storage/home_page/search_job/icon.svg') }}" alt="Icon">
                            <span>Recevoir les offres par email</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
