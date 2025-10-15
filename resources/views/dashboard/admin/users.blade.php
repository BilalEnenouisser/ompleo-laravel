@extends('layouts.dashboard')

@section('title', 'Utilisateurs - OMPLEO')
@section('description', 'Gérez tous les utilisateurs de la plateforme OMPLEO.')
@section('page-title', 'Utilisateurs')

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
                Gestion des Utilisateurs
            </h1>
            <p class="text-sm md:text-base text-[#9ca3af] mt-1 md:mt-2">
                Gérez tous les utilisateurs de la plateforme
            </p>
        </div>
        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2 sm:gap-3">
            <button onclick="exportUsersCSV()" class="bg-[#2b2b2b] border border-[#333333] text-[#9ca3af] hover:text-[#00b6b4] px-3 sm:px-4 py-2 flex items-center justify-center gap-2 rounded-lg transition-colors text-sm sm:text-base">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                    <path d="M7 10l5 5 5-5"/>
                    <path d="M12 15V3"/>
                </svg>
                <span class="hidden sm:inline">Exporter</span>
                <span class="sm:hidden">Export</span>
            </button>
            <button id="addUserBtn" class="bg-[#00b6b4] hover:bg-[#009e9c] text-white px-3 sm:px-4 py-2 flex items-center justify-center gap-2 rounded-lg transition-colors text-sm sm:text-base">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 12h14"/>
                    <path d="M12 5v14"/>
                </svg>
                <span class="hidden sm:inline">Ajouter utilisateur</span>
                <span class="sm:hidden">Ajouter</span>
            </button>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-3 md:gap-4 lg:gap-6">
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-lg md:rounded-xl lg:rounded-2xl p-3 md:p-4 lg:p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs md:text-sm text-[#9ca3af]">Total utilisateurs</p>
                    <p class="text-lg md:text-xl lg:text-2xl font-bold text-[#f5f5f5]">{{ $stats['total_users'] }}</p>
                </div>
                <div class="w-8 h-8 md:w-10 md:h-10 lg:w-12 lg:h-12 bg-[#333333] rounded-lg md:rounded-xl flex items-center justify-center">
                    <svg class="w-4 h-4 md:w-5 md:h-5 lg:w-6 lg:h-6 text-[#9ca3af]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-[#2b2b2b] border border-[#333333] rounded-lg md:rounded-xl lg:rounded-2xl p-3 md:p-4 lg:p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs md:text-sm text-[#9ca3af]">Candidats</p>
                    <p class="text-lg md:text-xl lg:text-2xl font-bold text-blue-600">{{ $stats['candidates'] }}</p>
                </div>
                <div class="w-8 h-8 md:w-10 md:h-10 lg:w-12 lg:h-12 bg-blue-900/30 rounded-lg md:rounded-xl flex items-center justify-center">
                    <svg class="w-4 h-4 md:w-5 md:h-5 lg:w-6 lg:h-6 text-blue-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-[#2b2b2b] border border-[#333333] rounded-lg md:rounded-xl lg:rounded-2xl p-3 md:p-4 lg:p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs md:text-sm text-[#9ca3af]">Recruteurs</p>
                    <p class="text-lg md:text-xl lg:text-2xl font-bold text-green-600">{{ $stats['recruiters'] }}</p>
                </div>
                <div class="w-8 h-8 md:w-10 md:h-10 lg:w-12 lg:h-12 bg-green-900/30 rounded-lg md:rounded-xl flex items-center justify-center">
                    <svg class="w-4 h-4 md:w-5 md:h-5 lg:w-6 lg:h-6 text-green-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-[#2b2b2b] border border-[#333333] rounded-lg md:rounded-xl lg:rounded-2xl p-3 md:p-4 lg:p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs md:text-sm text-[#9ca3af]">Certifiés</p>
                    <p class="text-lg md:text-xl lg:text-2xl font-bold text-yellow-600">{{ $stats['certified'] }}</p>
                </div>
                <div class="w-8 h-8 md:w-10 md:h-10 lg:w-12 lg:h-12 bg-yellow-900/30 rounded-lg md:rounded-xl flex items-center justify-center">
                    <svg class="w-4 h-4 md:w-5 md:h-5 lg:w-6 lg:h-6 text-yellow-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                        <path d="M9 12l2 2 4-4"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-[#2b2b2b] border border-[#333333] rounded-lg md:rounded-xl lg:rounded-2xl p-3 md:p-4 lg:p-6 shadow-lg">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 md:gap-4">
            <div class="relative">
                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-[#9ca3af] w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"/>
                    <path d="m21 21-4.35-4.35"/>
                </svg>
                <input
                    type="text"
                    id="userSearch"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Rechercher..."
                    class="w-full pl-9 sm:pl-10 pr-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] placeholder-[#9ca3af] text-sm sm:text-base"
                />
            </div>
            
            <div class="relative">
                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-[#9ca3af] w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polygon points="22,3 2,3 10,12.46 10,19 14,21 14,12.46 22,3"/>
                </svg>
                <select id="userTypeFilter" name="user_type" class="w-full pl-9 sm:pl-10 pr-8 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none appearance-none bg-[#333333] text-[#f5f5f5] text-sm sm:text-base">
                    <option value="">Tous les rôles</option>
                    <option value="candidate" {{ request('user_type') == 'candidate' ? 'selected' : '' }}>Candidat</option>
                    <option value="recruiter" {{ request('user_type') == 'recruiter' ? 'selected' : '' }}>Recruteur</option>
                    <option value="admin" {{ request('user_type') == 'admin' ? 'selected' : '' }}>Administrateur</option>
                </select>
            </div>
            
            <div class="relative">
                <select id="userStatusFilter" name="status" class="w-full px-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none appearance-none bg-[#333333] text-[#f5f5f5] text-sm sm:text-base">
                    <option value="">Tous les statuts</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Actif</option>
                    <option value="suspended" {{ request('status') == 'suspended' ? 'selected' : '' }}>Suspendu</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>En attente</option>
                </select>
            </div>
            
            <button class="bg-[#00b6b4] hover:bg-[#009e9c] text-white px-3 sm:px-4 py-2 sm:py-3 flex items-center justify-center gap-2 rounded-lg transition-colors text-sm sm:text-base">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polygon points="22,3 2,3 10,12.46 10,19 14,21 14,12.46 22,3"/>
                </svg>
                <span class="hidden sm:inline">Filtres avancés</span>
                <span class="sm:hidden">Filtres</span>
            </button>
        </div>
    </div>

    <!-- Users Table -->
    <div class="bg-[#2b2b2b] border border-[#333333] rounded-lg md:rounded-xl lg:rounded-2xl shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-[#333333]">
                    <tr>
                        <th class="text-left py-4 px-6 font-semibold text-[#f5f5f5] text-base">Utilisateur</th>
                        <th class="text-left py-4 px-6 font-semibold text-[#f5f5f5] text-base">Contact</th>
                        <th class="text-left py-4 px-6 font-semibold text-[#f5f5f5] text-base">Rôle</th>
                        <th class="text-left py-4 px-6 font-semibold text-[#f5f5f5] text-base">Statut</th>
                        <th class="text-left py-4 px-6 font-semibold text-[#f5f5f5] text-base">Inscription</th>
                        <th class="text-left py-4 px-6 font-semibold text-[#f5f5f5] text-base">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr class="border-b border-[#444444] hover:bg-[#333333]">
                        <td class="py-4 px-6 min-w-[340px] sm:min-w-0" data-user-name="{{ $user->name }}" data-user-city="{{ $user->candidateProfile?->city ?? $user->recruiterProfile?->city ?? 'Alger' }}">
                            <div class="flex items-center gap-3">
                                <div class="relative">
                                    @php
                                        $avatar = $user->candidateProfile?->avatar ?? $user->recruiterProfile?->avatar ?? null;
                                    @endphp
                                    @if($avatar)
                                        <img src="{{ Storage::url($avatar) }}" alt="{{ $user->name }}" class="w-12 h-12 rounded-full object-cover border-2 border-[#00b6b4]">
                                    @else
                                    <div class="w-12 h-12 bg-gradient-to-br from-[#00b6b4] to-[#009e9c] rounded-full flex items-center justify-center text-white font-bold">
                                            {{ strtoupper(substr($user->name, 0, 2)) }}
                                    </div>
                                    @endif
                                </div>
                                <div>
                                    <div class="font-semibold text-[#f5f5f5]">
                                        {{ $user->name }}
                                    </div>
                                    <div class="text-sm text-[#9ca3af] flex items-center gap-1">
                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/>
                                            <circle cx="12" cy="10" r="3"/>
                                        </svg>
                                        {{ $user->candidateProfile?->city ?? $user->recruiterProfile?->city ?? 'Alger' }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6" data-user-email="{{ $user->email }}" data-user-phone="{{ $user->candidateProfile?->phone ?? $user->recruiterProfile?->phone ?? '+213 555 000 000' }}">
                            <div class="space-y-1">
                                <div class="flex items-center gap-2 text-sm text-[#9ca3af]">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                        <polyline points="22,6 12,13 2,6"/>
                                    </svg>
                                    {{ $user->email }}
                                </div>
                                <div class="flex items-center gap-2 text-sm text-[#9ca3af]">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                                    </svg>
                                    {{ $user->candidateProfile?->phone ?? $user->recruiterProfile?->phone ?? '+213 555 000 000' }}
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6" data-user-type="{{ $user->user_type }}" data-user-company="{{ $user->recruiterProfile?->company?->name ?? 'OMPLEO' }}">
                            <div class="space-y-1">
                                @if($user->user_type == 'candidate')
                                <span class="px-2 py-1 rounded-full text-xs font-medium text-blue-600 bg-blue-100">
                                    Candidat
                                </span>
                                @elseif($user->user_type == 'recruiter')
                                <span class="px-2 py-1 rounded-full text-xs font-medium text-green-600 bg-green-100">
                                    Recruteur
                                </span>
                                    @if($user->recruiterProfile?->company)
                                        <div class="text-xs text-[#999999]">{{ $user->recruiterProfile->company->name }}</div>
                                    @endif
                                @else
                                    <span class="px-2 py-1 rounded-full text-xs font-medium text-purple-600 bg-purple-100">
                                        Administrateur
                            </span>
                                    <div class="text-xs text-[#999999]">OMPLEO</div>
                                @endif
                            </div>
                        </td>
                        <td class="py-4 px-6" data-user-status="{{ $user->candidateProfile?->status ?? $user->recruiterProfile?->status ?? 'active' }}">
                            @php
                                $userStatus = $user->candidateProfile?->status ?? $user->recruiterProfile?->status ?? 'active';
                                $statusConfig = [
                                    'active' => ['text' => 'Actif', 'class' => 'text-green-600 bg-green-100'],
                                    'suspended' => ['text' => 'Suspendu', 'class' => 'text-red-600 bg-red-100'],
                                    'pending' => ['text' => 'En attente', 'class' => 'text-yellow-600 bg-yellow-100']
                                ];
                                $status = $statusConfig[$userStatus] ?? $statusConfig['active'];
                            @endphp
                            <span class="px-2 py-1 rounded-full text-xs font-medium {{ $status['class'] }}">
                                {{ $status['text'] }}
                            </span>
                        </td>
                        <td class="py-4 px-6" data-user-registration="{{ $user->created_at ? $user->created_at->setTimezone('Africa/Algiers')->format('d/m/Y') : 'N/A' }}" data-user-last-activity="{{ $user->updated_at ? $user->updated_at->setTimezone('Africa/Algiers')->format('d/m/Y H:i') : 'N/A' }}">
                            <div class="space-y-1">
                                <div class="flex items-center gap-1 text-sm text-[#9ca3af]">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect width="18" height="18" x="3" y="4" rx="2" ry="2"/>
                                        <line x1="16" x2="16" y1="2" y2="6"/>
                                        <line x1="8" x2="8" y1="2" y2="6"/>
                                        <line x1="3" x2="21" y1="10" y2="10"/>
                                    </svg>
                                    {{ $user->created_at ? $user->created_at->setTimezone('Africa/Algiers')->format('d/m/Y') : 'N/A' }}
                                </div>
                                <div class="text-xs text-[#999999]">
                                    {{ $user->created_at ? $user->created_at->setTimezone('Africa/Algiers')->diffForHumans() : 'N/A' }}
                                </div>
                                <div class="text-xs text-[#999999]">
                                    Dernière activité: {{ $user->updated_at ? $user->updated_at->setTimezone('Africa/Algiers')->format('d/m/Y H:i') : 'N/A' }}
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-2">
                                <button onclick="viewUser({{ $user->id }})" class="p-2 text-[#9ca3af] hover:text-[#00b6b4] transition-colors duration-200" title="Voir les détails">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                        <circle cx="12" cy="12" r="3"/>
                                    </svg>
                                </button>
                                <button onclick="editUser({{ $user->id }})" class="p-2 text-[#9ca3af] hover:text-blue-600 transition-colors duration-200" title="Modifier">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                        <path d="M18.5 2.5a2.12 2.12 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                    </svg>
                                </button>
                                <button onclick="deleteUser({{ $user->id }}, '{{ $user->name }}')" class="p-2 text-[#9ca3af] hover:text-red-600 transition-colors duration-200" title="Supprimer">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M3 6h18"/>
                                        <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
                                        <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                                    </svg>
                                </button>
                                <button class="p-2 text-[#9ca3af] hover:text-[#9ca3af] transition-colors duration-200">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="1"/>
                                        <circle cx="19" cy="12" r="1"/>
                                        <circle cx="5" cy="12" r="1"/>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-8 text-center text-[#9ca3af]">
                            Aucun utilisateur trouvé
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
                                    </div>
                                </div>

    <!-- Pagination -->
    <div class="flex flex-col sm:flex-row items-center justify-between gap-3 sm:gap-0">
        <p class="text-xs md:text-sm lg:text-base text-[#9ca3af]">
            Affichage de {{ $users->count() }} utilisateur(s) sur {{ $users->total() }}
        </p>
        <div class="flex items-center gap-2">
            @if($users->previousPageUrl())
                <a href="{{ $users->appends(request()->query())->previousPageUrl() }}" class="bg-[#2b2b2b] border border-[#333333] text-[#9ca3af] hover:text-[#00b6b4] px-3 md:px-4 py-2 rounded-lg transition-colors text-xs md:text-sm lg:text-base flex items-center gap-1">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="15,18 9,12 15,6"/>
                                    </svg>
                    Précédent
                </a>
            @else
                <span class="bg-[#2b2b2b] border border-[#333333] text-[#666666] px-3 md:px-4 py-2 rounded-lg text-xs md:text-sm lg:text-base cursor-not-allowed flex items-center gap-1">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="15,18 9,12 15,6"/>
                                    </svg>
                    Précédent
                                </span>
            @endif
            
            <!-- Page Numbers -->
            <div class="flex items-center gap-1">
                @php
                    $currentPage = $users->currentPage();
                    $lastPage = $users->lastPage();
                    $startPage = max(1, $currentPage - 2);
                    $endPage = min($lastPage, $currentPage + 2);
                @endphp
                
                @if($startPage > 1)
                    <a href="{{ $users->appends(request()->query())->url(1) }}" class="bg-[#2b2b2b] border border-[#333333] text-[#9ca3af] hover:text-[#00b6b4] px-2 py-1 rounded text-xs">1</a>
                    @if($startPage > 2)
                        <span class="text-[#666666] px-1">...</span>
                    @endif
                @endif
                
                @for($i = $startPage; $i <= $endPage; $i++)
                    @if($i == $currentPage)
                        <span class="bg-[#00b6b4] text-white px-2 py-1 rounded text-xs font-medium">{{ $i }}</span>
                    @else
                        <a href="{{ $users->appends(request()->query())->url($i) }}" class="bg-[#2b2b2b] border border-[#333333] text-[#9ca3af] hover:text-[#00b6b4] px-2 py-1 rounded text-xs">{{ $i }}</a>
                    @endif
                @endfor
                
                @if($endPage < $lastPage)
                    @if($endPage < $lastPage - 1)
                        <span class="text-[#666666] px-1">...</span>
                    @endif
                    <a href="{{ $users->appends(request()->query())->url($lastPage) }}" class="bg-[#2b2b2b] border border-[#333333] text-[#9ca3af] hover:text-[#00b6b4] px-2 py-1 rounded text-xs">{{ $lastPage }}</a>
                @endif
                            </div>
            
            @if($users->nextPageUrl())
                <a href="{{ $users->appends(request()->query())->nextPageUrl() }}" class="bg-[#2b2b2b] border border-[#333333] text-[#9ca3af] hover:text-[#00b6b4] px-3 md:px-4 py-2 rounded-lg transition-colors text-xs md:text-sm lg:text-base flex items-center gap-1">
                    Suivant
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="9,18 15,12 9,6"/>
                                    </svg>
                </a>
            @else
                <span class="bg-[#2b2b2b] border border-[#333333] text-[#666666] px-3 md:px-4 py-2 rounded-lg text-xs md:text-sm lg:text-base cursor-not-allowed flex items-center gap-1">
                    Suivant
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="9,18 15,12 9,6"/>
                    </svg>
                </span>
            @endif
                                </div>
                                </div>

    <!-- Add User Modal -->
    <div id="addUserModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-xl md:rounded-2xl p-6 max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl md:text-2xl font-bold text-[#f5f5f5]">Ajouter un utilisateur</h2>
                <button id="closeAddUserModal" class="text-[#cccccc] hover:text-[#f5f5f5] text-2xl">&times;</button>
                            </div>
            
            <form id="addUserForm" method="POST" action="{{ route('admin.users.store') }}" class="space-y-4">
                @csrf
                
                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-[#f5f5f5] mb-2">Nom complet *</label>
                    <input type="text" id="name" name="name" required
                           class="w-full px-4 py-3 bg-[#333333] border border-[#444444] rounded-lg text-[#f5f5f5] placeholder-[#9ca3af] focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none"
                           placeholder="Entrez le nom complet">
                            </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-[#f5f5f5] mb-2">Email *</label>
                    <input type="email" id="email" name="email" required
                           class="w-full px-4 py-3 bg-[#333333] border border-[#444444] rounded-lg text-[#f5f5f5] placeholder-[#9ca3af] focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none"
                           placeholder="exemple@email.com">
                                    </div>

                <!-- Phone -->
                <div>
                    <label for="phone" class="block text-sm font-medium text-[#f5f5f5] mb-2">Téléphone *</label>
                    <input type="tel" id="phone" name="phone" required
                           class="w-full px-4 py-3 bg-[#333333] border border-[#444444] rounded-lg text-[#f5f5f5] placeholder-[#9ca3af] focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none"
                           placeholder="+213 555 123 456">
                                </div>

                <!-- City -->
                                <div>
                    <label for="city" class="block text-sm font-medium text-[#f5f5f5] mb-2">Ville *</label>
                    <input type="text" id="city" name="city" required
                           class="w-full px-4 py-3 bg-[#333333] border border-[#444444] rounded-lg text-[#f5f5f5] placeholder-[#9ca3af] focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none"
                           placeholder="Alger, Oran, Constantine...">
                                    </div>

                <!-- Role -->
                <div>
                    <label for="user_type" class="block text-sm font-medium text-[#f5f5f5] mb-2">Rôle *</label>
                    <select id="user_type" name="user_type" required
                            class="w-full px-4 py-3 bg-[#333333] border border-[#444444] rounded-lg text-[#f5f5f5] focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none">
                        <option value="">Sélectionnez un rôle</option>
                        <option value="candidate">Candidat</option>
                        <option value="recruiter">Recruteur</option>
                        <option value="admin">Administrateur</option>
                    </select>
                                    </div>

                <!-- Company (shown only for recruiters) -->
                <div id="companyField" class="hidden">
                    <label for="company_name" class="block text-sm font-medium text-[#f5f5f5] mb-2">Nom de l'entreprise *</label>
                    <input type="text" id="company_name" name="company_name"
                           class="w-full px-4 py-3 bg-[#333333] border border-[#444444] rounded-lg text-[#f5f5f5] placeholder-[#9ca3af] focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none"
                           placeholder="Nom de l'entreprise">
                                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="block text-sm font-medium text-[#f5f5f5] mb-2">Statut *</label>
                    <select id="status" name="status" required
                            class="w-full px-4 py-3 bg-[#333333] border border-[#444444] rounded-lg text-[#f5f5f5] focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none">
                        <option value="">Sélectionnez un statut</option>
                        <option value="active">Actif</option>
                        <option value="suspended">Suspendu</option>
                        <option value="pending">En attente</option>
                    </select>
                            </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-[#f5f5f5] mb-2">Mot de passe *</label>
                    <input type="password" id="password" name="password" required
                           class="w-full px-4 py-3 bg-[#333333] border border-[#444444] rounded-lg text-[#f5f5f5] placeholder-[#9ca3af] focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none"
                           placeholder="Mot de passe">
                                </div>

                <!-- Form Actions -->
                <div class="flex items-center justify-end gap-3 pt-4">
                    <button type="button" id="cancelAddUser" class="px-4 py-2 bg-[#666666] hover:bg-[#777777] text-white rounded-lg transition-colors">
                        Annuler
                                </button>
                    <button type="submit" class="px-4 py-2 bg-[#00b6b4] hover:bg-[#009e9c] text-white rounded-lg transition-colors">
                        Ajouter l'utilisateur
                                </button>
                                </div>
            </form>
                            </div>
                            </div>
                                    </div>

<!-- View User Modal -->
<div id="viewUserModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
    <div class="bg-[#1a1a1a] rounded-lg shadow-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
        <div class="flex items-center justify-between p-6 border-b border-[#333]">
            <h3 class="text-xl font-semibold text-[#f5f5f5]">Détails de l'utilisateur</h3>
            <button onclick="closeViewModal()" class="text-[#9ca3af] hover:text-[#f5f5f5] transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
            </button>
                                </div>
        <div class="p-6" id="viewUserContent">
            <!-- Content will be loaded here -->
                                </div>
                            </div>
                                </div>

<!-- Edit User Modal -->
<div id="editUserModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
    <div class="bg-[#1a1a1a] rounded-lg shadow-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
        <div class="flex items-center justify-between p-6 border-b border-[#333]">
            <h3 class="text-xl font-semibold text-[#f5f5f5]">Modifier l'utilisateur</h3>
            <button onclick="closeEditModal()" class="text-[#9ca3af] hover:text-[#f5f5f5] transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
        <form id="editUserForm" class="p-6">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-[#f5f5f5] mb-2">Nom complet</label>
                    <input type="text" name="name" id="edit_name" class="w-full px-3 py-2 bg-[#2a2a2a] border border-[#444] rounded-lg text-[#f5f5f5] focus:border-[#00b6b4] focus:outline-none" required>
                                    </div>
                <div>
                    <label class="block text-sm font-medium text-[#f5f5f5] mb-2">Email</label>
                    <input type="email" name="email" id="edit_email" class="w-full px-3 py-2 bg-[#2a2a2a] border border-[#444] rounded-lg text-[#f5f5f5] focus:border-[#00b6b4] focus:outline-none" required>
                                </div>
                                <div>
                    <label class="block text-sm font-medium text-[#f5f5f5] mb-2">Téléphone</label>
                    <input type="text" name="phone" id="edit_phone" class="w-full px-3 py-2 bg-[#2a2a2a] border border-[#444] rounded-lg text-[#f5f5f5] focus:border-[#00b6b4] focus:outline-none" required>
                                    </div>
                <div>
                    <label class="block text-sm font-medium text-[#f5f5f5] mb-2">Ville</label>
                    <input type="text" name="city" id="edit_city" class="w-full px-3 py-2 bg-[#2a2a2a] border border-[#444] rounded-lg text-[#f5f5f5] focus:border-[#00b6b4] focus:outline-none" required>
                                    </div>
                <div>
                    <label class="block text-sm font-medium text-[#f5f5f5] mb-2">Rôle</label>
                    <select name="user_type" id="edit_user_type" class="w-full px-3 py-2 bg-[#2a2a2a] border border-[#444] rounded-lg text-[#f5f5f5] focus:border-[#00b6b4] focus:outline-none" required>
                        <option value="candidate">Candidat</option>
                        <option value="recruiter">Recruteur</option>
                        <option value="admin">Administrateur</option>
                    </select>
                                </div>
                <div>
                    <label class="block text-sm font-medium text-[#f5f5f5] mb-2">Statut</label>
                    <select name="status" id="edit_status" class="w-full px-3 py-2 bg-[#2a2a2a] border border-[#444] rounded-lg text-[#f5f5f5] focus:border-[#00b6b4] focus:outline-none" required>
                        <option value="active">Actif</option>
                        <option value="suspended">Suspendu</option>
                        <option value="pending">En attente</option>
                    </select>
                            </div>
                <div id="edit_company_field" class="hidden">
                    <label class="block text-sm font-medium text-[#f5f5f5] mb-2">Nom de l'entreprise</label>
                    <input type="text" name="company_name" id="edit_company_name" class="w-full px-3 py-2 bg-[#2a2a2a] border border-[#444] rounded-lg text-[#f5f5f5] focus:border-[#00b6b4] focus:outline-none">
                                </div>
                                </div>
            <div class="flex justify-end gap-3 mt-6">
                <button type="button" onclick="closeEditModal()" class="px-4 py-2 text-[#9ca3af] hover:text-[#f5f5f5] transition-colors">
                    Annuler
                </button>
                <button type="submit" class="px-6 py-2 bg-[#00b6b4] text-white rounded-lg hover:bg-[#009a97] transition-colors">
                    Mettre à jour
                </button>
                            </div>
        </form>
                            </div>
</div>

<!-- Delete User Modal -->
<div id="deleteUserModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
    <div class="bg-[#1a1a1a] rounded-lg shadow-xl max-w-md w-full">
        <div class="p-6">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.5 0L4.268 19.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                    </svg>
                                </div>
                <div>
                    <h3 class="text-lg font-semibold text-[#f5f5f5]">Supprimer l'utilisateur</h3>
                    <p class="text-sm text-[#9ca3af]">Cette action est irréversible</p>
                                </div>
                            </div>
            <p class="text-[#f5f5f5] mb-6" id="deleteUserMessage">
                Êtes-vous sûr de vouloir supprimer cet utilisateur ?
            </p>
            <div class="flex justify-end gap-3">
                <button onclick="closeDeleteModal()" class="px-4 py-2 text-[#9ca3af] hover:text-[#f5f5f5] transition-colors">
                    Annuler
                                </button>
                <button onclick="confirmDelete()" class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                    Supprimer
                                </button>
                            </div>
                                    </div>
                                </div>
</div>
@endsection

<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('Users page JavaScript loaded successfully');
    const searchInput = document.getElementById('userSearch');
    const userTypeFilter = document.getElementById('userTypeFilter');
    const userStatusFilter = document.getElementById('userStatusFilter');
    const tableRows = document.querySelectorAll('tbody tr');
    
    function filterUsers() {
        // Prevent multiple simultaneous filter requests
        if (isFiltering) {
            console.log('Filter already in progress, skipping...');
            return;
        }
        
        const searchTerm = searchInput.value.toLowerCase();
        const userTypeValue = userTypeFilter.value;
        const userStatusValue = userStatusFilter.value;
        
        console.log('Filtering with:', { searchTerm, userTypeValue, userStatusValue });
        
        // Check if we're already on a filtered page to avoid infinite loops
        const currentUrl = new URL(window.location);
        const currentSearch = currentUrl.searchParams.get('search') || '';
        const currentUserType = currentUrl.searchParams.get('user_type') || '';
        const currentStatus = currentUrl.searchParams.get('status') || '';
        
        // Only redirect if filters have actually changed
        if (searchTerm !== currentSearch || userTypeValue !== currentUserType || userStatusValue !== currentStatus) {
            isFiltering = true;
            
            const url = new URL(window.location);
            
            if (searchTerm) {
                url.searchParams.set('search', searchTerm);
            } else {
                url.searchParams.delete('search');
            }
            if (userTypeValue) {
                url.searchParams.set('user_type', userTypeValue);
            } else {
                url.searchParams.delete('user_type');
            }
            if (userStatusValue) {
                url.searchParams.set('status', userStatusValue);
            } else {
                url.searchParams.delete('status');
            }
            // Reset to page 1 when filtering
            url.searchParams.delete('page');
            
            // Only redirect if URL is actually different
            if (url.toString() !== window.location.href) {
                console.log('Redirecting to:', url.toString());
                window.location.href = url.toString();
            } else {
                isFiltering = false;
            }
            return;
        }
        
        // If no filters, show all rows on current page
        tableRows.forEach(row => {
            row.style.display = '';
        });
        
        console.log('No filters applied, showing all rows on current page');
    }
    
    // Debounce function to prevent too many requests
    let filterTimeout;
    let isFiltering = false;
    
    function debouncedFilter() {
        clearTimeout(filterTimeout);
        filterTimeout = setTimeout(filterUsers, 300); // Wait 300ms after user stops typing
    }
    
    // Add event listeners with debouncing
    searchInput.addEventListener('input', debouncedFilter);
    userTypeFilter.addEventListener('change', filterUsers);
    userStatusFilter.addEventListener('change', filterUsers);
    
    // Add User Modal Functionality
    const addUserBtn = document.getElementById('addUserBtn');
    const addUserModal = document.getElementById('addUserModal');
    const closeAddUserModal = document.getElementById('closeAddUserModal');
    const cancelAddUser = document.getElementById('cancelAddUser');
    const userTypeSelect = document.getElementById('user_type');
    const companyField = document.getElementById('companyField');
    const companyNameInput = document.getElementById('company_name');
    
    // Show modal
    addUserBtn.addEventListener('click', () => {
        addUserModal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    });
    
    // Close modal
    closeAddUserModal.addEventListener('click', () => {
        addUserModal.classList.add('hidden');
        document.body.style.overflow = 'auto';
        resetForm();
    });
    
    cancelAddUser.addEventListener('click', () => {
        addUserModal.classList.add('hidden');
        document.body.style.overflow = 'auto';
        resetForm();
    });
    
    // Close modal when clicking outside
    addUserModal.addEventListener('click', (e) => {
        if (e.target === addUserModal) {
            addUserModal.classList.add('hidden');
            document.body.style.overflow = 'auto';
            resetForm();
        }
    });
    
    // Close modal with Escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !addUserModal.classList.contains('hidden')) {
            addUserModal.classList.add('hidden');
            document.body.style.overflow = 'auto';
            resetForm();
        }
    });
    
    // Show/hide company field based on role
    userTypeSelect.addEventListener('change', () => {
        if (userTypeSelect.value === 'recruiter') {
            companyField.classList.remove('hidden');
            companyNameInput.required = true;
        } else {
            companyField.classList.add('hidden');
            companyNameInput.required = false;
            companyNameInput.value = '';
        }
    });
    
    // Reset form function
    function resetForm() {
        document.getElementById('addUserForm').reset();
        companyField.classList.add('hidden');
        companyNameInput.required = false;
    }
    
    // Form submission debugging
    document.getElementById('addUserForm').addEventListener('submit', function(e) {
        console.log('Form submitted');
        
        // Get form data
        const formData = new FormData(this);
        console.log('Form data entries:');
        for (let [key, value] of formData.entries()) {
            console.log(key + ': ' + value);
        }
        
        // Clear company name if not recruiter
        const userType = formData.get('user_type');
        if (userType !== 'recruiter') {
            // Remove company_name from form data if not recruiter
            const companyNameInput = document.getElementById('company_name');
            if (companyNameInput) {
                companyNameInput.value = '';
            }
        }
        
        // Show loading state
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalText = submitBtn.textContent;
        submitBtn.textContent = 'Création en cours...';
        submitBtn.disabled = true;
        
        // Re-enable after 3 seconds (fallback)
        setTimeout(() => {
            submitBtn.textContent = originalText;
            submitBtn.disabled = false;
        }, 3000);
    });
    
    // Modal functionality
    let currentUserId = null;
    
    
    // View User Modal
    window.viewUser = function(userId) {
        console.log('View user called with ID:', userId);
        currentUserId = userId;
        fetch(`/admin/users/${userId}`, {
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
            .then(response => {
                console.log('View response:', response);
                return response.json();
            })
            .then(data => {
                document.getElementById('viewUserContent').innerHTML = `
                    <div class="space-y-6">
                        <div class="flex items-center gap-4">
                            ${data.avatar ? 
                                `<img src="${data.avatar}" alt="${data.name}" class="w-16 h-16 rounded-full object-cover border-2 border-[#00b6b4]">` :
                                `<div class="w-16 h-16 bg-[#00b6b4] rounded-full flex items-center justify-center text-white text-xl font-bold">
                                    ${data.name.charAt(0).toUpperCase()}
                                </div>`
                            }
                                <div>
                                <h4 class="text-xl font-semibold text-[#f5f5f5]">${data.name}</h4>
                                <p class="text-[#9ca3af]">${data.email}</p>
                                    </div>
                                    </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h5 class="text-sm font-medium text-[#9ca3af] mb-2">Informations personnelles</h5>
                                <div class="space-y-2">
                                    <div class="flex justify-between">
                                        <span class="text-[#9ca3af]">Téléphone:</span>
                                        <span class="text-[#f5f5f5]">${data.phone || 'N/A'}</span>
                                </div>
                                    <div class="flex justify-between">
                                        <span class="text-[#9ca3af]">Ville:</span>
                                        <span class="text-[#f5f5f5]">${data.city || 'N/A'}</span>
                            </div>
                                    <div class="flex justify-between">
                                        <span class="text-[#9ca3af]">Rôle:</span>
                                        <span class="text-[#f5f5f5]">${data.user_type}</span>
                                </div>
                                    <div class="flex justify-between">
                                        <span class="text-[#9ca3af]">Statut:</span>
                                        <span class="text-[#f5f5f5]">${data.status}</span>
                                </div>
                                    ${data.company_name ? `
                                    <div class="flex justify-between">
                                        <span class="text-[#9ca3af]">Entreprise:</span>
                                        <span class="text-[#f5f5f5]">${data.company_name}</span>
                            </div>
                                    ` : ''}
                            </div>
                                </div>
                            
                            <div>
                                <h5 class="text-sm font-medium text-[#9ca3af] mb-2">Informations système</h5>
                                <div class="space-y-2">
                                    <div class="flex justify-between">
                                        <span class="text-[#9ca3af]">Inscription:</span>
                                        <span class="text-[#f5f5f5]">${data.created_at}</span>
                                </div>
                                    <div class="flex justify-between">
                                        <span class="text-[#9ca3af]">Dernière activité:</span>
                                        <span class="text-[#f5f5f5]">${data.updated_at}</span>
                            </div>
                                    <div class="flex justify-between">
                                        <span class="text-[#9ca3af]">Email vérifié:</span>
                                        <span class="text-[#f5f5f5]">${data.email_verified_at ? 'Oui' : 'Non'}</span>
                            </div>
        </div>
    </div>
        </div>
    </div>
                `;
                document.getElementById('viewUserModal').classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Erreur lors du chargement des données utilisateur');
            });
    }
    
    // Edit User Modal
    window.editUser = function(userId) {
        console.log('Edit user called with ID:', userId);
        currentUserId = userId;
        fetch(`/admin/users/${userId}`, {
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
            .then(response => {
                console.log('Edit response:', response);
                return response.json();
            })
            .then(data => {
                document.getElementById('edit_name').value = data.name;
                document.getElementById('edit_email').value = data.email;
                document.getElementById('edit_phone').value = data.phone || '';
                document.getElementById('edit_city').value = data.city || '';
                document.getElementById('edit_user_type').value = data.user_type;
                document.getElementById('edit_status').value = data.status;
                document.getElementById('edit_company_name').value = data.company_name || '';
                
                // Show/hide company field based on user type
                const companyField = document.getElementById('edit_company_field');
                const companyNameInput = document.getElementById('edit_company_name');
                if (data.user_type === 'recruiter') {
                    companyField.classList.remove('hidden');
                    companyNameInput.required = true;
                } else {
                    companyField.classList.add('hidden');
                    companyNameInput.required = false;
                }
                
                document.getElementById('editUserModal').classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Erreur lors du chargement des données utilisateur');
            });
    }
    
    // Delete User Modal
    window.deleteUser = function(userId, userName) {
        console.log('Delete user called with ID:', userId, 'Name:', userName);
        currentUserId = userId;
        document.getElementById('deleteUserMessage').textContent = 
            `Êtes-vous sûr de vouloir supprimer l'utilisateur "${userName}" ?`;
        document.getElementById('deleteUserModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    
    // Close modals
    window.closeViewModal = function() {
        document.getElementById('viewUserModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }
    
    window.closeEditModal = function() {
        document.getElementById('editUserModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }
    
    window.closeDeleteModal = function() {
        document.getElementById('deleteUserModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }
    
    // Confirm delete
    window.confirmDelete = function() {
        if (currentUserId) {
            fetch(`/admin/users/${currentUserId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert('Erreur lors de la suppression: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Erreur lors de la suppression');
            });
        }
        closeDeleteModal();
    }
    
    // Edit form submission
    document.getElementById('editUserForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const data = Object.fromEntries(formData);
        
        fetch(`/admin/users/${currentUserId}`, {
            method: 'PUT',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Erreur lors de la mise à jour: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Erreur lors de la mise à jour');
        });
    });
    
    // Edit user type change handler
    document.getElementById('edit_user_type').addEventListener('change', function() {
        const companyField = document.getElementById('edit_company_field');
        const companyNameInput = document.getElementById('edit_company_name');
        
        if (this.value === 'recruiter') {
            companyField.classList.remove('hidden');
            companyNameInput.required = true;
        } else {
            companyField.classList.add('hidden');
            companyNameInput.required = false;
            companyNameInput.value = '';
        }
    });
    
    // Close modals on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeViewModal();
            closeEditModal();
            closeDeleteModal();
        }
    });
});

// CSV Export Function
function exportUsersCSV() {
    console.log('Starting CSV export...');
    
    // Get all user data from the table
    const tableRows = document.querySelectorAll('tbody tr');
    const csvData = [];
    
    // Add CSV header
    csvData.push([
        'Nom',
        'Email', 
        'Téléphone',
        'Ville',
        'Type d\'utilisateur',
        'Statut',
        'Entreprise',
        'Date d\'inscription',
        'Dernière activité'
    ]);
    
    // Add user data rows using data attributes
    tableRows.forEach(row => {
        const cells = row.querySelectorAll('td');
        if (cells.length >= 6) {
            const name = cells[0].getAttribute('data-user-name') || '';
            const city = cells[0].getAttribute('data-user-city') || '';
            const email = cells[1].getAttribute('data-user-email') || '';
            const phone = cells[1].getAttribute('data-user-phone') || '';
            const userType = cells[2].getAttribute('data-user-type') || '';
            const company = cells[2].getAttribute('data-user-company') || '';
            const status = cells[3].getAttribute('data-user-status') || '';
            const registrationDate = cells[4].getAttribute('data-user-registration') || '';
            const lastActivity = cells[4].getAttribute('data-user-last-activity') || '';
            
            // Convert user type to French
            let userTypeFrench = userType;
            if (userType === 'candidate') userTypeFrench = 'Candidat';
            else if (userType === 'recruiter') userTypeFrench = 'Recruteur';
            else if (userType === 'admin') userTypeFrench = 'Administrateur';
            
            // Convert status to French
            let statusFrench = status;
            if (status === 'active') statusFrench = 'Actif';
            else if (status === 'suspended') statusFrench = 'Suspendu';
            else if (status === 'pending') statusFrench = 'En attente';
            
            csvData.push([
                name,
                email,
                phone,
                city,
                userTypeFrench,
                statusFrench,
                company,
                registrationDate,
                lastActivity
            ]);
        }
    });
    
    // Convert to CSV string
    const csvContent = csvData.map(row => 
        row.map(field => `"${field.replace(/"/g, '""')}"`).join(',')
    ).join('\n');
    
    // Create and download file
    const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
    const link = document.createElement('a');
    const url = URL.createObjectURL(blob);
    
    link.setAttribute('href', url);
    link.setAttribute('download', `utilisateurs_${new Date().toISOString().split('T')[0]}.csv`);
    link.style.visibility = 'hidden';
    
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    
    console.log('CSV export completed!');
}
</script>
