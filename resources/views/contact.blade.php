@extends('layouts.app')

@section('title', 'Contact - OMPLEO')
@section('description', 'Contactez-nous pour toute question ou demande d\'information')

@section('content')
<!-- Header -->
@include('components.header')

@php
$contactInfo = [
    [
        'title' => 'Adresse',
        'content' => 'Chéraga, Alger, Algérie',
        'color' => 'text-blue-600',
        'bgColor' => 'bg-blue-100',
    ],
    [
        'title' => 'Email',
        'content' => 'contact@ompleo.com',
        'color' => 'text-green-600',
        'bgColor' => 'bg-green-100',
    ],
    [
        'title' => 'Téléphone',
        'content' => '+213 XXX XXX XXX',
        'color' => 'text-purple-600',
        'bgColor' => 'bg-purple-100',
    ],
    [
        'title' => 'Heures',
        'content' => 'Dimanche - Jeudi : 9h - 17h',
        'color' => 'text-orange-600',
        'bgColor' => 'bg-orange-100',
    ],
];
@endphp

<div class="min-h-screen bg-gray-50 dark:bg-dark-900 pt-20">
    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-primary-600 to-accent-600 text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center animate-on-scroll">
            <h1 class="text-4xl lg:text-5xl font-bold mb-6" data-animate="hero-title">
                Contactez-nous
            </h1>
            <p class="text-xl opacity-90 max-w-2xl mx-auto" data-animate="hero-subtitle">
                Nous sommes là pour vous aider. N'hésitez pas à nous contacter pour toute question ou demande d'information.
            </p>
        </div>
    </section>

    <!-- Contact Info Cards -->
    <section class="py-16 -mt-8 relative z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($contactInfo as $index => $info)
                <div class="bg-white dark:bg-dark-800 rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 group hover:transform hover:scale-105" data-animate="contact-card" data-delay="{{ $index * 0.1 }}">
                    <div class="{{ $info['bgColor'] }} {{ $info['color'] }} w-12 h-12 rounded-lg flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                        @if($index === 0)
                            <!-- MapPin icon from Lucide React -->
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                        @elseif($index === 1)
                            <!-- Mail icon from Lucide React -->
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                                <path d="m22 7-10 5L2 7"></path>
                            </svg>
                        @elseif($index === 2)
                            <!-- Phone icon from Lucide React -->
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92Z"></path>
                            </svg>
                        @else
                            <!-- Clock icon from Lucide React -->
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12,6 12,12 16,14"></polyline>
                            </svg>
                        @endif
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-2">
                        {{ $info['title'] }}
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400">
                        {{ $info['content'] }}
                    </p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Contact Form & Map -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-2 lg:gap-16 items-start">
                <!-- Contact Form -->
                <div class="bg-white dark:bg-dark-800 rounded-2xl p-8 shadow-lg mb-8 lg:mb-0" data-animate="contact-form">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="bg-primary-100 text-primary-600 dark:bg-primary-900/30 dark:text-primary-400 w-10 h-10 rounded-lg flex items-center justify-center">
                            <!-- MessageCircle icon from Lucide React -->
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z"></path>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                            Envoyez-nous un message
                        </h2>
                    </div>

                    @if(session('success'))
                        <div class="mb-6 p-4 bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-200 rounded-lg border border-green-200 dark:border-green-800">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('contact.submit') }}" class="space-y-6" id="contact-form">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Nom complet *
                                </label>
                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    required
                                    class="w-full px-4 py-3 border border-gray-200 dark:border-dark-700 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none bg-white dark:bg-dark-700 text-gray-900 dark:text-gray-100"
                                    placeholder="Votre nom complet"
                                />
                            </div>
                            
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Email *
                                </label>
                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    required
                                    class="w-full px-4 py-3 border border-gray-200 dark:border-dark-700 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none bg-white dark:bg-dark-700 text-gray-900 dark:text-gray-100"
                                    placeholder="votre@email.com"
                                />
                            </div>
                        </div>
                        
                        <div>
                            <label for="subject" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Sujet *
                            </label>
                            <input
                                type="text"
                                id="subject"
                                name="subject"
                                required
                                class="w-full px-4 py-3 border border-gray-200 dark:border-dark-700 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none bg-white dark:bg-dark-700 text-gray-900 dark:text-gray-100"
                                placeholder="Sujet de votre message"
                            />
                        </div>
                        
                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Message *
                            </label>
                            <textarea
                                id="message"
                                name="message"
                                rows="6"
                                required
                                class="w-full px-4 py-3 border border-gray-200 dark:border-dark-700 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none bg-white dark:bg-dark-700 text-gray-900 dark:text-gray-100 resize-none"
                                placeholder="Décrivez votre demande en détail..."
                            ></textarea>
                        </div>
                        
                        <button
                            type="submit"
                            class="w-full btn-primary px-6 py-4 flex items-center justify-center gap-2 transform hover:scale-105 shadow-lg hover:shadow-xl transition-all duration-200"
                            id="submit-btn"
                        >
                            <!-- Send icon from Lucide React -->
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="m22 2-7 20-4-9-9-4Z"></path>
                                <path d="M22 2 11 13"></path>
                            </svg>
                            Envoyer le message
                        </button>
                    </form>
                </div>

                <!-- Map & Additional Info -->
                <div class="space-y-8" data-animate="contact-info">
                    <!-- Map Placeholder -->
                    <div class="bg-white dark:bg-dark-800 rounded-2xl p-8 shadow-lg">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-6">
                            Notre localisation
                        </h3>
                        <div class="w-full h-64 bg-gray-200 dark:bg-dark-700 rounded-lg flex items-center justify-center relative overflow-hidden">
                            <!-- MapPin icon from Lucide React -->
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                            <div class="absolute inset-0 bg-gradient-to-r from-primary-500/20 to-accent-500/20"></div>
                        </div>
                        <div class="mt-4 p-4 bg-gray-50 dark:bg-dark-700 rounded-lg">
                            <p class="font-medium text-gray-900 dark:text-gray-100">OMPLEO Headquarters</p>
                            <p class="text-gray-600 dark:text-gray-400">Chéraga, Alger, Algérie</p>
                        </div>
                    </div>

                    <!-- Additional Contact Info -->
                    <div class="bg-white dark:bg-dark-800 rounded-2xl p-8 shadow-lg">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-6">
                            Autres moyens de nous contacter
                        </h3>
                        <div class="space-y-4">
                            <div class="flex items-center gap-3 p-3 bg-gray-50 dark:bg-dark-700 rounded-lg">
                                <!-- Mail icon from Lucide React -->
                                <svg class="w-5 h-5 text-primary-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                                    <path d="m22 7-10 5L2 7"></path>
                                </svg>
                                <div>
                                    <p class="font-medium text-gray-900 dark:text-gray-100">Support technique</p>
                                    <p class="text-gray-600 dark:text-gray-400 text-sm">support@ompleo.com</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center gap-3 p-3 bg-gray-50 dark:bg-dark-700 rounded-lg">
                                <!-- Phone icon from Lucide React -->
                                <svg class="w-5 h-5 text-primary-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92Z"></path>
                                </svg>
                                <div>
                                    <p class="font-medium text-gray-900 dark:text-gray-100">Service commercial</p>
                                    <p class="text-gray-600 dark:text-gray-400 text-sm">+213 XXX XXX XXX</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center gap-3 p-3 bg-gray-50 dark:bg-dark-700 rounded-lg">
                                <!-- Clock icon from Lucide React -->
                                <svg class="w-5 h-5 text-primary-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12,6 12,12 16,14"></polyline>
                                </svg>
                                <div>
                                    <p class="font-medium text-gray-900 dark:text-gray-100">Heures d'ouverture</p>
                                    <p class="text-gray-600 dark:text-gray-400 text-sm">Dimanche - Jeudi : 9h - 17h</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Footer -->
