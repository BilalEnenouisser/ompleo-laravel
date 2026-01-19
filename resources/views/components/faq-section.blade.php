<section class="relative py-20 bg-[#1f1f1f] overflow-hidden">
    <!-- Background Image -->
    <div class="absolute bottom-0 left-0 hidden lg:block pointer-events-none z-0">
        <img src="{{ asset('storage/home_page/search_job/bottom.png') }}" alt="Background" class="h-auto w-auto object-cover" style="object-position: left bottom;">
    </div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
            <!-- Left Section -->
            <div class="text-left flex flex-col items-start justify-center mx-auto">
                <!-- Title -->
                <h2 class="text-5xl md:text-6xl lg:text-7xl font-bold text-white mb-4">
                    Foire Aux<br>Questions
                </h2>
                
                <!-- Subtitle -->
                <p class="text-lg text-white mb-8">
                    Besoin de plus d'informations ?
                </p>

                <!-- Contact Button -->
                <a href="{{ route('contact') }}" class="inline-flex items-center gap-3 px-6 py-3 rounded-full text-white font-bold transition-all duration-300 hover:scale-105" style="background: linear-gradient(135deg, #1aa2a0, #39fffc); border: 1px solid #47fffd; text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);">
                    <img src="{{ asset('storage/home_page/search_job/icon3.svg') }}" alt="Icon" class="w-5 h-5">
                    <span>Nous contacter</span>
                </a>
            </div>

            <!-- Right Section: Accordion -->
            <div class="space-y-4">
                @php
                $faqs = [
                    [
                        'question' => 'OMPLEO est-il gratuit pour les candidats ?',
                        'answer' => 'Oui. OMPLEO est entièrement gratuit pour les candidats. Vous pouvez consulter les offres, configurer des alertes emploi et postuler directement, sans frais cachés.',
                        'expanded' => true
                    ],
                    [
                        'question' => 'Comment postuler à une offre d\'emploi ?',
                        'answer' => 'Pour postuler à une offre d\'emploi sur OMPLEO, il vous suffit de créer un compte candidat, de consulter les offres disponibles, et de cliquer sur le bouton "Postuler" sur l\'offre qui vous intéresse. Vous pourrez ensuite télécharger votre CV et lettre de motivation.',
                        'expanded' => false
                    ],
                    [
                        'question' => 'Les entreprises peuvent-elles publier des offres sur OMPLEO ?',
                        'answer' => 'Oui, les entreprises peuvent publier leurs offres d\'emploi sur OMPLEO. Il suffit de créer un compte recruteur, de remplir les informations de votre entreprise, et de publier vos offres d\'emploi. Notre plateforme vous permet de gérer vos offres et de recevoir des candidatures directement.',
                        'expanded' => false
                    ],
                    [
                        'question' => 'Comment rester informé des nouvelles offres d\'emploi ?',
                        'answer' => 'Vous pouvez configurer des alertes emploi personnalisées en fonction de vos critères (localisation, secteur, type de contrat, etc.). Vous recevrez une notification par email dès qu\'une nouvelle offre correspondant à vos critères est publiée.',
                        'expanded' => false
                    ]
                ];
                @endphp

                @foreach($faqs as $index => $faq)
                <div class="faq-item" data-index="{{ $index }}">
                    <div class="p-[1px] rounded-lg" style="background: linear-gradient(135deg, #165c5b, #00fadc, #165c5b); border-radius: 10px;">
                        <div class="p-6 rounded-lg" style="background-color: #161616; border-radius: 10px;">
                            <!-- Question Header -->
                            <button 
                                type="button"
                                class="w-full flex items-center justify-between text-left focus:outline-none"
                                onclick="toggleFaq({{ $index }})"
                            >
                                <h3 class="text-lg font-bold text-white pr-4">
                                    {{ $faq['question'] }}
                                </h3>
                                <div class="flex-shrink-0 faq-icon" data-state="{{ $faq['expanded'] ? 'expanded' : 'collapsed' }}">
                                    <img src="{{ asset('storage/home_page/search_job/acc.svg') }}" alt="Toggle" class="w-6 h-6 transition-transform duration-300">
                                </div>
                            </button>
                            
                            <!-- Answer Content -->
                            <div class="faq-content mt-4 {{ $faq['expanded'] ? 'block' : 'hidden' }}" data-content="{{ $index }}">
                                <p class="text-white text-sm leading-relaxed">
                                    {{ $faq['answer'] }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<script>
function toggleFaq(index) {
    // Close all other FAQ items
    const allContents = document.querySelectorAll('.faq-content');
    const allIcons = document.querySelectorAll('.faq-icon img');
    
    allContents.forEach((content, i) => {
        if (i !== index) {
            content.classList.remove('block');
            content.classList.add('hidden');
        }
    });
    
    allIcons.forEach((icon, i) => {
        if (i !== index) {
            icon.style.transform = 'rotate(0deg)';
        }
    });
    
    // Toggle the clicked item
    const content = document.querySelector(`[data-content="${index}"]`);
    const icon = document.querySelector(`[data-index="${index}"] .faq-icon`);
    const iconImg = icon.querySelector('img');
    
    if (content.classList.contains('hidden')) {
        // Expand
        content.classList.remove('hidden');
        content.classList.add('block');
        icon.setAttribute('data-state', 'expanded');
        iconImg.style.transform = 'rotate(45deg)';
    } else {
        // Collapse
        content.classList.remove('block');
        content.classList.add('hidden');
        icon.setAttribute('data-state', 'collapsed');
        iconImg.style.transform = 'rotate(0deg)';
    }
}

// Initialize expanded state for first item
document.addEventListener('DOMContentLoaded', function() {
    const firstIcon = document.querySelector('[data-index="0"] .faq-icon img');
    if (firstIcon) {
        firstIcon.style.transform = 'rotate(45deg)';
    }
});
</script>
