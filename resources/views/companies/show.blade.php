@extends('layouts.app')

@section('title', $candidate->name . ' - Profil Candidat - OMPLEO')
@section('description', 'Consultez le profil détaillé du candidat ' . $candidate->name)

@section('content')
@include('components.header')

@php
use Illuminate\Support\Facades\Storage;
@endphp

<div class="min-h-screen bg-white dark:bg-[#1f1f1f] pt-20">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{-- Header --}}
        <div class="mb-8">
            <a href="{{ route('companies.index') }}" class="inline-flex items-center gap-2 text-gray-600 dark:text-[#9ca3af] hover:text-[#00b6b4] transition-colors mb-4">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m15 18-6-6 6-6"/>
                </svg>
                Retour aux candidats
            </a>
            <div>
                <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-[#f5f5f5] mb-2">
                    {{ $candidate->name }}
                </h1>
                @if($profile->title)
                    <p class="text-lg text-gray-600 dark:text-[#9ca3af]">
                        {{ $profile->title }}
                    </p>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 sm:gap-8">
            {{-- Main Content --}}
            <div class="lg:col-span-2 space-y-6 sm:space-y-8">
                {{-- About Section --}}
                @if($profile->bio)
                <div class="bg-white dark:bg-[#2b2b2b] border border-gray-200 dark:border-[#333333] rounded-2xl p-6 shadow-lg">
                    <h2 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-[#f5f5f5] mb-4">À propos</h2>
                    <p class="text-base text-gray-700 dark:text-[#9ca3af] leading-relaxed">{{ $profile->bio }}</p>
                </div>
                @endif

                {{-- Experience Section --}}
                @if($profile->experience && count($profile->experience) > 0)
                <div class="bg-white dark:bg-[#2b2b2b] border border-gray-200 dark:border-[#333333] rounded-2xl p-6 shadow-lg">
                    <h2 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-[#f5f5f5] mb-4">Expérience professionnelle</h2>
                    <div class="space-y-6">
                        @foreach($profile->experience as $exp)
                        <div class="border-l-2 border-[#00b6b4] pl-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-[#f5f5f5]">{{ $exp['title'] ?? 'Titre non spécifié' }}</h3>
                            <p class="text-[#00b6b4] font-medium">{{ $exp['company'] ?? 'Entreprise non spécifiée' }}</p>
                            <p class="text-sm text-gray-600 dark:text-[#9ca3af] mb-2">{{ $exp['period'] ?? 'Période non spécifiée' }}</p>
                            @if(isset($exp['description']) && $exp['description'])
                                <p class="text-sm text-gray-700 dark:text-[#9ca3af] leading-relaxed">{{ $exp['description'] }}</p>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Education Section --}}
                @if($profile->education && count($profile->education) > 0)
                <div class="bg-white dark:bg-[#2b2b2b] border border-gray-200 dark:border-[#333333] rounded-2xl p-6 shadow-lg">
                    <h2 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-[#f5f5f5] mb-4">Formation</h2>
                    <div class="space-y-6">
                        @foreach($profile->education as $edu)
                        <div class="border-l-2 border-[#00b6b4] pl-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-[#f5f5f5]">{{ $edu['degree'] ?? 'Diplôme non spécifié' }}</h3>
                            <p class="text-[#00b6b4] font-medium">{{ $edu['school'] ?? 'École non spécifiée' }}</p>
                            <p class="text-sm text-gray-600 dark:text-[#9ca3af] mb-2">{{ $edu['period'] ?? 'Période non spécifiée' }}</p>
                            @if(isset($edu['description']) && $edu['description'])
                                <p class="text-sm text-gray-700 dark:text-[#9ca3af] leading-relaxed">{{ $edu['description'] }}</p>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Skills Section --}}
                @if($profile->skills && count($profile->skills) > 0)
                <div class="bg-white dark:bg-[#2b2b2b] border border-gray-200 dark:border-[#333333] rounded-2xl p-6 shadow-lg">
                    <h2 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-[#f5f5f5] mb-4">Compétences</h2>
                    <div class="flex flex-wrap gap-3">
                        @foreach($profile->skills as $skill)
                        <span class="bg-[#00b6b4]/20 text-[#00b6b4] px-4 py-2 rounded-full text-sm font-medium">
                            {{ $skill }}
                        </span>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Languages Section --}}
                @if($profile->languages && count($profile->languages) > 0)
                <div class="bg-white dark:bg-[#2b2b2b] border border-gray-200 dark:border-[#333333] rounded-2xl p-6 shadow-lg">
                    <h2 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-[#f5f5f5] mb-4">Langues</h2>
                    <div class="space-y-3">
                        @foreach($profile->languages as $lang)
                        <div class="flex items-center justify-between">
                            <span class="text-base font-medium text-gray-900 dark:text-[#f5f5f5]">{{ $lang['name'] ?? 'Langue non spécifiée' }}</span>
                            <span class="text-sm text-gray-600 dark:text-[#9ca3af] bg-gray-100 dark:bg-[#333333] px-3 py-1 rounded-full">
                                {{ $lang['level'] ?? 'Niveau non spécifié' }}
                            </span>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            {{-- Sidebar --}}
            <div class="space-y-6 sm:space-y-8">
                {{-- Profile Card --}}
                <div class="bg-white dark:bg-[#2b2b2b] border border-gray-200 dark:border-[#333333] rounded-2xl p-6 shadow-lg">
                    <div class="text-center">
                        {{-- Avatar --}}
                        <div class="w-24 h-24 bg-gray-100 dark:bg-[#333333] rounded-full flex items-center justify-center mx-auto mb-4">
                            @if($profile->avatar)
                                <img src="{{ Storage::url($profile->avatar) }}" alt="{{ $candidate->name }}" class="w-full h-full rounded-full object-cover">
                            @else
                                <svg class="w-12 h-12 text-gray-400 dark:text-[#9ca3af]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                    <circle cx="12" cy="7" r="4"/>
                                </svg>
                            @endif
                        </div>

                        {{-- Name and Title --}}
                        <h3 class="text-xl font-bold text-gray-900 dark:text-[#f5f5f5] mb-1">{{ $candidate->name }}</h3>
                        @if($profile->title)
                            <p class="text-sm text-gray-600 dark:text-[#9ca3af] mb-4">{{ $profile->title }}</p>
                        @endif

                        {{-- Contact Info --}}
                        <div class="space-y-2 text-sm text-gray-600 dark:text-[#9ca3af] mb-6">
                            @if($profile->city)
                            <div class="flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/>
                                    <circle cx="12" cy="10" r="3"/>
                                </svg>
                                <span>{{ $profile->city }}</span>
                            </div>
                            @endif

                            @if($profile->phone)
                            <div class="flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                                </svg>
                                <span>{{ $profile->phone }}</span>
                            </div>
                            @endif

                            @if($profile->email)
                            <div class="flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                    <polyline points="22,6 12,13 2,6"/>
                                </svg>
                                <span>{{ $profile->email }}</span>
                            </div>
                            @endif
                        </div>

                        {{-- Message Button for Recruiters --}}
                        @auth
                            @if(auth()->user()->user_type === 'recruiter')
                                <button onclick="openMessageModal({{ $candidate->id }}, '{{ addslashes($candidate->name) }}')" class="w-full bg-[#00b6b4] hover:bg-[#009999] text-white py-3 rounded-lg transition-colors flex items-center justify-center gap-2 font-medium">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                                    Envoyer un message
                                </button>
                            @endif
                        @endauth
                    </div>
                </div>

                {{-- Social Links --}}
                @if($profile->linkedin_url || $profile->portfolio_url || $profile->facebook_url || $profile->twitter_url)
                <div class="bg-white dark:bg-[#2b2b2b] border border-gray-200 dark:border-[#333333] rounded-2xl p-6 shadow-lg">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-[#f5f5f5] mb-4">Liens sociaux</h3>
                    <div class="space-y-2">
                        @if($profile->linkedin_url)
                        <a href="{{ $profile->linkedin_url }}" target="_blank" class="flex items-center gap-2 text-gray-600 dark:text-[#9ca3af] hover:text-[#00b6b4] transition-colors">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/>
                                <rect width="4" height="12" x="2" y="9"/>
                                <circle cx="4" cy="4" r="2"/>
                            </svg>
                            LinkedIn
                        </a>
                        @endif

                        @if($profile->portfolio_url)
                        <a href="{{ $profile->portfolio_url }}" target="_blank" class="flex items-center gap-2 text-gray-600 dark:text-[#9ca3af] hover:text-[#00b6b4] transition-colors">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/>
                                <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/>
                            </svg>
                            Portfolio
                        </a>
                        @endif

                        @if($profile->facebook_url)
                        <a href="{{ $profile->facebook_url }}" target="_blank" class="flex items-center gap-2 text-gray-600 dark:text-[#9ca3af] hover:text-[#00b6b4] transition-colors">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
                            </svg>
                            Facebook
                        </a>
                        @endif

                        @if($profile->twitter_url)
                        <a href="{{ $profile->twitter_url }}" target="_blank" class="flex items-center gap-2 text-gray-600 dark:text-[#9ca3af] hover:text-[#00b6b4] transition-colors">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"/>
                            </svg>
                            Twitter
                        </a>
                        @endif
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@include('components.footer')

<!-- Message Modal -->
@auth
@if(auth()->user()->user_type === 'recruiter')
<div id="messageModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white dark:bg-[#2b2b2b] rounded-2xl p-6 max-w-md w-full">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-xl font-bold text-gray-900 dark:text-[#f5f5f5]">Envoyer un message</h3>
            <button onclick="closeMessageModal()" class="text-gray-500 dark:text-[#9ca3af] hover:text-gray-700 dark:hover:text-[#f5f5f5]">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <form id="messageForm" onsubmit="sendMessage(event)">
            <input type="hidden" id="candidateId" name="candidate_id">
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-[#9ca3af] mb-2">À:</label>
                <p class="text-gray-900 dark:text-[#f5f5f5]" id="candidateName"></p>
            </div>
            <div class="mb-4">
                <label for="messageText" class="block text-sm font-medium text-gray-700 dark:text-[#9ca3af] mb-2">Message:</label>
                <textarea 
                    id="messageText" 
                    name="message" 
                    rows="5" 
                    required 
                    minlength="10"
                    maxlength="1000"
                    class="w-full px-4 py-2 border border-gray-300 dark:border-[#444444] rounded-lg bg-white dark:bg-[#1f1f1f] text-gray-900 dark:text-[#f5f5f5] focus:ring-2 focus:ring-[#00b6b4] focus:border-transparent"
                    placeholder="Écrivez votre message ici..."
                ></textarea>
                <p class="text-xs text-gray-500 dark:text-[#9ca3af] mt-1">Minimum 10 caractères, maximum 1000 caractères</p>
            </div>
            <div class="flex gap-3">
                <button 
                    type="submit" 
                    class="flex-1 bg-[#00b6b4] hover:bg-[#009999] text-white py-2 rounded-lg transition-colors"
                >
                    Envoyer
                </button>
                <button 
                    type="button" 
                    onclick="closeMessageModal()" 
                    class="px-4 py-2 border border-gray-300 dark:border-[#444444] text-gray-700 dark:text-[#9ca3af] rounded-lg hover:bg-gray-50 dark:hover:bg-[#333333] transition-colors"
                >
                    Annuler
                </button>
            </div>
        </form>
    </div>
</div>
@endif
@endauth

<script>
@auth
@if(auth()->user()->user_type === 'recruiter')
function openMessageModal(candidateId, candidateName) {
    document.getElementById('candidateId').value = candidateId;
    document.getElementById('candidateName').textContent = candidateName;
    document.getElementById('messageText').value = '';
    document.getElementById('messageModal').classList.remove('hidden');
}

function closeMessageModal() {
    document.getElementById('messageModal').classList.add('hidden');
    document.getElementById('messageForm').reset();
}

function sendMessage(event) {
    event.preventDefault();
    
    const candidateId = document.getElementById('candidateId').value;
    const message = document.getElementById('messageText').value;
    const submitBtn = event.target.querySelector('button[type="submit"]');
    
    if (!message || message.length < 10) {
        alert('Le message doit contenir au moins 10 caractères.');
        return;
    }
    
    submitBtn.disabled = true;
    submitBtn.textContent = 'Envoi...';
    
    fetch(`/companies/${candidateId}/message`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            message: message
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Message envoyé avec succès!');
            closeMessageModal();
        } else {
            alert(data.error || 'Erreur lors de l\'envoi du message.');
            submitBtn.disabled = false;
            submitBtn.textContent = 'Envoyer';
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Erreur lors de l\'envoi du message.');
        submitBtn.disabled = false;
        submitBtn.textContent = 'Envoyer';
    });
}
@endif
@endauth
</script>
@endsection
