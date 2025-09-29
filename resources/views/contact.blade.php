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
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
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
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        @elseif($index === 1)
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        @elseif($index === 2)
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                        @else
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
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
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
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
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
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
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
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
                                <svg class="w-5 h-5 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                <div>
                                    <p class="font-medium text-gray-900 dark:text-gray-100">Support technique</p>
                                    <p class="text-gray-600 dark:text-gray-400 text-sm">support@ompleo.com</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center gap-3 p-3 bg-gray-50 dark:bg-dark-700 rounded-lg">
                                <svg class="w-5 h-5 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                <div>
                                    <p class="font-medium text-gray-900 dark:text-gray-100">Service commercial</p>
                                    <p class="text-gray-600 dark:text-gray-400 text-sm">+213 XXX XXX XXX</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center gap-3 p-3 bg-gray-50 dark:bg-dark-700 rounded-lg">
                                <svg class="w-5 h-5 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
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
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
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
