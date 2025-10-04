@extends('layouts.dashboard')

@section('content')
<div class="space-y-8">
    {{-- Header --}}
    <div class="flex items-center justify-between">
        <h1 class="text-3xl font-bold text-[#f5f5f5]">
            Mon Profil
        </h1>
        <div class="flex items-center gap-3">
            <button id="cancelBtn" class="hidden px-4 py-2 border border-[#444444] rounded-lg text-[#9ca3af] hover:bg-[#333333] transition-colors flex items-center gap-2">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6L6 18"/><path d="M6 6l12 12"/></svg>
                Annuler
            </button>
            <button id="saveBtn" class="hidden bg-[#00b6b4] hover:bg-[#009999] text-white px-4 py-2 rounded-lg transition-colors flex items-center gap-2">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17,21 17,13 7,13 7,21"/><polyline points="7,3 7,8 15,8"/></svg>
                Sauvegarder
            </button>
            <button id="editBtn" class="bg-[#00b6b4] hover:bg-[#009999] text-white px-4 py-2 rounded-lg transition-colors flex items-center gap-2">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="m18.5 2.5 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                Modifier
            </button>
        </div>
    </div>

    {{-- Profile Header --}}
    <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-8 shadow-lg">
        <div class="flex flex-col lg:flex-row gap-8">
            <div class="flex flex-col items-center lg:items-start">
                <div class="relative">
                    <div class="w-32 h-32 bg-gradient-to-br from-[#00b6b4] to-[#009999] rounded-full flex items-center justify-center text-white text-4xl font-bold">
                        AB
                    </div>
                    <button class="absolute bottom-0 right-0 w-10 h-10 bg-[#00b6b4] rounded-full flex items-center justify-center text-white hover:bg-[#009999] transition-colors">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.5 4h-5L7 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-3l-2.5-3z"/><circle cx="12" cy="13" r="3"/></svg>
                    </button>
                </div>
            </div>

            <div class="flex-1">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-[#9ca3af] mb-2">
                            Prénom
                        </label>
                        <input id="firstName" type="text" value="Ahmed" class="w-full px-4 py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5]" readonly />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-[#9ca3af] mb-2">
                            Nom
                        </label>
                        <input id="lastName" type="text" value="Belkacem" class="w-full px-4 py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5]" readonly />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-[#9ca3af] mb-2">
                            Titre professionnel
                        </label>
                        <input id="title" type="text" value="Développeur Frontend" class="w-full px-4 py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5]" readonly />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-[#9ca3af] mb-2">
                            Localisation
                        </label>
                        <input id="location" type="text" value="Alger, Algérie" class="w-full px-4 py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5]" readonly />
                    </div>
                </div>

                <div class="mt-6">
                    <label class="block text-sm font-medium text-[#9ca3af] mb-2">
                        À propos
                    </label>
                    <textarea id="bio" rows="3" class="w-full px-4 py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5]" readonly>Passionné par le développement web moderne et les nouvelles technologies.</textarea>
                </div>
            </div>
        </div>
    </div>

    {{-- Contact Information --}}
    <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-8 shadow-lg">
        <h2 class="text-xl font-bold text-[#f5f5f5] mb-6">
            Informations de contact
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="flex items-center gap-3">
                <svg class="w-5 h-5 text-[#00b6b4]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                <div>
                    <p class="text-sm text-[#9ca3af]">Email</p>
                    <p class="font-medium text-[#f5f5f5]">ahmed.belkacem@email.com</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <svg class="w-5 h-5 text-[#00b6b4]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                <div>
                    <p class="text-sm text-[#9ca3af]">Téléphone</p>
                    <p class="font-medium text-[#f5f5f5]">+213 XXX XXX XXX</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Experience --}}
    <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-8 shadow-lg">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-bold text-[#f5f5f5]">
                Expérience professionnelle
            </h2>
            <button id="addExperienceBtn" class="hidden bg-[#00b6b4] hover:bg-[#009999] text-white px-4 py-2 rounded-lg transition-colors flex items-center gap-2">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                Ajouter
            </button>
        </div>
        <div class="space-y-6">
            <div class="border-l-4 border-[#00b6b4] pl-6 relative">
                <button id="removeExpBtn" class="hidden absolute -left-2 top-0 w-6 h-6 bg-red-500 rounded-full flex items-center justify-center text-white hover:bg-red-600">
                    <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                </button>
                <div class="flex items-center gap-2 mb-2">
                    <svg class="w-5 h-5 text-[#00b6b4]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 20V4a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v16"/><rect width="8" height="6" x="8" y="6" rx="1"/></svg>
                    <h3 class="font-semibold text-[#f5f5f5]">Développeur Frontend</h3>
                </div>
                <p class="text-[#00b6b4] font-medium">TechCorp</p>
                <p class="text-sm text-[#9ca3af] mb-2">2022 - Présent</p>
                <p class="text-[#9ca3af]">Développement d'applications React et Vue.js</p>
            </div>
        </div>
    </div>

    {{-- Education --}}
    <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-8 shadow-lg">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-bold text-[#f5f5f5]">
                Formation
            </h2>
            <button id="addEducationBtn" class="hidden bg-[#00b6b4] hover:bg-[#009999] text-white px-4 py-2 rounded-lg transition-colors flex items-center gap-2">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                Ajouter
            </button>
        </div>
        <div class="space-y-6">
            <div class="border-l-4 border-[#009999] pl-6 relative">
                <button id="removeEduBtn" class="hidden absolute -left-2 top-0 w-6 h-6 bg-red-500 rounded-full flex items-center justify-center text-white hover:bg-red-600">
                    <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                </button>
                <div class="flex items-center gap-2 mb-2">
                    <svg class="w-5 h-5 text-[#009999]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
                    <h3 class="font-semibold text-[#f5f5f5]">Master en Informatique</h3>
                </div>
                <p class="text-[#009999] font-medium">Université d'Alger</p>
                <p class="text-sm text-[#9ca3af] mb-2">2020 - 2022</p>
                <p class="text-[#9ca3af]">Spécialisation en développement web</p>
            </div>
        </div>
    </div>

    {{-- Skills & Languages --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        {{-- Skills --}}
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-8 shadow-lg">
            <h2 class="text-xl font-bold text-[#f5f5f5] mb-6">
                Compétences
            </h2>
            <div class="flex flex-wrap gap-2">
                <span class="px-3 py-1 bg-[#00b6b4]/20 text-[#00b6b4] rounded-full text-sm font-medium flex items-center gap-2">
                    React
                    <button class="hidden text-red-500 hover:text-red-700">
                        <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6L6 18"/><path d="M6 6l12 12"/></svg>
                    </button>
                </span>
                <span class="px-3 py-1 bg-[#00b6b4]/20 text-[#00b6b4] rounded-full text-sm font-medium flex items-center gap-2">
                    TypeScript
                    <button class="hidden text-red-500 hover:text-red-700">
                        <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6L6 18"/><path d="M6 6l12 12"/></svg>
                    </button>
                </span>
                <span class="px-3 py-1 bg-[#00b6b4]/20 text-[#00b6b4] rounded-full text-sm font-medium flex items-center gap-2">
                    Node.js
                    <button class="hidden text-red-500 hover:text-red-700">
                        <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6L6 18"/><path d="M6 6l12 12"/></svg>
                    </button>
                </span>
                <span class="px-3 py-1 bg-[#00b6b4]/20 text-[#00b6b4] rounded-full text-sm font-medium flex items-center gap-2">
                    Python
                    <button class="hidden text-red-500 hover:text-red-700">
                        <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6L6 18"/><path d="M6 6l12 12"/></svg>
                    </button>
                </span>
                <span class="px-3 py-1 bg-[#00b6b4]/20 text-[#00b6b4] rounded-full text-sm font-medium flex items-center gap-2">
                    SQL
                    <button class="hidden text-red-500 hover:text-red-700">
                        <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6L6 18"/><path d="M6 6l12 12"/></svg>
                    </button>
                </span>
            </div>
        </div>

        {{-- Languages --}}
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-8 shadow-lg">
            <h2 class="text-xl font-bold text-[#f5f5f5] mb-6">
                Langues
            </h2>
            <div class="space-y-3">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-[#00b6b4]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M2 12h20"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                        <span class="font-medium text-[#f5f5f5]">Français</span>
                    </div>
                    <span class="text-sm text-[#9ca3af]">Natif</span>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-[#00b6b4]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M2 12h20"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                        <span class="font-medium text-[#f5f5f5]">Anglais</span>
                    </div>
                    <span class="text-sm text-[#9ca3af]">Avancé</span>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-[#00b6b4]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M2 12h20"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                        <span class="font-medium text-[#f5f5f5]">Arabe</span>
                    </div>
                    <span class="text-sm text-[#9ca3af]">Natif</span>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const editBtn = document.getElementById('editBtn');
    const cancelBtn = document.getElementById('cancelBtn');
    const saveBtn = document.getElementById('saveBtn');
    const addExperienceBtn = document.getElementById('addExperienceBtn');
    const addEducationBtn = document.getElementById('addEducationBtn');
    const removeExpBtn = document.getElementById('removeExpBtn');
    const removeEduBtn = document.getElementById('removeEduBtn');
    
    const inputs = document.querySelectorAll('input, textarea');
    const skillButtons = document.querySelectorAll('.bg-\\[\\#00b6b4\\]\\/20 button');
    
    let isEditing = false;
    
    function toggleEditMode() {
        isEditing = !isEditing;
        
        if (isEditing) {
            // Show edit mode
            editBtn.classList.add('hidden');
            cancelBtn.classList.remove('hidden');
            saveBtn.classList.remove('hidden');
            addExperienceBtn.classList.remove('hidden');
            addEducationBtn.classList.remove('hidden');
            removeExpBtn.classList.remove('hidden');
            removeEduBtn.classList.remove('hidden');
            
            // Enable inputs
            inputs.forEach(input => {
                input.removeAttribute('readonly');
                input.classList.remove('bg-[#333333]');
                input.classList.add('bg-[#2b2b2b]');
            });
            
            // Show skill delete buttons
            skillButtons.forEach(btn => {
                btn.classList.remove('hidden');
            });
        } else {
            // Show view mode
            editBtn.classList.remove('hidden');
            cancelBtn.classList.add('hidden');
            saveBtn.classList.add('hidden');
            addExperienceBtn.classList.add('hidden');
            addEducationBtn.classList.add('hidden');
            removeExpBtn.classList.add('hidden');
            removeEduBtn.classList.add('hidden');
            
            // Disable inputs
            inputs.forEach(input => {
                input.setAttribute('readonly', 'readonly');
                input.classList.add('bg-[#333333]');
                input.classList.remove('bg-[#2b2b2b]');
            });
            
            // Hide skill delete buttons
            skillButtons.forEach(btn => {
                btn.classList.add('hidden');
            });
        }
    }
    
    editBtn.addEventListener('click', toggleEditMode);
    cancelBtn.addEventListener('click', toggleEditMode);
    saveBtn.addEventListener('click', function() {
        // Here you would save the data
        alert('Profil sauvegardé avec succès!');
        toggleEditMode();
    });
    
    addExperienceBtn.addEventListener('click', function() {
        alert('Fonctionnalité d\'ajout d\'expérience sera implémentée');
    });
    
    addEducationBtn.addEventListener('click', function() {
        alert('Fonctionnalité d\'ajout de formation sera implémentée');
    });
    
    removeExpBtn.addEventListener('click', function() {
        if (confirm('Êtes-vous sûr de vouloir supprimer cette expérience?')) {
            alert('Expérience supprimée');
        }
    });
    
    removeEduBtn.addEventListener('click', function() {
        if (confirm('Êtes-vous sûr de vouloir supprimer cette formation?')) {
            alert('Formation supprimée');
        }
    });
});
</script>
@endsection