@include('components.footer')

@push('styles')
<style>
[data-animate] {
    opacity: 0;
    transform: translateY(30px);
    transition: opacity 0.6s ease, transform 0.6s ease;
}

[data-animate].animate-fade-in {
    opacity: 1;
    transform: translateY(0);
}

.contact-card {
    transition: all 0.3s ease;
}

.contact-card:hover {
    transform: translateY(-5px) scale(1.05);
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Simple scroll animations using Intersection Observer
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-fade-in');
            }
        });
    }, observerOptions);

    // Observe all animated elements
    document.querySelectorAll('[data-animate]').forEach(el => {
        observer.observe(el);
    });

    // Contact form handling
    const contactForm = document.getElementById('contact-form');
    const submitBtn = document.getElementById('submit-btn');

    contactForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Show loading state
        submitBtn.innerHTML = `
            <div class="w-5 h-5 border-2 border-white border-t-transparent rounded-full animate-spin"></div>
            Envoi en cours...
        `;
        submitBtn.disabled = true;

        // Simulate form submission
        setTimeout(() => {
            // Show success message
            alert('Message envoyé avec succès! Nous vous répondrons dans les plus brefs délais.');
            
            // Reset form
            contactForm.reset();
            
            // Reset button
            submitBtn.innerHTML = `
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="m22 2-7 20-4-9-9-4Z"></path>
                    <path d="M22 2 11 13"></path>
                </svg>
                Envoyer le message
            `;
            submitBtn.disabled = false;
        }, 1500);
    });

    // Form validation
    const inputs = contactForm.querySelectorAll('input[required], textarea[required]');
    inputs.forEach(input => {
        input.addEventListener('blur', function() {
            if (!this.value.trim()) {
                this.classList.add('border-red-500');
                this.classList.remove('border-gray-200', 'dark:border-dark-700');
            } else {
                this.classList.remove('border-red-500');
                this.classList.add('border-gray-200', 'dark:border-dark-700');
            }
        });
    });
});
</script>
@endpush
@endsection
