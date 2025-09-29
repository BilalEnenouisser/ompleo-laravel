<section class="py-16 bg-[#00b6b4]/10 dark:bg-[#00b6b4]/5 relative overflow-hidden">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-[#2b2b2b] rounded-2xl p-8 md:p-12 shadow-lg border border-[#00b6b4]/20 dark:border-[#00b6b4]/10">
            <div class="flex flex-col md:flex-row items-center justify-between gap-8">
                <div class="md:w-2/3">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-gray-100 mb-4">
                        Vous êtes une entreprise ?
                    </h2>
                    <p class="text-xl text-gray-600 dark:text-gray-400 mb-6">
                        Publiez vos offres d'emploi et trouvez les meilleurs talents pour votre entreprise.
                    </p>
                    <ul class="space-y-2 mb-8 md:mb-0 dark:text-gray-400">
                        <li class="flex items-center gap-2 text-gray-600 dark:text-gray-400">
                            <span class="w-2 h-2 bg-[#00b6b4] rounded-full"></span>
                            <span>Accès à plus de 12 500 profils certifiés</span>
                        </li>
                        <li class="flex items-center gap-2 text-gray-600 dark:text-gray-400">
                            <span class="w-2 h-2 bg-[#00b6b4] rounded-full"></span>
                            <span>Outils de recrutement avancés</span>
                        </li>
                        <li class="flex items-center gap-2 text-gray-600 dark:text-gray-400">
                            <span class="w-2 h-2 bg-[#00b6b4] rounded-full"></span>
                            <span>Support dédié 7j/7</span>
                        </li>
                    </ul>
                </div>
                
                <div class="md:w-1/3 flex justify-center">
                    <a 
                        href="{{ route('recruiter.register') }}"
                        class="bg-[#00b6b4] text-white px-8 py-4 rounded-xl font-bold text-lg transition-all duration-300 transform hover:scale-105 hover:bg-[#009e9c] shadow-md hover:shadow-lg flex items-center gap-3"
                    >
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        <span>Recruter maintenant</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
