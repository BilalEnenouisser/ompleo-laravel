@extends('layouts.dashboard')

@section('title', 'Entreprises - OMPLEO')
@section('description', 'Gérez toutes les entreprises de la plateforme OMPLEO.')
@section('page-title', 'Entreprises')

@php
    use Illuminate\Support\Facades\Storage;
@endphp

@section('content')
<div class="w-full space-y-4 md:space-y-8">
    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="bg-green-900/30 border border-green-500 text-green-400 px-4 py-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif
    
    @if(session('error'))
        <div class="bg-red-900/30 border border-red-500 text-red-400 px-4 py-3 rounded-lg">
            {{ session('error') }}
        </div>
    @endif
    
    @if($errors->any())
        <div class="bg-red-900/30 border border-red-500 text-red-400 px-4 py-3 rounded-lg">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <!-- Header -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-3 md:gap-4">
        <div>
            <h1 class="text-xl md:text-2xl lg:text-3xl font-bold text-[#f5f5f5]">
                Gestion des Entreprises
            </h1>
            <p class="text-sm md:text-base text-[#9ca3af] mt-1 md:mt-2">
                Gérez toutes les entreprises de la plateforme
            </p>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-3 md:gap-4 lg:gap-6">
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-lg md:rounded-xl lg:rounded-2xl p-3 md:p-4 lg:p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs md:text-sm text-[#9ca3af]">Total entreprises</p>
                    <p class="text-lg md:text-xl lg:text-2xl font-bold text-[#f5f5f5]">{{ $stats['total_companies'] }}</p>
                </div>
                <div class="w-8 h-8 md:w-10 md:h-10 lg:w-12 lg:h-12 bg-[#333333] rounded-lg md:rounded-xl flex items-center justify-center">
                    <svg class="w-4 h-4 md:w-5 md:h-5 lg:w-6 lg:h-6 text-[#9ca3af]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"/>
                        <path d="M6 12H4a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2"/>
                        <path d="M18 9h2a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2h-2"/>
                        <path d="M10 6h4"/>
                        <path d="M10 10h4"/>
                        <path d="M10 14h4"/>
                        <path d="M10 18h4"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-[#2b2b2b] border border-[#333333] rounded-lg md:rounded-xl lg:rounded-2xl p-3 md:p-4 lg:p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs md:text-sm text-[#9ca3af]">Entreprises actives</p>
                    <p class="text-lg md:text-xl lg:text-2xl font-bold text-green-600">{{ $stats['active_companies'] }}</p>
                </div>
                <div class="w-8 h-8 md:w-10 md:h-10 lg:w-12 lg:h-12 bg-green-900/30 rounded-lg md:rounded-xl flex items-center justify-center">
                    <svg class="w-4 h-4 md:w-5 md:h-5 lg:w-6 lg:h-6 text-green-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                        <path d="m9 11 3 3L22 4"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-[#2b2b2b] border border-[#333333] rounded-lg md:rounded-xl lg:rounded-2xl p-3 md:p-4 lg:p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs md:text-sm text-[#9ca3af]">Entreprises inactives</p>
                    <p class="text-lg md:text-xl lg:text-2xl font-bold text-red-600">{{ $stats['inactive_companies'] }}</p>
                </div>
                <div class="w-8 h-8 md:w-10 md:h-10 lg:w-12 lg:h-12 bg-red-900/30 rounded-lg md:rounded-xl flex items-center justify-center">
                    <svg class="w-4 h-4 md:w-5 md:h-5 lg:w-6 lg:h-6 text-red-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"/>
                        <path d="m15 9-6 6"/>
                        <path d="m9 9 6 6"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-[#2b2b2b] border border-[#333333] rounded-lg md:rounded-xl lg:rounded-2xl p-3 md:p-4 lg:p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs md:text-sm text-[#9ca3af]">Offres d'emploi</p>
                    <p class="text-lg md:text-xl lg:text-2xl font-bold text-[#00b6b4]">{{ $companies->sum(function($company) { return $company->jobs->count(); }) }}</p>
                </div>
                <div class="w-8 h-8 md:w-10 md:h-10 lg:w-12 lg:h-12 bg-[#00b6b4]/20 rounded-lg md:rounded-xl flex items-center justify-center">
                    <svg class="w-4 h-4 md:w-5 md:h-5 lg:w-6 lg:h-6 text-[#00b6b4]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect width="20" height="14" x="2" y="7" rx="2" ry="2"/>
                        <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-[#2b2b2b] border border-[#333333] rounded-lg md:rounded-xl lg:rounded-2xl p-3 md:p-4 lg:p-6 shadow-lg">
        <form method="GET" action="{{ route('admin.companies') }}" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 md:gap-4">
            <div class="relative">
                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-[#9ca3af] w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"/>
                    <path d="m21 21-4.35-4.35"/>
                </svg>
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Rechercher par nom..."
                    class="w-full pl-9 sm:pl-10 pr-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] placeholder-[#9ca3af] text-sm sm:text-base"
                />
            </div>
            
            <div class="relative">
                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-[#9ca3af] w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polygon points="22,3 2,3 10,12.46 10,19 14,21 14,12.46 22,3"/>
                </svg>
                <select name="status" class="w-full pl-9 sm:pl-10 pr-8 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none appearance-none bg-[#333333] text-[#f5f5f5] text-sm sm:text-base">
                    <option value="">Tous les statuts</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Actif</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactif</option>
                </select>
            </div>
            
            <button type="submit" class="bg-[#00b6b4] hover:bg-[#009e9c] text-white px-3 sm:px-4 py-2 sm:py-3 flex items-center justify-center gap-2 rounded-lg transition-colors text-sm sm:text-base">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polygon points="22,3 2,3 10,12.46 10,19 14,21 14,12.46 22,3"/>
                </svg>
                <span class="hidden sm:inline">Rechercher</span>
                <span class="sm:hidden">Rechercher</span>
            </button>
            
            <a href="{{ route('admin.companies') }}" class="w-[5%] bg-[#2b2b2b] border border-[#444444] hover:bg-[#333333] text-[#9ca3af] hover:text-[#f5f5f5] px-0 py-2 sm:py-3 flex items-center justify-center rounded-lg transition-colors text-sm sm:text-base">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 6L6 18"/>
                    <path d="M6 6l12 12"/>
                </svg>
            </a>
        </form>
    </div>

    <!-- Companies Table -->
    <div class="bg-[#2b2b2b] border border-[#333333] rounded-lg md:rounded-xl lg:rounded-2xl shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[900px]">
                <thead class="bg-[#333333]">
                    <tr>
                        <th class="text-left py-4 px-6 font-semibold text-[#f5f5f5] text-base min-w-[200px]">Entreprise</th>
                        <th class="text-left py-4 px-6 font-semibold text-[#f5f5f5] text-base min-w-[250px]">Description</th>
                        <th class="text-left py-4 px-6 font-semibold text-[#f5f5f5] text-base min-w-[150px]">Recruteurs</th>
                        <th class="text-left py-4 px-6 font-semibold text-[#f5f5f5] text-base min-w-[120px]">Offres</th>
                        <th class="text-left py-4 px-6 font-semibold text-[#f5f5f5] text-base min-w-[130px]">Statut</th>
                        <th class="text-left py-4 px-6 font-semibold text-[#f5f5f5] text-base min-w-[140px]">Date création</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($companies as $company)
                    <tr class="border-b border-[#444444] hover:bg-[#333333]">
                        <td class="py-4 px-6 min-w-[200px]">
                            <div class="flex items-center gap-3">
                                <div class="relative flex-shrink-0">
                                    @if($company->logo)
                                        <img src="{{ Storage::url($company->logo) }}" alt="{{ $company->name }}" class="w-12 h-12 rounded-full object-cover border-2 border-[#00b6b4]">
                                    @else
                                    <div class="w-12 h-12 bg-gradient-to-br from-[#00b6b4] to-[#009e9c] rounded-full flex items-center justify-center text-white font-bold">
                                            {{ strtoupper(substr($company->name, 0, 2)) }}
                                    </div>
                                    @endif
                                </div>
                                <div class="min-w-0 flex-1">
                                    <div class="font-semibold text-[#f5f5f5] truncate">
                                        {{ $company->name }}
                                    </div>
                                    @if($company->location)
                                    <div class="text-sm text-[#9ca3af] flex items-center gap-1 truncate">
                                        <svg class="w-4 h-4 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/>
                                            <circle cx="12" cy="10" r="3"/>
                                        </svg>
                                        <span class="truncate">{{ $company->location }}</span>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6 min-w-[250px]">
                            <p class="text-sm text-[#9ca3af] line-clamp-2">
                                {{ $company->description ?? 'Aucune description' }}
                            </p>
                        </td>
                        <td class="py-4 px-6 min-w-[150px]">
                            <div class="flex items-center gap-2">
                                <span class="text-sm font-medium text-[#f5f5f5] whitespace-nowrap">
                                    {{ $company->recruiterProfiles->count() }}
                                </span>
                                <span class="text-xs text-[#9ca3af]">recruteur(s)</span>
                            </div>
                            @if($company->recruiterProfiles->count() > 0)
                            <div class="text-xs text-[#9ca3af] truncate mt-1">
                                @foreach($company->recruiterProfiles->take(2) as $profile)
                                    {{ $profile->user->name }}{{ !$loop->last ? ', ' : '' }}
                                @endforeach
                                @if($company->recruiterProfiles->count() > 2)
                                    +{{ $company->recruiterProfiles->count() - 2 }}
                                @endif
                            </div>
                            @endif
                        </td>
                        <td class="py-4 px-6 min-w-[120px]">
                            <span class="text-sm font-medium text-[#f5f5f5] whitespace-nowrap">
                                {{ $company->jobs->count() }}
                            </span>
                            <span class="text-xs text-[#9ca3af]">offre(s)</span>
                        </td>
                        <td class="py-4 px-6 min-w-[130px]">
                            @if($company->is_active)
                            <span class="px-2 py-1 rounded-full text-xs font-medium text-green-600 bg-green-100 whitespace-nowrap">
                                Actif
                            </span>
                            @else
                            <span class="px-2 py-1 rounded-full text-xs font-medium text-red-600 bg-red-100 whitespace-nowrap">
                                Inactif
                            </span>
                            @endif
                        </td>
                        <td class="py-4 px-6 min-w-[140px]">
                            <div class="flex items-center gap-1 text-sm text-[#9ca3af] whitespace-nowrap">
                                <svg class="w-4 h-4 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect width="18" height="18" x="3" y="4" rx="2" ry="2"/>
                                    <line x1="16" x2="16" y1="2" y2="6"/>
                                    <line x1="8" x2="8" y1="2" y2="6"/>
                                    <line x1="3" x2="21" y1="10" y2="10"/>
                                </svg>
                                <span class="truncate">{{ $company->created_at ? $company->created_at->setTimezone('Africa/Algiers')->format('d/m/Y') : 'N/A' }}</span>
                            </div>
                            <div class="text-xs text-[#999999] whitespace-nowrap mt-1">
                                {{ $company->created_at ? $company->created_at->setTimezone('Africa/Algiers')->diffForHumans() : 'N/A' }}
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-12 text-center">
                            <div class="flex flex-col items-center gap-3">
                                <svg class="w-16 h-16 text-[#9ca3af]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"/>
                                    <path d="M6 12H4a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2"/>
                                    <path d="M18 9h2a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2h-2"/>
                                    <path d="M10 6h4"/>
                                    <path d="M10 10h4"/>
                                    <path d="M10 14h4"/>
                                    <path d="M10 18h4"/>
                                </svg>
                                <p class="text-[#9ca3af] text-base">Aucune entreprise trouvée</p>
                                @if(request('search') || request('status'))
                                <a href="{{ route('admin.companies') }}" class="text-[#00b6b4] hover:text-[#009e9c] text-sm">
                                    Réinitialiser les filtres
                                </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($companies->hasPages())
        <div class="px-6 py-4 border-t border-[#444444]">
            {{ $companies->links() }}
        </div>
        @endif
    </div>
</div>
@endsection

