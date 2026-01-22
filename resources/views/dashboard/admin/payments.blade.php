@extends('layouts.dashboard')
@section('page-title', 'Paiements')
@section('content')
<div class="space-y-8">
    {{-- Header --}}
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-3 sm:gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-[#f5f5f5]">
                Gestion des Paiements
            </h1>
            <p class="text-sm sm:text-base text-[#9ca3af] mt-1 sm:mt-2">
                Suivez et gérez tous les paiements de la plateforme
            </p>
        </div>
        <div class="flex items-center gap-2 sm:gap-3">
            <button class="bg-[#333333] hover:bg-[#444444] text-[#f5f5f5] px-3 sm:px-4 py-2 rounded-lg font-medium transition-colors flex items-center gap-2 text-sm sm:text-base">
                <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                    <polyline points="7,10 12,15 17,10"/>
                    <line x1="12" x2="12" y1="15" y2="3"/>
                </svg>
                Exporter
            </button>
        </div>
    </div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 sm:gap-6">
        {{-- Revenus totaux --}}
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-4 sm:p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs sm:text-sm text-[#cccccc]">Revenus totaux</p>
                    <p class="text-xl sm:text-2xl font-bold text-[#f5f5f5]">
                        {{ number_format($stats['total_revenue'] ?? 0, 0, ',', ' ') }} DA
                    </p>
                </div>
                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-green-900/30 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-green-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" x2="12" y1="1" y2="23"/>
                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Transactions --}}
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-4 sm:p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs sm:text-sm text-[#cccccc]">Transactions</p>
                    <p class="text-xl sm:text-2xl font-bold text-[#f5f5f5]">{{ $stats['total_transactions'] ?? 0 }}</p>
                </div>
                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-blue-900/30 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-blue-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect width="20" height="14" x="2" y="5" rx="2"/>
                        <line x1="2" x2="22" y1="10" y2="10"/>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Complétés --}}
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-4 sm:p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs sm:text-sm text-[#cccccc]">Complétés</p>
                    <p class="text-xl sm:text-2xl font-bold text-green-400">{{ $stats['completed'] ?? 0 }}</p>
                </div>
                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-green-900/30 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-green-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                        <path d="M22 4 12 14.01l-3-3"/>
                    </svg>
                </div>
            </div>
        </div>

        {{-- En attente --}}
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-4 sm:p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs sm:text-sm text-[#cccccc]">En attente</p>
                    <p class="text-xl sm:text-2xl font-bold text-yellow-400">{{ $stats['pending'] ?? 0 }}</p>
                </div>
                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-yellow-900/30 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-yellow-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"/>
                        <polyline points="12,6 12,12 16,14"/>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Échoués --}}
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-4 sm:p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs sm:text-sm text-[#cccccc]">Échoués</p>
                    <p class="text-xl sm:text-2xl font-bold text-red-400">{{ $stats['expired'] ?? 0 }}</p>
                </div>
                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-red-900/30 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-red-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"/>
                        <line x1="15" x2="9" y1="9" y2="15"/>
                        <line x1="9" x2="15" y1="9" y2="15"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    {{-- Revenue Chart --}}
    <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-4 sm:p-6 shadow-lg">
        <div class="flex flex-row items-center justify-between gap-3 sm:gap-4 mb-4 sm:mb-6 payments-header-row">
            <style>
                /* Desktop is default - flex-row */
                @media (max-width: 767px) {
                    .payments-header-row {
                        flex-direction: column !important;
                        align-items: flex-start !important;
                    }
                }
            </style>
            <h2 class="text-lg sm:text-xl font-bold text-[#f5f5f5]">
                Évolution des revenus
            </h2>
            <div class="flex items-center gap-2 text-green-400">
                <svg class="w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="22,7 13.5,15.5 8.5,10.5 2,17"/>
                    <polyline points="16,7 22,7 22,13"/>
                </svg>
                <span class="text-sm sm:text-base font-medium">+12.5% ce mois</span>
            </div>
        </div>
        <div class="space-y-3 sm:space-y-4">
            <div class="flex flex-row items-center justify-between gap-3 payment-item-row">
                <style>
                    @media (max-width: 767px) {
                        .payment-item-row {
                            flex-direction: column !important;
                            align-items: flex-start !important;
                        }
                    }
                </style>
                <div class="flex items-center gap-2 sm:gap-3">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 bg-[#00b6b4]/20 rounded-lg flex items-center justify-center">
                        <span class="text-sm sm:text-base font-bold text-[#00b6b4]">Oct</span>
                    </div>
                    <div>
                        <p class="text-sm sm:text-base font-semibold text-[#f5f5f5]">
                            156,000 DA
                        </p>
                        <p class="text-xs sm:text-sm text-[#9ca3af]">Revenus du mois</p>
                    </div>
                </div>
                <div class="w-full sm:w-32 h-2 bg-[#333333] rounded-full overflow-hidden">
                    <div class="h-full bg-[#00b6b4] rounded-full" style="width: 62.4%"></div>
                </div>
            </div>
            <div class="flex flex-row items-center justify-between gap-3 payment-item-row">
                <style>
                    @media (max-width: 767px) {
                        .payment-item-row {
                            flex-direction: column !important;
                            align-items: flex-start !important;
                        }
                    }
                </style>
                <div class="flex items-center gap-2 sm:gap-3">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 bg-[#00b6b4]/20 rounded-lg flex items-center justify-center">
                        <span class="text-sm sm:text-base font-bold text-[#00b6b4]">Nov</span>
                    </div>
                    <div>
                        <p class="text-sm sm:text-base font-semibold text-[#f5f5f5]">
                            189,000 DA
                        </p>
                        <p class="text-xs sm:text-sm text-[#9ca3af]">Revenus du mois</p>
                    </div>
                </div>
                <div class="w-full sm:w-32 h-2 bg-[#333333] rounded-full overflow-hidden">
                    <div class="h-full bg-[#00b6b4] rounded-full" style="width: 75.6%"></div>
                </div>
            </div>
            <div class="flex flex-row items-center justify-between gap-3 payment-item-row">
                <style>
                    @media (max-width: 767px) {
                        .payment-item-row {
                            flex-direction: column !important;
                            align-items: flex-start !important;
                        }
                    }
                </style>
                <div class="flex items-center gap-2 sm:gap-3">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 bg-[#00b6b4]/20 rounded-lg flex items-center justify-center">
                        <span class="text-sm sm:text-base font-bold text-[#00b6b4]">Déc</span>
                    </div>
                    <div>
                        <p class="text-sm sm:text-base font-semibold text-[#f5f5f5]">
                            234,000 DA
                        </p>
                        <p class="text-xs sm:text-sm text-[#9ca3af]">Revenus du mois</p>
                    </div>
                </div>
                <div class="w-full sm:w-32 h-2 bg-[#333333] rounded-full overflow-hidden">
                    <div class="h-full bg-[#00b6b4] rounded-full" style="width: 93.6%"></div>
                </div>
            </div>
            <div class="flex flex-row items-center justify-between gap-3 payment-item-row">
                <style>
                    @media (max-width: 767px) {
                        .payment-item-row {
                            flex-direction: column !important;
                            align-items: flex-start !important;
                        }
                    }
                </style>
                <div class="flex items-center gap-2 sm:gap-3">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 bg-[#00b6b4]/20 rounded-lg flex items-center justify-center">
                        <span class="text-sm sm:text-base font-bold text-[#00b6b4]">Jan</span>
                    </div>
                    <div>
                        <p class="text-sm sm:text-base font-semibold text-[#f5f5f5]">
                            179,000 DA
                        </p>
                        <p class="text-xs sm:text-sm text-[#9ca3af]">Revenus du mois</p>
                    </div>
                </div>
                <div class="w-full sm:w-32 h-2 bg-[#333333] rounded-full overflow-hidden">
                    <div class="h-full bg-[#00b6b4] rounded-full" style="width: 71.6%"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- Filters --}}
    <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-4 sm:p-6 shadow-lg">
        <form method="GET" action="{{ route('admin.payments') }}" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
            <div class="relative">
                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-[#cccccc] w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"/>
                    <path d="M21 21l-4.35-4.35"/>
                </svg>
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Rechercher par entreprise ou ID..."
                    class="w-full pl-8 sm:pl-10 pr-4 py-2.5 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] text-sm sm:text-base"
                />
            </div>
            
            <div class="relative">
                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-[#cccccc] w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/>
                </svg>
                <select name="status" class="w-full pl-8 sm:pl-10 pr-6 sm:pr-8 py-2.5 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none appearance-none bg-[#333333] text-[#f5f5f5] text-sm sm:text-base">
                    <option value="">Tous les statuts</option>
                    <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Complété</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>En attente</option>
                    <option value="expired" {{ request('status') === 'expired' ? 'selected' : '' }}>Expiré</option>
                    <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Annulé</option>
                </select>
            </div>
            
            <div class="relative">
                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-[#cccccc] w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect width="20" height="14" x="2" y="5" rx="2"/>
                    <line x1="2" x2="22" y1="10" y2="10"/>
                </svg>
                <select name="method" class="w-full pl-8 sm:pl-10 pr-6 sm:pr-8 py-2.5 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none appearance-none bg-[#333333] text-[#f5f5f5] text-sm sm:text-base">
                    <option value="">Toutes les méthodes</option>
                    <option value="banque" {{ request('method') === 'banque' ? 'selected' : '' }}>Banque</option>
                    <option value="CCP" {{ request('method') === 'CCP' ? 'selected' : '' }}>CCP</option>
                    <option value="Espèces" {{ request('method') === 'Espèces' ? 'selected' : '' }}>Espèces</option>
                </select>
            </div>
            
            <button class="bg-[#00b6b4] hover:bg-[#009999] text-white px-3 sm:px-4 py-2.5 sm:py-3 rounded-lg font-medium transition-colors flex items-center justify-center gap-2 text-sm sm:text-base">
                <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect width="18" height="18" x="3" y="4" rx="2" ry="2"/>
                    <line x1="16" x2="16" y1="2" y2="6"/>
                    <line x1="8" x2="8" y1="2" y2="6"/>
                    <line x1="3" x2="21" y1="10" y2="10"/>
                </svg>
                Période
            </button>
        </form>
    </div>

    {{-- Payments Table --}}
    <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[1000px]">
                <thead class="bg-[#333333]">
                    <tr>
                        <th class="text-left py-4 px-6 font-semibold text-[#f5f5f5] text-sm sm:text-base min-w-[150px]">Transaction</th>
                        <th class="text-left py-4 px-6 font-semibold text-[#f5f5f5] text-sm sm:text-base min-w-[250px]">Entreprise</th>
                        <th class="text-left py-4 px-6 font-semibold text-[#f5f5f5] text-sm sm:text-base min-w-[120px]">Montant</th>
                        <th class="text-left py-4 px-6 font-semibold text-[#f5f5f5] text-sm sm:text-base min-w-[150px]">Méthode</th>
                        <th class="text-left py-4 px-6 font-semibold text-[#f5f5f5] text-sm sm:text-base min-w-[130px]">Statut</th>
                        <th class="text-left py-4 px-6 font-semibold text-[#f5f5f5] text-sm sm:text-base min-w-[120px]">Date</th>
                        <th class="text-left py-4 px-6 font-semibold text-[#f5f5f5] text-sm sm:text-base min-w-[100px]">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($subscriptions as $subscription)
                    @php
                        $statusColors = [
                            'active' => 'bg-green-900/30 text-green-400',
                            'expired' => 'bg-red-900/30 text-red-400',
                            'pending' => 'bg-yellow-900/30 text-yellow-400',
                            'cancelled' => 'bg-gray-900/30 text-gray-400',
                        ];
                        $statusLabels = [
                            'active' => 'Complété',
                            'expired' => 'Expiré',
                            'pending' => 'En attente',
                            'cancelled' => 'Annulé',
                        ];
                        $company = $subscription->company;
                        $recruiter = $subscription->recruiter;
                    @endphp
                    <tr class="border-b border-[#333333] hover:bg-[#333333]">
                        <td class="py-4 px-6 min-w-[150px]">
                            <div>
                                <div class="font-semibold text-[#f5f5f5] text-sm sm:text-base whitespace-nowrap">
                                    {{ $subscription->transaction_id ?? 'TXN-' . $subscription->id }}
                                </div>
                                <div class="text-xs sm:text-sm text-[#9ca3af] whitespace-nowrap">
                                    {{ $subscription->start_date->format('d/m/Y') }} - {{ $subscription->end_date->format('d/m/Y') }}
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6 min-w-[250px]">
                            <div class="flex items-center gap-2 sm:gap-3">
                                <div class="w-8 h-8 sm:w-10 sm:h-10 bg-gradient-to-br from-[#00b6b4] to-[#009999] rounded-full flex items-center justify-center flex-shrink-0">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"/>
                                        <path d="M6 12H4a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2"/>
                                        <path d="M18 9h2a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2h-2"/>
                                        <path d="M10 6h4"/>
                                        <path d="M10 10h4"/>
                                        <path d="M10 14h4"/>
                                        <path d="M10 18h4"/>
                                    </svg>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <div class="font-medium text-[#f5f5f5] text-sm sm:text-base truncate">{{ $company->name ?? $recruiter->name ?? 'N/A' }}</div>
                                    <div class="text-xs sm:text-sm text-[#9ca3af] truncate">{{ $recruiter->email ?? 'N/A' }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6 min-w-[120px]">
                            <div class="font-bold text-[#f5f5f5] text-sm sm:text-base whitespace-nowrap">
                                {{ number_format($subscription->amount, 0, ',', ' ') }} DA
                            </div>
                        </td>
                        <td class="py-4 px-6 min-w-[150px]">
                            <div class="flex items-center gap-1 sm:gap-2">
                                <svg class="w-3 h-3 sm:w-4 sm:h-4 text-[#9ca3af] flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect width="20" height="14" x="2" y="5" rx="2"/>
                                    <line x1="2" x2="22" y1="10" y2="10"/>
                                </svg>
                                <span class="text-[#9ca3af] text-xs sm:text-sm whitespace-nowrap">{{ $subscription->payment_method ?? 'N/A' }}</span>
                            </div>
                        </td>
                        <td class="py-4 px-6 min-w-[130px]">
                            <span class="px-2 sm:px-3 py-1 rounded-full text-xs sm:text-sm font-medium flex items-center gap-1 sm:gap-2 w-fit {{ $statusColors[$subscription->status] ?? 'bg-gray-900/30 text-gray-400' }} whitespace-nowrap">
                                <svg class="w-3 h-3 sm:w-4 sm:h-4 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    @if($subscription->status === 'active')
                                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                                        <path d="M22 4 12 14.01l-3-3"/>
                                    @elseif($subscription->status === 'pending')
                                        <circle cx="12" cy="12" r="10"/>
                                        <polyline points="12,6 12,12 16,14"/>
                                    @else
                                        <circle cx="12" cy="12" r="10"/>
                                        <line x1="15" x2="9" y1="9" y2="15"/>
                                        <line x1="9" x2="15" y1="9" y2="15"/>
                                    @endif
                                </svg>
                                {{ $statusLabels[$subscription->status] ?? ucfirst($subscription->status) }}
                            </span>
                        </td>
                        <td class="py-4 px-6 min-w-[120px]">
                            <div class="flex items-center gap-1 text-[#9ca3af]">
                                <svg class="w-3 h-3 sm:w-4 sm:h-4 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect width="18" height="18" x="3" y="4" rx="2" ry="2"/>
                                    <line x1="16" x2="16" y1="2" y2="6"/>
                                    <line x1="8" x2="8" y1="2" y2="6"/>
                                    <line x1="3" x2="21" y1="10" y2="10"/>
                                </svg>
                                <span class="text-xs sm:text-sm whitespace-nowrap">{{ $subscription->created_at->format('Y-m-d') }}</span>
                            </div>
                        </td>
                        <td class="py-4 px-6 min-w-[100px]">
                            <div class="flex items-center gap-1 sm:gap-2">
                                <button class="p-1.5 sm:p-2 text-[#9ca3af] hover:text-[#00b6b4] transition-colors duration-200">
                                    <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/>
                                        <circle cx="12" cy="12" r="3"/>
                                    </svg>
                                </button>
                                <button class="p-1.5 sm:p-2 text-[#9ca3af] hover:text-blue-400 transition-colors duration-200">
                                    <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                                        <polyline points="7,10 12,15 17,10"/>
                                        <line x1="12" x2="12" y1="15" y2="3"/>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="py-8 px-6 text-center text-[#9ca3af]">
                            Aucun paiement trouvé
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    <div class="flex flex-row items-center justify-between gap-3 sm:gap-4 payments-bottom-row">
        <style>
            @media (max-width: 767px) {
                .payments-bottom-row {
                    flex-direction: column !important;
                }
            }
        </style>
        <p class="text-sm sm:text-base text-[#9ca3af]">
            Affichage de {{ $subscriptions->firstItem() ?? 0 }} à {{ $subscriptions->lastItem() ?? 0 }} sur {{ $subscriptions->total() }} paiement(s)
        </p>
        <div class="flex items-center gap-2">
            {{ $subscriptions->links() }}
        </div>
    </div>
</div>
@endsection
