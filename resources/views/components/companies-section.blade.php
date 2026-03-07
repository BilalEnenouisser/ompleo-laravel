@php
use Illuminate\Support\Facades\Storage;
// Use the companies passed from the controller, or fallback to empty array
$companies = $companies ?? collect();
@endphp

<section class="relative py-20 bg-[#212221] overflow-hidden companies-section">
    <style>
        /* Desktop is default - py-20, grid-cols-3 */
        @media (max-width: 1023px) {
            .companies-section {
                padding-top: 4rem !important;
                padding-bottom: 4rem !important;
            }
            .companies-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
            }
        }
        @media (max-width: 767px) {
            .companies-section {
                padding-top: 3rem !important;
                padding-bottom: 3rem !important;
            }
            .companies-section h2 {
                font-size: 2.5rem !important;
            }
            .companies-grid {
                grid-template-columns: repeat(1, minmax(0, 1fr)) !important;
            }
        }
        
        /* Company card hover border effect */
        .company-card-wrapper {
            background: transparent !important;
            transition: background 0.3s ease;
        }
        .company-card-wrapper:hover {
            background: linear-gradient(135deg, #165c5b, #00fadc, #165c5b) !important;
        }
    </style>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <!-- Header -->
        <div class="text-center mb-12 pb-8">
            <div class="flex items-center justify-center gap-2 mb-4 pb-2">
                <img src="{{ asset('storage/home_page/job/icon2.svg') }}" alt="Icon" class="w-7 h-7">
                <span class="text-base" style="color: #d9d9d9;">Entreprises à la une</span>
            </div>
            <h2 class="text-5xl md:text-6xl font-bold text-white pb-4">
                Les meilleures entreprises
            </h2>
            <p class="text-lg text-white">
                Entreprises qui recrutent activement
            </p>
        </div>

        <!-- Companies Grid Rows (Grouped by 3) -->
        @if($companies->count() > 0)
        <div class="space-y-8 companies-grid-grouped">
            @foreach($companies->take(6)->chunk(3) as $chunk)
                <div class="bg-[#1e1e1f] rounded-[24px] p-4 md:p-8 animate-on-scroll">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 companies-grid">
                        @foreach($chunk as $company)
                            @php
                                $initials = '';
                                if ($company->name) {
                                    $nameParts = explode(' ', $company->name);
                                    $initials = strtoupper(substr($nameParts[0], 0, 1));
                                    if (count($nameParts) > 1) {
                                        $initials .= strtoupper(substr($nameParts[1], 0, 1));
                                    }
                                }
                            @endphp
                            
                            <div class="company-card-wrapper rounded-xl p-[1px] transition-all duration-300" style="border-radius: 12px;">
                                <div class="rounded-xl p-5 transition-all duration-300 flex flex-col h-full" style="background-color: #2b2b2b; border-radius: 11px;">
                                    {{-- Top Section: Logo on Left, Industry on Right --}}
                                    <div class="flex gap-4 mb-4 items-center">
                                        {{-- Company Logo on Left --}}
                                        <div class="flex-shrink-0">
                                            @if($company->logo)
                                                <img src="{{ Storage::url($company->logo) }}" alt="{{ $company->name }}" class="w-20 h-20 rounded-lg object-cover">
                                            @else
                                                <div class="w-20 h-20 bg-[#00b6b4]/20 rounded-lg flex items-center justify-center border border-[#00b6b4]/30">
                                                    <span class="text-[#00b6b4] font-bold text-2xl">{{ $initials ?: 'C' }}</span>
                                                </div>
                                            @endif
                                        </div>

                                        {{-- Industry/Specialisation on Right --}}
                                        <div class="flex-1 min-w-0 flex justify-end">
                                            @if($company->industry || $company->specialisation)
                                            <div class="flex flex-wrap gap-1.5 justify-end">
                                                @if($company->industry)
                                                    <span class="px-2.5 py-1 bg-[#322D23] text-[#71695B] rounded-full border border-[#5E5440] text-xs font-medium">{{ $company->industry }}</span>
                                                @endif
                                                @if($company->specialisation)
                                                    <span class="px-2.5 py-1 bg-[#322D23] text-[#71695B] rounded-full border border-[#5E5440] text-xs font-medium">{{ $company->specialisation }}</span>
                                                @endif
                                            </div>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- Bottom Section: Name, Description, Details --}}
                                    <div class="mb-4 flex-1">
                                        {{-- Company Name --}}
                                        <h3 class="text-lg font-bold text-white mb-1.5">{{ $company->name }}</h3>

                                        {{-- Description --}}
                                        @if($company->description)
                                        <p class="text-sm text-[#86878C] mb-3 line-clamp-2 leading-relaxed">{{ $company->description }}</p>
                                        @endif

                                        {{-- Location --}}
                                        @if($company->location)
                                        <div class="flex items-center gap-2 text-sm text-[#86878C] mb-1.5">
                                            <svg class="w-[19px] h-[19px] text-[#646464] flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                                            <span>{{ $company->location }}</span>
                                        </div>
                                        @endif

                                        {{-- Company Size --}}
                                        @if($company->size)
                                        <div class="flex items-center gap-2 text-sm text-[#86878C] mb-1.5">
                                            <svg class="w-[19px] h-[19px] text-[#646464] flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M22 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                            <span>{{ $company->size }}</span>
                                        </div>
                                        @endif

                                        {{-- Job Count --}}
                                        <div class="flex items-center gap-2 text-sm text-[#646464]">
                                            <svg class="w-[19px] h-[19px] text-[#646464] flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="14" x="2" y="7" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
                                            <span>{{ $company->jobs_count }} postes</span>
                                        </div>
                                    </div>

                                    {{-- Button at Bottom --}}
                                    <a href="{{ route('company.detail', $company->slug ?? $company->id) }}" class="ompleo-btn w-full bg-[#646464] text-white" style="font-size: 16px !important; font-weight: 400 !important;">
                                        Voir les offres
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-12">
            <div class="w-16 h-16 mx-auto mb-4 text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"></path>
                    <path d="M6 12H4a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2"></path>
                    <path d="M18 9h2a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2h-2"></path>
                    <path d="M10 6h4"></path>
                    <path d="M10 10h4"></path>
                    <path d="M10 14h4"></path>
                    <path d="M10 18h4"></path>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-white mb-2">Aucune entreprise disponible</h3>
            <p class="text-gray-400">Revenez bientôt pour découvrir de nouvelles entreprises !</p>
        </div>
        @endif

        <!-- Bottom Button -->
        <div class="text-center mt-12">
            <a href="{{ route('companies.index') }}" class="btn-premium-green mx-auto">
                <img src="{{ asset('storage/home_page/botton1.svg') }}" alt="Icon">
                <span>Toutes les entreprises</span>
            </a>
        </div>
    </div>
</section>
