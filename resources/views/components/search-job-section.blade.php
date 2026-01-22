@php
use Illuminate\Support\Facades\Storage;
// Use the latestJobs passed from the controller, or fallback to empty collection
$latestJobs = $latestJobs ?? collect();
@endphp

<section class="relative py-20 bg-[#1f1f1f] overflow-hidden">
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
            <div class="text-left">
                <!-- Title -->
                <h2 class="text-4xl md:text-5xl font-bold text-white mb-4">
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
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
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
                    <div class="flex flex-wrap gap-3 items-center">
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
                <div class="flex flex-row gap-4 search-job-buttons">
                    <style>
                        /* Desktop is default - buttons on same line */
                        /* Mobile - keep on same line, adjust size if needed */
                        @media (max-width: 767px) {
                            .search-job-buttons {
                                flex-wrap: nowrap !important;
                                gap: 0.25rem !important;
                                width: 100% !important;
                                max-width: 100% !important;
                            }
                            .search-job-buttons a,
                            .search-job-buttons > div {
                                flex: 1 1 0 !important;
                                min-width: 0 !important;
                                overflow: hidden !important;
                                max-width: calc(50% - 0.125rem) !important;
                            }
                            .search-job-buttons a {
                                padding-left: 0.5rem !important;
                                padding-right: 0.5rem !important;
                                padding-top: 0.5rem !important;
                                padding-bottom: 0.5rem !important;
                                display: flex !important;
                                align-items: center !important;
                                justify-content: center !important;
                                text-align: center !important;
                                overflow: hidden !important;
                                width: 100% !important;
                                max-width: 100% !important;
                                box-sizing: border-box !important;
                            }
                            .search-job-buttons a span,
                            .search-job-buttons > div a span {
                                font-size: 0.6rem !important;
                                line-height: 1.2 !important;
                                white-space: nowrap !important;
                                overflow: hidden !important;
                                text-overflow: ellipsis !important;
                                display: inline-block !important;
                                max-width: 100% !important;
                                flex-shrink: 1 !important;
                            }
                            .search-job-buttons img {
                                width: 0.875rem !important;
                                height: 0.875rem !important;
                                flex-shrink: 0 !important;
                                margin-right: 0.25rem !important;
                            }
                            .search-job-buttons > div {
                                overflow: hidden !important;
                                width: 100% !important;
                                max-width: 100% !important;
                                box-sizing: border-box !important;
                            }
                            .search-job-buttons > div a {
                                width: 100% !important;
                                max-width: 100% !important;
                            }
                        }
                    </style>
                    <!-- Button 1: Parcourir toutes les offres -->
                    <a href="{{ route('jobs.index') }}" class="flex items-center gap-3 px-6 py-3 rounded-full text-white font-bold transition-all duration-300 hover:scale-105" style="background: linear-gradient(135deg, #1aa2a0, #39fffc); border: 1px solid #47fffd; text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);">
                        <img src="{{ asset('storage/home_page/search_job/icon2.svg') }}" alt="Icon" class="w-5 h-5">
                        <span>Parcourir toutes les offres</span>
                    </a>

                    <!-- Button 2: Recevoir les offres par email -->
                    <div class="rounded-full p-[1px]" style="background: linear-gradient(135deg, #39fffc, #1aa2a0);">
                        <a href="#" class="flex items-center gap-3 px-6 py-3 rounded-full text-white font-bold transition-all duration-300 hover:scale-105" style="background: linear-gradient(135deg, #136b6a, #004948); text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);">
                            <img src="{{ asset('storage/home_page/search_job/icon.svg') }}" alt="Icon" class="w-5 h-5">
                            <span>Recevoir les offres par email</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
