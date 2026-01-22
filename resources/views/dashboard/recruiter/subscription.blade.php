@extends('layouts.dashboard')

@section('title', 'Abonnement - OMPLEO')
@section('description', 'Gérez votre abonnement et consultez les informations de paiement')
@section('page-title', 'Abonnement')

@section('content')
<div class="space-y-4 sm:space-y-6 md:space-y-8">
    {{-- Header --}}
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-3 sm:gap-4">
        <div>
            <h1 class="text-xl sm:text-2xl md:text-3xl font-bold text-[#f5f5f5]">
                Abonnement
            </h1>
            <p class="text-sm sm:text-base text-[#9ca3af] mt-1 sm:mt-2">
                Consultez votre période d'abonnement et les informations de paiement
            </p>
        </div>
    </div>

    {{-- Current Subscription Card --}}
    @if($currentSubscription)
    <div class="bg-gradient-to-r from-[#00b6b4] to-[#009e9c] rounded-2xl p-4 sm:p-6 md:p-8 text-white">
        <div class="flex flex-row items-center justify-between gap-4 subscription-header-row">
            <style>
                @media (max-width: 767px) {
                    .subscription-header-row {
                        flex-direction: column !important;
                        align-items: flex-start !important;
                    }
                }
            </style>
            <div>
                <h2 class="text-lg sm:text-xl md:text-2xl font-bold mb-2">
                    @if($currentSubscription->status === 'active')
                        Abonnement Actif
                    @elseif($currentSubscription->status === 'pending')
                        Abonnement En Attente
                    @else
                        Abonnement
                    @endif
                </h2>
                <div class="space-y-2 text-sm sm:text-base">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="18" height="18" x="3" y="4" rx="2" ry="2"/>
                            <line x1="16" x2="16" y1="2" y2="6"/>
                            <line x1="8" x2="8" y1="2" y2="6"/>
                            <line x1="3" x2="21" y1="10" y2="10"/>
                        </svg>
                        <span>Du {{ $currentSubscription->start_date->format('d/m/Y') }} au {{ $currentSubscription->end_date->format('d/m/Y') }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"/>
                            <polyline points="12,6 12,12 16,14"/>
                        </svg>
                        <span>
                            @if($currentSubscription->end_date->isFuture())
                                Expire dans {{ $currentSubscription->end_date->diffForHumans() }}
                            @else
                                Expiré depuis {{ $currentSubscription->end_date->diffForHumans() }}
                            @endif
                        </span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="12" x2="12" y1="1" y2="23"/>
                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
                        </svg>
                        <span>Montant : {{ number_format($currentSubscription->amount, 2, ',', ' ') }} DA</span>
                    </div>
                </div>
            </div>
            <div class="flex-shrink-0">
                <span class="inline-flex items-center px-3 sm:px-4 py-2 rounded-full text-sm sm:text-base font-medium bg-white/20 backdrop-blur-sm">
                    @if($currentSubscription->status === 'active')
                        Actif
                    @elseif($currentSubscription->status === 'pending')
                        En Attente
                    @else
                        {{ ucfirst($currentSubscription->status) }}
                    @endif
                </span>
            </div>
        </div>
    </div>
    @else
    <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-4 sm:p-6 md:p-8 text-center">
        <div class="w-16 h-16 mx-auto mb-4 bg-[#00b6b4]/10 rounded-full flex items-center justify-center">
            <svg class="w-8 h-8 text-[#00b6b4]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="12" x2="12" y1="1" y2="23"/>
                <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
            </svg>
        </div>
        <h3 class="text-lg sm:text-xl font-semibold text-[#f5f5f5] mb-2">Aucun abonnement actif</h3>
        <p class="text-[#9ca3af] mb-4">Vous n'avez pas d'abonnement actif pour le moment.</p>
    </div>
    @endif

    {{-- Payment Information Card --}}
    <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-4 sm:p-6 shadow-lg">
        <h2 class="text-lg sm:text-xl font-bold text-[#f5f5f5] mb-4 sm:mb-6">
            Informations de paiement
        </h2>
        
        <div class="space-y-3 sm:space-y-4">
            {{-- Banque Option --}}
            <div class="border border-[#444444] rounded-xl overflow-hidden">
                <button onclick="togglePaymentInfo('banque')" class="w-full flex items-center justify-between p-4 text-left hover:bg-[#333333] transition-colors">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 sm:w-12 sm:h-12 bg-blue-900/30 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-blue-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect width="20" height="14" x="2" y="5" rx="2"/>
                                <line x1="2" x2="22" y1="10" y2="10"/>
                            </svg>
                        </div>
                        <span class="font-medium text-[#f5f5f5] text-sm sm:text-base">Banque</span>
                    </div>
                    <svg id="banque-icon" class="w-5 h-5 text-[#9ca3af] transform transition-transform" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6,9 12,15 18,9"/>
                    </svg>
                </button>
                <div id="banque-content" class="hidden px-4 py-4">
                    <div class="bg-[#333333] rounded-lg p-4 space-y-3">
                        <div>
                            <p class="text-xs sm:text-sm text-[#9ca3af] mb-1">RIB</p>
                            <p class="text-sm sm:text-base font-medium text-[#f5f5f5]">56210022546</p>
                        </div>
                        <div>
                            <p class="text-xs sm:text-sm text-[#9ca3af] mb-1">Nom de la banque</p>
                            <p class="text-sm sm:text-base font-medium text-[#f5f5f5]">SGA</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- CCP Option --}}
            <div class="border border-[#444444] rounded-xl overflow-hidden">
                <button onclick="togglePaymentInfo('ccp')" class="w-full flex items-center justify-between p-4 text-left hover:bg-[#333333] transition-colors">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 sm:w-12 sm:h-12 bg-green-900/30 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-green-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                                <circle cx="9" cy="7" r="4"/>
                                <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                            </svg>
                        </div>
                        <span class="font-medium text-[#f5f5f5] text-sm sm:text-base">CCP</span>
                    </div>
                    <svg id="ccp-icon" class="w-5 h-5 text-[#9ca3af] transform transition-transform" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6,9 12,15 18,9"/>
                    </svg>
                </button>
                <div id="ccp-content" class="hidden px-4 py-4">
                    <div class="bg-[#333333] rounded-lg p-4 space-y-3">
                        <div>
                            <p class="text-xs sm:text-sm text-[#9ca3af] mb-1">Numéro CCP</p>
                            <p class="text-sm sm:text-base font-medium text-[#f5f5f5]">11002545651</p>
                        </div>
                        <div>
                            <p class="text-xs sm:text-sm text-[#9ca3af] mb-1">Clé</p>
                            <p class="text-sm sm:text-base font-medium text-[#f5f5f5]">75</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Espèces Option (Optional) --}}
            <div class="border border-[#444444] rounded-xl overflow-hidden">
                <button onclick="togglePaymentInfo('especes')" class="w-full flex items-center justify-between p-4 text-left hover:bg-[#333333] transition-colors">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 sm:w-12 sm:h-12 bg-yellow-900/30 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-yellow-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"/>
                                <line x1="12" x2="12" y1="2" y2="6"/>
                                <line x1="12" x2="12" y1="18" y2="22"/>
                                <line x1="4.93" x2="7.76" y1="4.93" y2="7.76"/>
                                <line x1="16.24" x2="19.07" y1="16.24" y2="19.07"/>
                                <line x1="2" x2="6" y1="12" y2="12"/>
                                <line x1="18" x2="22" y1="12" y2="12"/>
                                <line x1="4.93" x2="7.76" y1="19.07" y2="16.24"/>
                                <line x1="16.24" x2="19.07" y1="7.76" y2="4.93"/>
                            </svg>
                        </div>
                        <span class="font-medium text-[#f5f5f5] text-sm sm:text-base">Espèces</span>
                    </div>
                    <svg id="especes-icon" class="w-5 h-5 text-[#9ca3af] transform transition-transform" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6,9 12,15 18,9"/>
                    </svg>
                </button>
                <div id="especes-content" class="hidden px-4 py-4">
                    <div class="bg-[#333333] rounded-lg p-4 space-y-3">
                        <p class="text-sm sm:text-base text-[#9ca3af]">
                            Pour le paiement en espèces, veuillez nous contacter directement ou vous rendre à notre bureau.
                        </p>
                        <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 text-[#00b6b4] hover:text-[#009999] text-sm sm:text-base font-medium transition-colors">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                            </svg>
                            Contact
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Subscription History --}}
    @if($subscriptions->count() > 0)
    <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-4 sm:p-6 shadow-lg">
        <h2 class="text-lg sm:text-xl font-bold text-[#f5f5f5] mb-4 sm:mb-6">
            Historique des abonnements
        </h2>
        <div class="overflow-x-auto">
            <table class="w-full min-w-[600px]">
                <thead class="bg-[#333333]">
                    <tr>
                        <th class="text-left py-3 px-4 font-semibold text-[#f5f5f5] text-xs sm:text-sm">Période</th>
                        <th class="text-left py-3 px-4 font-semibold text-[#f5f5f5] text-xs sm:text-sm">Montant</th>
                        <th class="text-left py-3 px-4 font-semibold text-[#f5f5f5] text-xs sm:text-sm">Méthode</th>
                        <th class="text-left py-3 px-4 font-semibold text-[#f5f5f5] text-xs sm:text-sm">Statut</th>
                        <th class="text-left py-3 px-4 font-semibold text-[#f5f5f5] text-xs sm:text-sm">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($subscriptions as $subscription)
                    <tr class="border-b border-[#333333] hover:bg-[#333333]">
                        <td class="py-3 px-4 text-xs sm:text-sm text-[#f5f5f5]">
                            {{ $subscription->start_date->format('d/m/Y') }} - {{ $subscription->end_date->format('d/m/Y') }}
                        </td>
                        <td class="py-3 px-4 text-xs sm:text-sm text-[#f5f5f5]">
                            {{ number_format($subscription->amount, 2, ',', ' ') }} DA
                        </td>
                        <td class="py-3 px-4 text-xs sm:text-sm text-[#9ca3af]">
                            {{ $subscription->payment_method ?? 'N/A' }}
                        </td>
                        <td class="py-3 px-4">
                            @php
                                $statusColors = [
                                    'active' => 'bg-green-900/30 text-green-400',
                                    'expired' => 'bg-red-900/30 text-red-400',
                                    'pending' => 'bg-yellow-900/30 text-yellow-400',
                                    'cancelled' => 'bg-gray-900/30 text-gray-400',
                                ];
                                $statusLabels = [
                                    'active' => 'Actif',
                                    'expired' => 'Expiré',
                                    'pending' => 'En Attente',
                                    'cancelled' => 'Annulé',
                                ];
                            @endphp
                            <span class="px-2 py-1 rounded-full text-xs font-medium {{ $statusColors[$subscription->status] ?? 'bg-gray-900/30 text-gray-400' }}">
                                {{ $statusLabels[$subscription->status] ?? ucfirst($subscription->status) }}
                            </span>
                        </td>
                        <td class="py-3 px-4 text-xs sm:text-sm text-[#9ca3af]">
                            {{ $subscription->created_at->format('d/m/Y') }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $subscriptions->links() }}
    </div>
    @endif
</div>

<script>
function togglePaymentInfo(type) {
    const content = document.getElementById(type + '-content');
    const icon = document.getElementById(type + '-icon');
    
    if (content.classList.contains('hidden')) {
        content.classList.remove('hidden');
        icon.classList.add('rotate-180');
    } else {
        content.classList.add('hidden');
        icon.classList.remove('rotate-180');
    }
}
</script>
@endsection

