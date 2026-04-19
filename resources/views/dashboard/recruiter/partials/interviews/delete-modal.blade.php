<div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
    <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-4 sm:p-6 max-w-md w-full">
        <div class="flex items-center gap-3 sm:gap-4 mb-3 sm:mb-4">
            <div class="w-10 h-10 sm:w-12 sm:h-12 bg-red-500/20 rounded-full flex items-center justify-center flex-shrink-0">
                <svg class="w-7 h-7 sm:w-6 sm:h-6 text-red-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                </svg>
            </div>
            <div>
                <h3 class="text-base sm:text-lg font-semibold text-[#f5f5f5]">{{ __('Supprimer l\'entretien') }}</h3>
                <p class="text-xs sm:text-sm text-[#9ca3af]">{{ __('Cette action est irreversible') }}</p>
            </div>
        </div>

        <p class="text-sm sm:text-base text-[#f5f5f5] mb-4 sm:mb-6">
            {{ __('Etes-vous sur de vouloir supprimer l\'entretien avec') }} <span id="candidateName" class="font-semibold text-[#00b6b4]"></span> ?
        </p>

        <div class="flex flex-col sm:flex-row gap-2 sm:gap-3 justify-end">
            <button type="button" onclick="hideDeleteModal()" class="px-3 sm:px-4 py-2 border border-[#444444] rounded-lg text-[#9ca3af] hover:bg-[#333333] transition-colors text-xs sm:text-sm">
                {{ __('Annuler') }}
            </button>
            <form id="deleteForm" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full sm:w-auto bg-red-500 hover:bg-red-600 text-white px-3 sm:px-4 py-2 rounded-lg transition-colors text-xs sm:text-sm">
                    {{ __('Supprimer') }}
                </button>
            </form>
        </div>
    </div>
</div>
