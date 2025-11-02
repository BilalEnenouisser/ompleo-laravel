@extends('layouts.app')

@section('content')
@include('components.header')

@php
use Illuminate\Support\Facades\Storage;
@endphp

<div class="min-h-screen bg-white dark:bg-[#1f1f1f] relative overflow-hidden">
    <!-- Hero Section -->
    <section class="bg-[#00b6b4] text-white py-20 relative overflow-hidden">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10 animate-on-scroll">
            <h1 class="text-4xl lg:text-5xl font-bold mb-6" data-animate="hero-title">
                Trouvez les talents faits pour votre entreprise
            </h1>
            <p class="text-xl opacity-90 max-w-2xl mx-auto" data-animate="hero-subtitle">
                Parcourez des profils qualifiés et trouvez le bon profil grâce à une sélection intelligente
            </p>
        </div>
    </section>


    <!-- Candidates Grid -->
    <section class="py-16 relative z-10">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div id="candidatesGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($candidates as $candidate)
                    @if($candidate->candidateProfile)
                        @php
                            $profile = $candidate->candidateProfile;
                            $initials = '';
                            if ($candidate->name) {
                                $nameParts = explode(' ', $candidate->name);
                                $initials = strtoupper(substr($nameParts[0], 0, 1));
                                if (count($nameParts) > 1) {
                                    $initials .= strtoupper(substr($nameParts[1], 0, 1));
                                }
                            }
                        
                            // Parse skills
                            $skills = [];
                            if ($profile && $profile->skills && is_array($profile->skills)) {
                                $skills = array_filter(array_map(function($skill) {
                                    return is_string($skill) ? trim($skill) : (string) $skill;
                                }, $profile->skills));
                            }
                        
                            $experienceText = $profile->experience_years ?? 'Non spécifié';
                        
                            $educationText = 'Non spécifié';
                            if ($profile && isset($profile->education) && is_array($profile->education) && !empty($profile->education)) {
                                try {
                                    $firstEducation = $profile->education[0];
                                    if (is_array($firstEducation)) {
                                        $educationText = $firstEducation['degree'] ?? 
                                                       $firstEducation['title'] ?? 
                                                       $firstEducation['diploma'] ?? 
                                                       $firstEducation['name'] ?? 
                                                       'Non spécifié';
                                        $educationText = trim($educationText);
                                        if (empty($educationText)) {
                                            $educationText = 'Non spécifié';
                                        }
                                    } elseif (is_string($firstEducation)) {
                                        $educationText = trim($firstEducation);
                                        if (empty($educationText)) {
                                            $educationText = 'Non spécifié';
                                        }
                                    }
                                } catch (Exception $e) {
                                    $educationText = 'Non spécifié';
                                }
                            }
                        @endphp
                        
                        <div class="bg-white dark:bg-[#2b2b2b] rounded-xl p-5 shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 dark:border-[#333333] flex flex-col">
                            {{-- Top Section: Image on Left, Compétences on Right --}}
                            <div class="flex gap-4 mb-4">
                                {{-- Profile Image on Left --}}
                                <div class="flex-shrink-0">
                                    @if($profile->avatar)
                                        <img src="{{ Storage::url($profile->avatar) }}" alt="{{ $candidate->name }}" class="w-20 h-20 rounded-lg object-cover">
                                    @else
                                        <div class="w-20 h-20 bg-[#00b6b4]/20 rounded-lg flex items-center justify-center border border-[#00b6b4]/30">
                                            <span class="text-[#00b6b4] font-bold text-2xl">{{ $initials ?: 'U' }}</span>
                                        </div>
                                    @endif
                                </div>

                                {{-- Compétences on Right --}}
                                <div class="flex-1 min-w-0">
                                    @if(count($skills) > 0)
                                    <div class="flex flex-wrap gap-1.5">
                                        @foreach(array_slice($skills, 0, 2) as $skill)
                                            <span class="px-2.5 py-1 bg-[#00b6b4]/20 text-[#00b6b4] rounded-full border border-[#00b6b4]/30 text-xs font-medium text-center sm:text-left">{{ $skill }}</span>
                                        @endforeach
                                    </div>
                                    @endif
                                </div>
                            </div>

                            {{-- Bottom Section: Name, Description, Details --}}
                            <div class="mb-4 flex-1">
                                {{-- Name --}}
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-1.5">{{ strtoupper($candidate->name) }}</h3>

                                {{-- Description --}}
                                @if($profile->bio)
                                <p class="text-sm text-gray-700 dark:text-gray-300 mb-3 line-clamp-2 leading-relaxed">{{ $profile->bio }}</p>
                                @endif

                                {{-- Ville --}}
                                @if($profile->city)
                                <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400 mb-1.5">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                                    <span>{{ $profile->city }}</span>
                                </div>
                                @endif

                                {{-- Titre professionnel --}}
                                @php
                                    // Get title from profile, or extract from first experience entry if title field doesn't exist
                                    $professionalTitle = $profile->title ?? null;
                                    if (!$professionalTitle && isset($profile->experience) && is_array($profile->experience) && !empty($profile->experience)) {
                                        $firstExp = $profile->experience[0];
                                        if (is_array($firstExp) && isset($firstExp['title'])) {
                                            $professionalTitle = $firstExp['title'];
                                        }
                                    }
                                @endphp
                                @if($professionalTitle)
                                <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400 mb-1.5">
                                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"></path><path d="M6 12H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h2"></path><path d="M18 9h2a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2h-2"></path><path d="M10 6h4"></path><path d="M10 10h4"></path><path d="M10 14h4"></path><path d="M10 18h4"></path></svg>
                                    <span>{{ $professionalTitle }}</span>
                                </div>
                                @endif

                                {{-- Years of Experience --}}
                                @if($experienceText && $experienceText !== 'Non spécifié')
                                <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="14" x="2" y="7" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
                                    <span>{{ $experienceText }}</span>
                                </div>
                                @endif
                            </div>

                            {{-- Button at Bottom --}}
                            <a href="{{ route('companies.show', $candidate->id) }}" class="w-full bg-[#00b6b4] hover:bg-[#009999] text-white py-2.5 rounded-lg transition-colors text-center font-semibold text-sm mt-auto">
                                Voir le profils
                            </a>
                        </div>
                    @endif
                @empty
                    <div class="col-span-3 text-center py-16">
                        <div class="w-24 h-24 mx-auto mb-6 bg-[#00b6b4]/10 rounded-full flex items-center justify-center">
                            <svg class="w-12 h-12 text-[#00b6b4]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                <circle cx="12" cy="7" r="4"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-2">Aucun candidat trouvé</h3>
                        <p class="text-gray-600 dark:text-gray-400">Aucun candidat ne correspond à vos critères de recherche.</p>
                    </div>
                @endforelse
            </div>

            {{-- Load More Button --}}
            @if($candidates->hasMorePages())
            <div class="mt-8 text-center">
                <button 
                    id="loadMoreBtn" 
                    data-next-page="{{ $candidates->currentPage() + 1 }}"
                    class="bg-[#00b6b4] hover:bg-[#009999] text-white px-8 py-3 rounded-lg font-medium transition-colors"
                >
                    Charger plus
                </button>
            </div>
            @endif
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-16 bg-[#00b6b4] text-white relative overflow-hidden">
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="liquid-shape w-96 h-96 bg-white/10 top-20 -left-20"></div>
            <div class="liquid-shape w-80 h-80 bg-white/10 bottom-20 -right-20" style="animation-delay: 2s;"></div>
        </div>
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-3 gap-2 sm:gap-8 text-center">
                <div class="animate-fade-in-up" data-animate="stat-1">
                    <div class="flex items-center justify-center mb-2 sm:mb-4 animate-bounce-gentle">
                        <svg class="w-6 h-6 sm:w-12 sm:h-12 text-white/80" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <polyline points="22,7 13.5,15.5 8.5,10.5 2,17"></polyline>
                            <polyline points="16,7 22,7 22,13"></polyline>
                        </svg>
                    </div>
                    <div class="text-lg sm:text-4xl font-bold mb-1 sm:mb-2 animate-counter">
                        98%
                    </div>
                    <div class="text-xs sm:text-base text-white/80">Taux de satisfaction</div>
                </div>
                
                <div class="animate-fade-in-up" data-animate="stat-2" style="animation-delay: 0.2s;">
                    <div class="flex items-center justify-center mb-2 sm:mb-4 animate-bounce-gentle" style="animation-delay: 0.5s;">
                        <svg class="w-6 h-6 sm:w-12 sm:h-12 text-white/80" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26"></polygon>
                        </svg>
                    </div>
                    <div class="text-lg sm:text-4xl font-bold mb-1 sm:mb-2 animate-counter" style="animation-delay: 0.4s;">
                        {{ number_format($candidateCount) }}+
                    </div>
                    <div class="text-xs sm:text-base text-white/80">Profils disponible</div>
                </div>
                
                <div class="animate-fade-in-up" data-animate="stat-3" style="animation-delay: 0.4s;">
                    <div class="flex items-center justify-center mb-2 sm:mb-4 animate-bounce-gentle" style="animation-delay: 1s;">
                        <svg class="w-6 h-6 sm:w-12 sm:h-12 text-white/80" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                            <polyline points="22,4 12,14.01 9,11.01"></polyline>
                        </svg>
                    </div>
                    <div class="text-lg sm:text-4xl font-bold mb-1 sm:mb-2 animate-counter" style="animation-delay: 0.6s;">
                        24h
                    </div>
                    <div class="text-xs sm:text-base text-white/80">Temps de réponse moyen</div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gray-50 dark:bg-[#2b2b2b]">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-4xl text-center">
            <h2 class="text-4xl font-bold text-gray-900 dark:text-gray-100 mb-6 animate-fade-in-up" data-animate="cta-title">
                Recrutez plus intelligemment
            </h2>
            <p class="text-xl text-gray-600 dark:text-gray-400 mb-8 animate-fade-in-up" data-animate="cta-subtitle" style="animation-delay: 0.2s;">
                Créez votre compte entreprise et laissez notre système intelligent vous connecter aux bons talents, plus rapidement
            </p>
            @guest
            <a href="{{ route('signup.recruiter') }}" class="inline-block bg-[#00b6b4] hover:bg-[#009e9c] text-white px-8 py-4 rounded-xl font-bold text-lg transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-105 active:scale-95 animate-fade-in-up" data-animate="cta-button" style="animation-delay: 0.4s;">
                Créer mon compte maintenant
            </a>
            @endguest
        </div>
    </section>
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
let currentPage = {{ $candidates->currentPage() }};
let hasMore = {{ $candidates->hasMorePages() ? 'true' : 'false' }};

// Load More functionality
document.addEventListener('DOMContentLoaded', function() {
    const loadMoreBtn = document.getElementById('loadMoreBtn');
    if (loadMoreBtn) {
        loadMoreBtn.addEventListener('click', function() {
            const nextPage = this.getAttribute('data-next-page');
            loadMoreCandidates(nextPage);
        });
    }
});

function loadMoreCandidates(page) {
    const loadMoreBtn = document.getElementById('loadMoreBtn');
    const candidatesGrid = document.getElementById('candidatesGrid');
    
    if (!loadMoreBtn || !candidatesGrid) return;
    
    loadMoreBtn.disabled = true;
    loadMoreBtn.textContent = 'Chargement...';
    
    // Build URL with current search parameters
    const url = new URL('{{ route("companies.index") }}', window.location.origin);
    url.searchParams.set('page', page);
    @if(request('search'))
        url.searchParams.set('search', '{{ request("search") }}');
    @endif
    @if(request('location'))
        url.searchParams.set('location', '{{ request("location") }}');
    @endif
    
    fetch(url.toString(), {
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.html) {
            const tempDiv = document.createElement('div');
            tempDiv.innerHTML = data.html;
            Array.from(tempDiv.children).forEach(child => {
                candidatesGrid.appendChild(child);
            });
            
            hasMore = data.has_more;
            currentPage = data.next_page;
            
            if (data.has_more) {
                loadMoreBtn.setAttribute('data-next-page', data.next_page);
                loadMoreBtn.disabled = false;
                loadMoreBtn.textContent = 'Charger plus';
            } else {
                loadMoreBtn.remove();
            }
        }
    })
    .catch(error => {
        console.error('Error loading more candidates:', error);
        loadMoreBtn.disabled = false;
        loadMoreBtn.textContent = 'Charger plus';
    });
}

// Message Modal functionality
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
