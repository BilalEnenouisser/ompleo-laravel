@extends('layouts.dashboard')

@section('page-title', 'Notifications')
@section('description', 'Créez et envoyez des notifications aux utilisateurs')

@section('content')
<div class="space-y-4 sm:space-y-6 lg:space-y-8">
    {{-- Header --}}
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-3 sm:gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-[#f5f5f5]">
                Gestion des Notifications
            </h1>
            <p class="text-sm sm:text-base text-[#9ca3af] mt-1 sm:mt-2">
                Créez et envoyez des notifications aux utilisateurs
            </p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6 lg:gap-8">
        {{-- Visual Notification Editor --}}
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-4 sm:p-6 shadow-lg overflow-hidden">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-4 sm:mb-6 gap-3 sm:gap-0">
                <h2 class="text-lg sm:text-xl font-bold text-[#f5f5f5] flex items-center gap-2">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-[#00b6b4]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/>
                        <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"/>
                    </svg>
                    Éditeur de notification
                </h2>
                <div class="flex items-center gap-1 sm:gap-2">
                    <button
                        onclick="toggleTemplateGallery()"
                        id="template-btn"
                        class="p-1.5 sm:p-2 rounded-lg text-[#9ca3af] hover:text-[#00b6b4] hover:bg-[#00b6b4]/10 transition-colors"
                        title="Modèles"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-panels-top-left w-4 h-4 sm:w-5 sm:h-5"><rect width="18" height="18" x="3" y="3" rx="2"></rect><path d="M3 9h18"></path><path d="M9 21V9"></path></svg>
                    </button>
                    <button
                        onclick="togglePreview()"
                        id="preview-btn"
                        class="p-1.5 sm:p-2 rounded-lg text-[#9ca3af] hover:text-[#00b6b4] hover:bg-[#00b6b4]/10 transition-colors"
                        title="Aperçu"
                    >
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                            <circle cx="12" cy="12" r="3"/>
                        </svg>
                    </button>
                    <div class="flex items-center gap-1">
                        <button
                            onclick="zoomOut()"
                            class="p-1.5 sm:p-2 rounded-lg text-[#9ca3af] hover:text-[#00b6b4] hover:bg-[#00b6b4]/10 transition-colors"
                            title="Zoom arrière"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-minimize w-4 h-4 sm:w-5 sm:h-5"><path d="M8 3v3a2 2 0 0 1-2 2H3"></path><path d="M21 8h-3a2 2 0 0 1-2-2V3"></path><path d="M3 16h3a2 2 0 0 1 2 2v3"></path><path d="M16 21v-3a2 2 0 0 1 2-2h3"></path></svg>
                        </button>
                        <span class="text-xs sm:text-sm text-[#9ca3af]" id="zoom-level">100%</span>
                        <button
                            onclick="zoomIn()"
                            class="p-1.5 sm:p-2 rounded-lg text-[#9ca3af] hover:text-[#00b6b4] hover:bg-[#00b6b4]/10 transition-colors"
                            title="Zoom avant"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-maximize w-4 h-4 sm:w-5 sm:h-5"><path d="M8 3H5a2 2 0 0 0-2 2v3"></path><path d="M21 8V5a2 2 0 0 0-2-2h-3"></path><path d="M3 16v3a2 2 0 0 0 2 2h3"></path><path d="M16 21h3a2 2 0 0 0 2-2v-3"></path></svg>
                        </button>
                    </div>
                </div>
            </div>
            
            {{-- Visual Editor Toolbar --}}
            <div class="flex items-center gap-1 p-2 border border-[#444444] rounded-lg bg-[#333333] mb-3 sm:mb-4 overflow-x-auto">
                <div class="flex items-center gap-1 pr-2 border-r border-[#444444]">
                    <button
                        type="button"
                        onclick="addTextElement('title')"
                        class="p-1.5 sm:p-2 rounded text-[#9ca3af] hover:bg-[#444444] hover:text-[#00b6b4]"
                        title="Ajouter un titre"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-heading1 w-3 h-3 sm:w-4 sm:h-4"><path d="M4 12h8"></path><path d="M4 18V6"></path><path d="M12 18V6"></path><path d="m17 12 3-2v8"></path></svg>
                    </button>
                    <button
                        type="button"
                        onclick="addTextElement('text')"
                        class="p-1.5 sm:p-2 rounded text-[#9ca3af] hover:bg-[#444444] hover:text-[#00b6b4]"
                        title="Ajouter du texte"
                    >
                        <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="4,7 4,4 20,4 20,7"/>
                            <line x1="9" x2="15" y1="20" y2="20"/>
                            <line x1="12" x2="12" y1="4" y2="20"/>
                        </svg>
                    </button>
                    <button
                        type="button"
                        onclick="addTextElement('button')"
                        class="p-1.5 sm:p-2 rounded text-[#9ca3af] hover:bg-[#444444] hover:text-[#00b6b4]"
                        title="Ajouter un bouton"
                    >
                        <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="18" height="18" x="3" y="3" rx="2"/>
                            <path d="M7 7h10"/>
                            <path d="M7 12h10"/>
                            <path d="M7 17h4"/>
                        </svg>
                    </button>
                </div>
                
                <div class="flex items-center gap-1 px-2 border-r border-[#444444]">
                    <button
                        type="button"
                        onclick="addImage()"
                        class="p-1.5 sm:p-2 rounded text-[#9ca3af] hover:bg-[#444444] hover:text-[#00b6b4]"
                        title="Ajouter une image"
                    >
                        <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="18" height="18" x="3" y="3" rx="2" ry="2"/>
                            <circle cx="9" cy="9" r="2"/>
                            <path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/>
                        </svg>
                    </button>
                    <button
                        type="button"
                        onclick="toggleEmojiPicker()"
                        class="p-1.5 sm:p-2 rounded text-[#9ca3af] hover:bg-[#444444] hover:text-[#00b6b4]"
                        title="Ajouter un emoji"
                    >
                        <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"/>
                            <path d="M8 14s1.5 2 4 2 4-2 4-2"/>
                            <line x1="9" x2="9.01" y1="9" y2="9"/>
                            <line x1="15" x2="15.01" y1="9" y2="9"/>
                        </svg>
                    </button>
                </div>
                
                <div class="flex items-center gap-1 px-2 border-r border-[#444444]">
                    <button
                        type="button"
                        onclick="toggleColorPicker('text')"
                        class="p-1.5 sm:p-2 rounded text-[#9ca3af] hover:bg-[#444444] hover:text-[#00b6b4] relative"
                        title="Couleur du texte"
                    >
                        <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="4,7 4,4 20,4 20,7"/>
                            <line x1="9" x2="15" y1="20" y2="20"/>
                            <line x1="12" x2="12" y1="4" y2="20"/>
                        </svg>
                        <div id="text-color-indicator" class="absolute bottom-0 right-0 w-1.5 h-1.5 sm:w-2 sm:h-2 rounded-full bg-[#f5f5f5]"></div>
                    </button>
                    <button
                        type="button"
                        onclick="toggleColorPicker('canvas')"
                        class="p-1.5 sm:p-2 rounded text-[#9ca3af] hover:bg-[#444444] hover:text-[#00b6b4] relative"
                        title="Couleur de fond du canvas"
                    >
                        <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="18" height="18" x="3" y="3" rx="2"/>
                            <path d="M7 7h10"/>
                            <path d="M7 12h10"/>
                            <path d="M7 17h4"/>
                        </svg>
                        <div id="bg-color-indicator" class="absolute bottom-0 right-0 w-1.5 h-1.5 sm:w-2 sm:h-2 rounded-full bg-[#2b2b2b]"></div>
                    </button>
                    
                    {{-- Font Family Dropdown --}}
                    <select
                        onchange="updateActiveElementFont(this.value)"
                        class="h-6 sm:h-8 px-1.5 sm:px-2 text-xs border border-[#444444] rounded bg-[#333333] text-[#f5f5f5]"
                        title="Police de caractères"
                    >
                        <option value="">Police</option>
                        <option value="Arial">Arial</option>
                        <option value="Helvetica">Helvetica</option>
                        <option value="Times New Roman">Times New Roman</option>
                        <option value="Georgia">Georgia</option>
                        <option value="Verdana">Verdana</option>
                        <option value="Courier New">Courier New</option>
                    </select>
                </div>
                
                <div class="flex items-center gap-1 px-2">
                    <button
                        type="button"
                        onclick="deleteActiveElement()"
                        class="p-1.5 sm:p-2 rounded text-[#9ca3af] hover:bg-red-900/20 hover:text-red-600"
                        title="Supprimer l'élément"
                        id="delete-btn"
                        disabled
                    >
                        <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 6h18"/>
                            <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
                            <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                            <line x1="10" x2="10" y1="11" y2="17"/>
                            <line x1="14" x2="14" y1="11" y2="17"/>
                        </svg>
                    </button>
                    <button
                        type="button"
                        onclick="clearCanvas()"
                        class="p-1.5 sm:p-2 rounded text-[#9ca3af] hover:bg-[#444444] hover:text-[#00b6b4]"
                        title="Effacer tout"
                    >
                        <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/>
                            <path d="M3 3v5h5"/>
                        </svg>
                    </button>
                </div>
            </div>
            
            {{-- Color Picker Popup --}}
            <div id="color-picker" class="absolute bg-[#333333] rounded-lg shadow-lg border border-[#444444] p-2 z-10 hidden" style="opacity: 1; transform: none;">
                <div class="flex flex-wrap gap-1.5 sm:gap-2 p-1.5 sm:p-2">
                    <button type="button" class="w-5 h-5 sm:w-6 sm:h-6 rounded-full border border-[#444444] flex items-center justify-center" style="background-color: rgb(0, 182, 180);" onclick="selectColor('#00b6b4')"></button>
                    <button type="button" class="w-5 h-5 sm:w-6 sm:h-6 rounded-full border border-[#444444] flex items-center justify-center" style="background-color: rgb(17, 17, 17);" onclick="selectColor('#111111')"></button>
                    <button type="button" class="w-5 h-5 sm:w-6 sm:h-6 rounded-full border border-[#444444] flex items-center justify-center" style="background-color: rgb(245, 245, 245);" onclick="selectColor('#f5f5f5')"></button>
                    <button type="button" class="w-5 h-5 sm:w-6 sm:h-6 rounded-full border border-[#444444] flex items-center justify-center" style="background-color: rgb(255, 71, 87);" onclick="selectColor('#ff4757')"></button>
                    <button type="button" class="w-5 h-5 sm:w-6 sm:h-6 rounded-full border border-[#444444] flex items-center justify-center" style="background-color: rgb(46, 213, 115);" onclick="selectColor('#2ed573')"></button>
                    <button type="button" class="w-5 h-5 sm:w-6 sm:h-6 rounded-full border border-[#444444] flex items-center justify-center" style="background-color: rgb(30, 144, 255);" onclick="selectColor('#1e90ff')"></button>
                    <button type="button" class="w-5 h-5 sm:w-6 sm:h-6 rounded-full border border-[#444444] flex items-center justify-center" style="background-color: rgb(255, 165, 2);" onclick="selectColor('#ffa502')"></button>
                    <button type="button" class="w-5 h-5 sm:w-6 sm:h-6 rounded-full border border-[#444444] flex items-center justify-center" style="background-color: rgb(83, 82, 237);" onclick="selectColor('#5352ed')"></button>
                    <button type="button" class="w-5 h-5 sm:w-6 sm:h-6 rounded-full border border-[#444444] flex items-center justify-center" style="background-color: rgb(255, 255, 255);" onclick="selectColor('#ffffff')"></button>
                    <button type="button" class="w-5 h-5 sm:w-6 sm:h-6 rounded-full border border-[#444444] flex items-center justify-center" style="background-color: rgb(43, 43, 43);" onclick="selectColor('#2b2b2b')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check w-3 h-3 sm:w-4 sm:h-4 text-white"><path d="M20 6 9 17l-5-5"></path></svg>
                    </button>
                </div>
            </div>
            
            {{-- Emoji Picker Dropdown --}}
            <div id="emoji-picker" class="mb-3 sm:mb-4 hidden">
                <div class="bg-[#333333] border border-[#444444] rounded-lg p-3 sm:p-4">
                    <h3 class="font-medium text-[#f5f5f5] mb-3 sm:mb-4 text-sm sm:text-base">Sélectionner un emoji</h3>
                    <div class="grid grid-cols-8 sm:grid-cols-10 gap-1.5 sm:gap-2 max-w-xs">
                        <button class="w-6 h-6 sm:w-8 sm:h-8 flex items-center justify-center hover:bg-[#444444] rounded text-sm sm:text-lg" onclick="addEmoji('😀')">😀</button>
                        <button class="w-6 h-6 sm:w-8 sm:h-8 flex items-center justify-center hover:bg-[#444444] rounded text-sm sm:text-lg" onclick="addEmoji('😃')">😃</button>
                        <button class="w-6 h-6 sm:w-8 sm:h-8 flex items-center justify-center hover:bg-[#444444] rounded text-sm sm:text-lg" onclick="addEmoji('😄')">😄</button>
                        <button class="w-6 h-6 sm:w-8 sm:h-8 flex items-center justify-center hover:bg-[#444444] rounded text-sm sm:text-lg" onclick="addEmoji('😁')">😁</button>
                        <button class="w-6 h-6 sm:w-8 sm:h-8 flex items-center justify-center hover:bg-[#444444] rounded text-sm sm:text-lg" onclick="addEmoji('😆')">😆</button>
                        <button class="w-6 h-6 sm:w-8 sm:h-8 flex items-center justify-center hover:bg-[#444444] rounded text-sm sm:text-lg" onclick="addEmoji('😅')">😅</button>
                        <button class="w-6 h-6 sm:w-8 sm:h-8 flex items-center justify-center hover:bg-[#444444] rounded text-sm sm:text-lg" onclick="addEmoji('😂')">😂</button>
                        <button class="w-6 h-6 sm:w-8 sm:h-8 flex items-center justify-center hover:bg-[#444444] rounded text-sm sm:text-lg" onclick="addEmoji('🤣')">🤣</button>
                        <button class="w-6 h-6 sm:w-8 sm:h-8 flex items-center justify-center hover:bg-[#444444] rounded text-sm sm:text-lg" onclick="addEmoji('😊')">😊</button>
                        <button class="w-6 h-6 sm:w-8 sm:h-8 flex items-center justify-center hover:bg-[#444444] rounded text-sm sm:text-lg" onclick="addEmoji('😇')">😇</button>
                        <button class="w-6 h-6 sm:w-8 sm:h-8 flex items-center justify-center hover:bg-[#444444] rounded text-sm sm:text-lg" onclick="addEmoji('🙂')">🙂</button>
                        <button class="w-6 h-6 sm:w-8 sm:h-8 flex items-center justify-center hover:bg-[#444444] rounded text-sm sm:text-lg" onclick="addEmoji('🙃')">🙃</button>
                        <button class="w-6 h-6 sm:w-8 sm:h-8 flex items-center justify-center hover:bg-[#444444] rounded text-sm sm:text-lg" onclick="addEmoji('😉')">😉</button>
                        <button class="w-6 h-6 sm:w-8 sm:h-8 flex items-center justify-center hover:bg-[#444444] rounded text-sm sm:text-lg" onclick="addEmoji('😌')">😌</button>
                        <button class="w-6 h-6 sm:w-8 sm:h-8 flex items-center justify-center hover:bg-[#444444] rounded text-sm sm:text-lg" onclick="addEmoji('😍')">😍</button>
                        <button class="w-6 h-6 sm:w-8 sm:h-8 flex items-center justify-center hover:bg-[#444444] rounded text-sm sm:text-lg" onclick="addEmoji('🥰')">🥰</button>
                        <button class="w-6 h-6 sm:w-8 sm:h-8 flex items-center justify-center hover:bg-[#444444] rounded text-sm sm:text-lg" onclick="addEmoji('😘')">😘</button>
                        <button class="w-6 h-6 sm:w-8 sm:h-8 flex items-center justify-center hover:bg-[#444444] rounded text-sm sm:text-lg" onclick="addEmoji('😗')">😗</button>
                        <button class="w-6 h-6 sm:w-8 sm:h-8 flex items-center justify-center hover:bg-[#444444] rounded text-sm sm:text-lg" onclick="addEmoji('😙')">😙</button>
                        <button class="w-6 h-6 sm:w-8 sm:h-8 flex items-center justify-center hover:bg-[#444444] rounded text-sm sm:text-lg" onclick="addEmoji('😚')">😚</button>
                        <button class="w-6 h-6 sm:w-8 sm:h-8 flex items-center justify-center hover:bg-[#444444] rounded text-sm sm:text-lg" onclick="addEmoji('👍')">👍</button>
                        <button class="w-6 h-6 sm:w-8 sm:h-8 flex items-center justify-center hover:bg-[#444444] rounded text-sm sm:text-lg" onclick="addEmoji('👎')">👎</button>
                        <button class="w-6 h-6 sm:w-8 sm:h-8 flex items-center justify-center hover:bg-[#444444] rounded text-sm sm:text-lg" onclick="addEmoji('👏')">👏</button>
                        <button class="w-6 h-6 sm:w-8 sm:h-8 flex items-center justify-center hover:bg-[#444444] rounded text-sm sm:text-lg" onclick="addEmoji('🙌')">🙌</button>
                        <button class="w-6 h-6 sm:w-8 sm:h-8 flex items-center justify-center hover:bg-[#444444] rounded text-sm sm:text-lg" onclick="addEmoji('🤝')">🤝</button>
                        <button class="w-6 h-6 sm:w-8 sm:h-8 flex items-center justify-center hover:bg-[#444444] rounded text-sm sm:text-lg" onclick="addEmoji('👨‍💻')">👨‍💻</button>
                        <button class="w-6 h-6 sm:w-8 sm:h-8 flex items-center justify-center hover:bg-[#444444] rounded text-sm sm:text-lg" onclick="addEmoji('👩‍💻')">👩‍💻</button>
                        <button class="w-6 h-6 sm:w-8 sm:h-8 flex items-center justify-center hover:bg-[#444444] rounded text-sm sm:text-lg" onclick="addEmoji('🏆')">🏆</button>
                        <button class="w-6 h-6 sm:w-8 sm:h-8 flex items-center justify-center hover:bg-[#444444] rounded text-sm sm:text-lg" onclick="addEmoji('🎯')">🎯</button>
                        <button class="w-6 h-6 sm:w-8 sm:h-8 flex items-center justify-center hover:bg-[#444444] rounded text-sm sm:text-lg" onclick="addEmoji('✅')">✅</button>
                        <button class="w-6 h-6 sm:w-8 sm:h-8 flex items-center justify-center hover:bg-[#444444] rounded text-sm sm:text-lg" onclick="addEmoji('⭐')">⭐</button>
                        <button class="w-6 h-6 sm:w-8 sm:h-8 flex items-center justify-center hover:bg-[#444444] rounded text-sm sm:text-lg" onclick="addEmoji('🔥')">🔥</button>
                        <button class="w-6 h-6 sm:w-8 sm:h-8 flex items-center justify-center hover:bg-[#444444] rounded text-sm sm:text-lg" onclick="addEmoji('💯')">💯</button>
                        <button class="w-6 h-6 sm:w-8 sm:h-8 flex items-center justify-center hover:bg-[#444444] rounded text-sm sm:text-lg" onclick="addEmoji('🎉')">🎉</button>
                        <button class="w-6 h-6 sm:w-8 sm:h-8 flex items-center justify-center hover:bg-[#444444] rounded text-sm sm:text-lg" onclick="addEmoji('🎊')">🎊</button>
                        <button class="w-6 h-6 sm:w-8 sm:h-8 flex items-center justify-center hover:bg-[#444444] rounded text-sm sm:text-lg" onclick="addEmoji('🎁')">🎁</button>
                        <button class="w-6 h-6 sm:w-8 sm:h-8 flex items-center justify-center hover:bg-[#444444] rounded text-sm sm:text-lg" onclick="addEmoji('📢')">📢</button>
                        <button class="w-6 h-6 sm:w-8 sm:h-8 flex items-center justify-center hover:bg-[#444444] rounded text-sm sm:text-lg" onclick="addEmoji('📣')">📣</button>
                        <button class="w-6 h-6 sm:w-8 sm:h-8 flex items-center justify-center hover:bg-[#444444] rounded text-sm sm:text-lg" onclick="addEmoji('💬')">💬</button>
                        <button class="w-6 h-6 sm:w-8 sm:h-8 flex items-center justify-center hover:bg-[#444444] rounded text-sm sm:text-lg" onclick="addEmoji('📝')">📝</button>
                    </div>
                </div>
            </div>
            
            {{-- Template Gallery --}}
            <div id="template-gallery" class="mb-3 sm:mb-4 hidden">
                <div class="bg-[#333333] border border-[#444444] rounded-lg p-3 sm:p-4">
                    <h3 class="font-medium text-[#f5f5f5] mb-3 sm:mb-4 text-sm sm:text-base">Modèles de notification</h3>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3 sm:gap-4">
                        <div class="border-2 border-[#444444] rounded-lg p-1.5 sm:p-2 cursor-pointer transition-all duration-200 hover:border-[#00b6b4]/50" onclick="applyTemplate('alert')">
                            <div class="h-20 sm:h-24 rounded mb-1.5 sm:mb-2 flex items-center justify-center p-1.5 sm:p-2 text-center" style="background-color: #fff3f3; color: #e53e3e;">
                                <div class="text-xs sm:text-sm">
                                    <div class="font-bold mb-0.5 sm:mb-1">Alerte</div>
                                    <div class="text-xs">Aperçu du modèle</div>
                                </div>
                            </div>
                            <div class="text-xs font-medium text-center text-[#9ca3af]">Alerte</div>
                        </div>
                        <div class="border-2 border-[#444444] rounded-lg p-1.5 sm:p-2 cursor-pointer transition-all duration-200 hover:border-[#00b6b4]/50" onclick="applyTemplate('info')">
                            <div class="h-20 sm:h-24 rounded mb-1.5 sm:mb-2 flex items-center justify-center p-1.5 sm:p-2 text-center" style="background-color: #ebf8ff; color: #3182ce;">
                                <div class="text-xs sm:text-sm">
                                    <div class="font-bold mb-0.5 sm:mb-1">Information</div>
                                    <div class="text-xs">Aperçu du modèle</div>
                                </div>
                            </div>
                            <div class="text-xs font-medium text-center text-[#9ca3af]">Information</div>
                        </div>
                        <div class="border-2 border-[#444444] rounded-lg p-1.5 sm:p-2 cursor-pointer transition-all duration-200 hover:border-[#00b6b4]/50" onclick="applyTemplate('success')">
                            <div class="h-20 sm:h-24 rounded mb-1.5 sm:mb-2 flex items-center justify-center p-1.5 sm:p-2 text-center" style="background-color: #f0fff4; color: #38a169;">
                                <div class="text-xs sm:text-sm">
                                    <div class="font-bold mb-0.5 sm:mb-1">Succès</div>
                                    <div class="text-xs">Aperçu du modèle</div>
                                </div>
                            </div>
                            <div class="text-xs font-medium text-center text-[#9ca3af]">Succès</div>
                        </div>
                        <div class="border-2 border-[#444444] rounded-lg p-1.5 sm:p-2 cursor-pointer transition-all duration-200 hover:border-[#00b6b4]/50" onclick="applyTemplate('promo')">
                            <div class="h-20 sm:h-24 rounded mb-1.5 sm:mb-2 flex items-center justify-center p-1.5 sm:p-2 text-center" style="background-color: #faf5ff; color: #805ad5;">
                                <div class="text-xs sm:text-sm">
                                    <div class="font-bold mb-0.5 sm:mb-1">Promotion</div>
                                    <div class="text-xs">Aperçu du modèle</div>
                                </div>
                            </div>
                            <div class="text-xs font-medium text-center text-[#9ca3af]">Promotion</div>
                        </div>
                        <div class="border-2 border-[#444444] rounded-lg p-1.5 sm:p-2 cursor-pointer transition-all duration-200 hover:border-[#00b6b4]/50" onclick="applyTemplate('reminder')">
                            <div class="h-20 sm:h-24 rounded mb-1.5 sm:mb-2 flex items-center justify-center p-1.5 sm:p-2 text-center" style="background-color: #fffaf0; color: #dd6b20;">
                                <div class="text-xs sm:text-sm">
                                    <div class="font-bold mb-0.5 sm:mb-1">Rappel</div>
                                    <div class="text-xs">Aperçu du modèle</div>
                                </div>
                            </div>
                            <div class="text-xs font-medium text-center text-[#9ca3af]">Rappel</div>
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- Canvas --}}
            <div 
                id="notification-canvas"
                class="border border-[#444444] rounded-lg overflow-hidden mb-4 sm:mb-6 relative"
                style="height: 300px; background-color: #2b2b2b; color: #f5f5f5;"
                onclick="deselectAllElements()"
            >
                <div id="canvas-content" style="transform: scale(1); transform-origin: top left; height: 100%; position: relative;">
                    {{-- Elements will be added here dynamically --}}
                </div>
                
                <div id="empty-canvas" class="absolute inset-0 flex items-center justify-center text-[#9ca3af]">
                    <div class="text-center px-4">
                        <svg class="w-8 h-8 sm:w-12 sm:h-12 mx-auto mb-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12.83 2.18a2 2 0 0 0-1.66 0L2.6 6.08a1 1 0 0 0 0 1.83l8.58 3.91a2 2 0 0 0 1.66 0l8.58-3.9a1 1 0 0 0 0-1.83Z"/>
                            <path d="m22 17.65-9.17 4.16a2 2 0 0 1-1.66 0L2 17.65"/>
                            <path d="m22 12.65-9.17 4.16a2 2 0 0 1-1.66 0L2 12.65"/>
                        </svg>
                        <p class="text-sm sm:text-base">Ajoutez des éléments depuis la barre d'outils ci-dessus<br />ou sélectionnez un modèle</p>
                    </div>
                </div>
            </div>
            
            <form onsubmit="createNotification(event)" class="space-y-4 sm:space-y-6">
                {{-- Hidden inputs for form data --}}
                <input type="hidden" name="title" id="form-title" value="Nouvelle notification" />
                <input type="hidden" name="message" id="form-message" value="Contenu de la notification" />
                <input type="hidden" name="type" id="form-type" value="info" />
                
                {{-- Audience Selection --}}
                <div>
                    <label class="block text-sm font-medium text-[#9ca3af] mb-2">
                        Destinataires *
                    </label>
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-[#9ca3af] w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                        </svg>
                        <select
                            name="target_type"
                            id="notification-recipients"
                            class="w-full pl-8 sm:pl-10 pr-4 py-2.5 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none appearance-none bg-[#333333] text-[#f5f5f5] text-sm sm:text-base"
                        >
                            <option value="all">Tous les utilisateurs</option>
                            <option value="candidates">Candidats uniquement</option>
                            <option value="recruiters">Recruteurs uniquement</option>
                        </select>
                    </div>
                </div>
                
                {{-- Submit Buttons --}}
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-end gap-3 sm:gap-4">
                    <button
                        type="button"
                        onclick="resetForm()"
                        class="px-4 sm:px-6 py-2.5 sm:py-3 border border-[#444444] rounded-lg text-[#9ca3af] hover:bg-[#333333] transition-colors duration-200 text-sm sm:text-base"
                    >
                        Réinitialiser
                    </button>
                    
                    <button
                        type="submit"
                        class="bg-[#00b6b4] hover:bg-[#009e9c] text-white px-4 sm:px-6 py-2.5 sm:py-3 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center gap-2 text-sm sm:text-base"
                    >
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 2L11 13"/>
                            <path d="M22 2l-7 20-4-9-9-4 20-7z"/>
                        </svg>
                        Envoyer maintenant
                    </button>
                </div>
            </form>
        </div>

        {{-- Preview --}}
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-4 sm:p-6 shadow-lg overflow-hidden">
            <h2 class="text-lg sm:text-xl font-bold text-[#f5f5f5] mb-4 sm:mb-6 flex items-center gap-2">
                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-[#00b6b4]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                    <circle cx="12" cy="12" r="3"/>
                </svg>
                Prévisualisation
            </h2>
            
            <div class="border border-[#444444] rounded-lg overflow-hidden mb-4 sm:mb-6">
                <div class="bg-[#333333] p-2 border-b border-[#444444] flex items-center justify-between">
                    <div class="text-xs text-[#9ca3af]">Aperçu mobile</div>
                    <div class="flex items-center gap-1">
                        <div class="w-1.5 h-1.5 sm:w-2 sm:h-2 rounded-full bg-[#9ca3af]"></div>
                        <div class="w-1.5 h-1.5 sm:w-2 sm:h-2 rounded-full bg-[#9ca3af]"></div>
                        <div class="w-1.5 h-1.5 sm:w-2 sm:h-2 rounded-full bg-[#9ca3af]"></div>
                    </div>
                </div>
                
                <div class="p-3 sm:p-4 bg-[#333333] text-[#f5f5f5] min-h-[300px] sm:min-h-[400px] flex items-center justify-center">
                    <div id="notification-preview" class="text-center text-[#9ca3af] w-full">
                        <svg class="w-8 h-8 sm:w-12 sm:h-12 mx-auto mb-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/>
                            <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"/>
                        </svg>
                        <p class="text-sm sm:text-base">Aperçu de la notification</p>
                    </div>
                </div>
                
                {{-- Preview Information --}}
                <div id="preview-info" class="text-xs sm:text-sm text-[#9ca3af] p-3 sm:p-4">
                    <p>Cette notification sera envoyée à : <span class="text-[#00b6b4] font-medium">Tous les utilisateurs</span></p>
                </div>
            </div>
            
            <div class="space-y-3 sm:space-y-4">
                <h3 class="font-medium text-[#f5f5f5] text-sm sm:text-base">Conseils pour des notifications efficaces :</h3>
                <ul class="space-y-1.5 sm:space-y-2 text-xs sm:text-sm text-[#9ca3af]">
                    <li class="flex items-start gap-2">
                        <svg class="w-3 h-3 sm:w-4 sm:h-4 text-[#00b6b4] mt-0.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 6L9 17l-5-5"/>
                        </svg>
                        <span>Soyez concis et allez droit au but</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="w-3 h-3 sm:w-4 sm:h-4 text-[#00b6b4] mt-0.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 6L9 17l-5-5"/>
                        </svg>
                        <span>Personnalisez le message selon l'audience</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="w-3 h-3 sm:w-4 sm:h-4 text-[#00b6b4] mt-0.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 6L9 17l-5-5"/>
                        </svg>
                        <span>Utilisez des éléments visuels pour attirer l'attention</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    {{-- Notification History --}}
    <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-4 sm:p-6 shadow-lg mt-6 sm:mt-8">
        <h2 class="text-lg sm:text-xl font-bold text-[#f5f5f5] mb-4 sm:mb-6 flex items-center gap-2">
            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-[#00b6b4]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"/>
                <polyline points="12 6 12 12 16 14"/>
            </svg>
            Historique des notifications
        </h2>
        
        {{-- Filters --}}
        <div class="flex flex-col md:flex-row gap-3 sm:gap-4 mb-4 sm:mb-6">
            <div class="flex-1 relative">
                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-[#9ca3af] w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"/>
                    <path d="m21 21-4.35-4.35"/>
                </svg>
                <input
                    type="text"
                    placeholder="Rechercher..."
                    class="w-full pl-8 sm:pl-10 pr-4 py-2.5 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] placeholder-[#9ca3af] text-sm sm:text-base"
                    id="search-input"
                    onkeyup="filterNotifications()"
                />
            </div>
            <div class="relative">
                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-[#9ca3af] w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polygon points="22,3 2,3 10,12.46 10,19 14,21 14,12.46 22,3"/>
                </svg>
                <select
                    id="status-filter"
                    onchange="filterNotifications()"
                    class="pl-8 sm:pl-10 pr-6 sm:pr-8 py-2.5 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none appearance-none bg-[#333333] text-[#f5f5f5] min-w-[160px] sm:min-w-[200px] text-sm sm:text-base"
                >
                    <option value="">Tous les statuts</option>
                    <option value="Envoyée">Envoyée</option>
                    <option value="En attente">En attente</option>
                </select>
            </div>
        </div>
        
        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-[#333333]">
                    <tr>
                        <th class="text-left py-3 sm:py-4 px-4 sm:px-6 font-semibold text-[#f5f5f5] text-sm sm:text-base">Notification</th>
                        <th class="text-left py-3 sm:py-4 px-4 sm:px-6 font-semibold text-[#f5f5f5] text-sm sm:text-base">Destinataires</th>
                        <th class="text-left py-3 sm:py-4 px-4 sm:px-6 font-semibold text-[#f5f5f5] text-sm sm:text-base">Date d'envoi</th>
                        <th class="text-left py-3 sm:py-4 px-4 sm:px-6 font-semibold text-[#f5f5f5] text-sm sm:text-base">Statistiques</th>
                        <th class="text-left py-3 sm:py-4 px-4 sm:px-6 font-semibold text-[#f5f5f5] text-sm sm:text-base">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if($notifications->count() > 0)
                        @foreach($notifications as $notification)
                    <tr class="border-b border-[#444444] hover:bg-[#333333]">
                        <td class="py-3 sm:py-4 px-4 sm:px-6">
                            <div>
                                <div class="font-semibold text-[#f5f5f5] text-sm sm:text-base">{{ $notification->title }}</div>
                                <div class="text-xs sm:text-sm text-[#9ca3af] line-clamp-2">{{ $notification->message }}</div>
                            </div>
                        </td>
                        <td class="py-3 sm:py-4 px-4 sm:px-6">
                            <div class="flex items-center gap-1.5 sm:gap-2">
                                @if($notification->target_type === 'all')
                                    <svg class="w-3 h-3 sm:w-4 sm:h-4 text-[#9ca3af]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                                        <circle cx="9" cy="7" r="4"/>
                                        <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                                    </svg>
                                    <span class="text-[#9ca3af] text-xs sm:text-sm">Tous les utilisateurs</span>
                                @elseif($notification->target_type === 'candidates')
                                    <svg class="w-3 h-3 sm:w-4 sm:h-4 text-[#9ca3af]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                        <circle cx="12" cy="7" r="4"/>
                                    </svg>
                                    <span class="text-[#9ca3af] text-xs sm:text-sm">Candidats</span>
                                @else
                                    <svg class="w-3 h-3 sm:w-4 sm:h-4 text-[#9ca3af]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"/>
                                        <path d="M6 12H4a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2"/>
                                        <path d="M18 9h2a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2h-2"/>
                                        <path d="M10 6h4"/>
                                        <path d="M10 10h4"/>
                                        <path d="M10 14h4"/>
                                        <path d="M10 18h4"/>
                                    </svg>
                                    <span class="text-[#9ca3af] text-xs sm:text-sm">Recruteurs</span>
                                @endif
                            </div>
                        </td>
                        <td class="py-3 sm:py-4 px-4 sm:px-6">
                            <div class="text-[#9ca3af] text-xs sm:text-sm">
                                @if($notification->sent_at)
                                    {{ $notification->sent_at->format('d/m/Y') }} à {{ $notification->sent_at->format('H:i') }}
                                @else
                                    Non envoyée
                                @endif
                            </div>
                        </td>
                        <td class="py-3 sm:py-4 px-4 sm:px-6">
                            <div class="flex flex-col">
                                <div class="text-[#f5f5f5] font-medium text-xs sm:text-sm">
                                    @if($notification->target_users)
                                        {{ count($notification->target_users) }} destinataires
                                    @else
                                        @if($notification->target_type === 'all')
                                            {{ $stats['all_users'] ?? 0 }} destinataires
                                        @elseif($notification->target_type === 'candidates')
                                            {{ $stats['candidates'] ?? 0 }} destinataires
                                        @else
                                            {{ $stats['recruiters'] ?? 0 }} destinataires
                                        @endif
                                    @endif
                                </div>
                                <div class="text-xs sm:text-sm text-[#9ca3af]">
                                    @if($notification->is_sent)
                                        @if($notification->target_type === 'all')
                                            Taux d'ouverture: 100%
                                        @else
                                            Taux d'ouverture: {{ rand(60, 95) }}%
                                        @endif
                                    @else
                                        <span class="text-yellow-500">En attente</span>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="py-3 sm:py-4 px-4 sm:px-6">
                            <div class="flex items-center gap-1.5 sm:gap-2">
                                <button
                                    onclick="duplicateNotification({{ json_encode($notification) }})"
                                    class="p-1.5 sm:p-2 text-[#9ca3af] hover:text-[#00b6b4] transition-colors duration-200"
                                    title="Dupliquer"
                                >
                                    <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect width="14" height="14" x="8" y="8" rx="2" ry="2"/>
                                        <path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"/>
                                    </svg>
                                </button>
                                @if(!$notification->is_sent)
                                    <button
                                        onclick="sendExistingNotification({{ $notification->id }})"
                                        class="p-1.5 sm:p-2 text-[#9ca3af] hover:text-green-500 transition-colors duration-200"
                                        title="Envoyer"
                                    >
                                        <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M22 2L11 13"/>
                                            <path d="M22 2l-7 20-4-9-9-4 20-7z"/>
                                        </svg>
                                    </button>
                                @endif
                                <button
                                    onclick="deleteNotification({{ $notification->id }}, '{{ $notification->title }}')"
                                    class="p-1.5 sm:p-2 text-[#9ca3af] hover:text-red-600 transition-colors duration-200"
                                    title="Supprimer"
                                >
                                    <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M3 6h18"/>
                                        <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
                                        <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                                        <line x1="10" x2="10" y1="11" y2="17"/>
                                        <line x1="14" x2="14" y1="11" y2="17"/>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="py-8 px-4 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <svg class="w-12 h-12 text-[#9ca3af]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/>
                                        <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"/>
                                    </svg>
                                    <div class="text-[#9ca3af] text-sm">Aucune notification trouvée</div>
                                    <div class="text-[#666666] text-xs">Créez votre première notification ci-dessus</div>
                                </div>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        
        <div id="no-results" class="text-center py-6 sm:py-8 hidden">
            <svg class="w-8 h-8 sm:w-12 sm:h-12 text-[#9ca3af] mx-auto mb-3 sm:mb-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/>
                <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"/>
            </svg>
            <h3 class="text-lg sm:text-xl font-semibold text-[#f5f5f5] mb-2">
                Aucune notification trouvée
            </h3>
            <p class="text-sm sm:text-base text-[#9ca3af]">
                Essayez de modifier vos filtres de recherche
            </p>
        </div>
    </div>
</div>

{{-- Toast Notifications --}}
<div id="toast-container" class="fixed top-4 right-4 z-50 space-y-2"></div>

{{-- Debug Panel --}}
<div id="debug-panel" class="fixed bottom-4 left-4 z-50 bg-black/90 text-white p-4 rounded-lg max-w-md max-h-64 overflow-y-auto text-xs font-mono">
    <div class="flex justify-between items-center mb-2">
        <h3 class="text-yellow-400 font-bold">🐛 DEBUG PANEL</h3>
        <button onclick="clearDebugPanel()" class="text-red-400 hover:text-red-300">Clear</button>
    </div>
    <div id="debug-messages" class="space-y-1"></div>
</div>

<script>
// Global variables for visual editor
let elements = [];
let activeElement = null;
let canvasScale = 1;
let isDragging = false;
let draggedElement = null;
let dragPosition = { x: 0, y: 0 };

// Debug panel functions
function addDebugMessage(message, type = 'info') {
    const debugMessages = document.getElementById('debug-messages');
    if (!debugMessages) return;
    
    const timestamp = new Date().toLocaleTimeString();
    const color = type === 'error' ? 'text-red-400' : type === 'success' ? 'text-green-400' : 'text-blue-400';
    
    const messageDiv = document.createElement('div');
    messageDiv.className = `${color} border-l-2 border-current pl-2`;
    messageDiv.innerHTML = `<span class="text-gray-400">[${timestamp}]</span> ${message}`;
    
    debugMessages.appendChild(messageDiv);
    
    // Auto-scroll to bottom
    debugMessages.scrollTop = debugMessages.scrollHeight;
    
    // Keep only last 20 messages
    while (debugMessages.children.length > 20) {
        debugMessages.removeChild(debugMessages.firstChild);
    }
}

function clearDebugPanel() {
    const debugMessages = document.getElementById('debug-messages');
    if (debugMessages) {
        debugMessages.innerHTML = '';
    }
}

// Initialize editor with default content
function initializeEditor() {
    // Add default title and text if no elements exist
    if (elements.length === 0) {
        addTextElement('title');
        addTextElement('text');
        updateFormData();
    }
}

// Initialize visual editor
document.addEventListener('DOMContentLoaded', function() {
    console.log('🚀 DEBUG: Page loaded - DOMContentLoaded event fired');
    
    // Debug: Check if notifications data is available
    console.log('📊 DEBUG: Checking notifications data...');
    
    // Check if we have notifications in the table
    const notificationRows = document.querySelectorAll('tbody tr');
    console.log('📋 DEBUG: Found notification rows:', notificationRows.length);
    
    // Check form elements
    const formTitle = document.getElementById('form-title');
    const formMessage = document.getElementById('form-message');
    const formType = document.getElementById('form-type');
    const targetSelect = document.getElementById('notification-recipients');
    
    console.log('📝 DEBUG: Form elements found:', {
        formTitle: formTitle ? 'Found' : 'Missing',
        formMessage: formMessage ? 'Found' : 'Missing',
        formType: formType ? 'Found' : 'Missing',
        targetSelect: targetSelect ? 'Found' : 'Missing'
    });
    
    // Check CSRF token
    const csrfToken = document.querySelector('meta[name="csrf-token"]');
    console.log('🔐 DEBUG: CSRF token:', csrfToken ? 'Found' : 'Missing');
    
    initializeEditor();
    updateCanvas();
    
    // Add event listener for recipient dropdown
    const recipientSelect = document.getElementById('notification-recipients');
    if (recipientSelect) {
        recipientSelect.addEventListener('change', function() {
            updatePreviewInfo();
        });
    }
});

function updateCanvas() {
    const canvas = document.getElementById('canvas-content');
    const emptyCanvas = document.getElementById('empty-canvas');
    
    if (elements.length === 0) {
        emptyCanvas.classList.remove('hidden');
        canvas.innerHTML = '';
    } else {
        emptyCanvas.classList.add('hidden');
        canvas.innerHTML = elements.map((element, index) => renderElement(element, index)).join('');
        
        // Add event listeners to all elements after rendering
        setTimeout(() => {
            elements.forEach((element, index) => {
                const domElement = document.querySelector(`[data-element-index="${index}"]`);
                if (domElement) {
                    // Remove existing event listeners
                    domElement.onclick = null;
                    
                    // Add new click event listener
                    domElement.addEventListener('click', function(e) {
                        e.stopPropagation();
                        selectElement(index);
                    });
                    
                    // Add mousedown for drag
                    domElement.addEventListener('mousedown', function(e) {
                        startDrag(e, index);
                    });
                    
                    // Add blur for text elements and buttons
                    if (element.type === 'title' || element.type === 'text' || element.type === 'button') {
                        domElement.addEventListener('blur', function(e) {
                            updateElementContent(index, e.target.textContent);
                        });
                    }
                    
                    // If this is the active element, make it editable or focus it
                    if (activeElement === index) {
                        if (element.type === 'title' || element.type === 'text') {
                            domElement.setAttribute('contenteditable', 'true');
                            domElement.contentEditable = 'true';
                            
                            // Focus and select text after a short delay
                            setTimeout(() => {
                                domElement.focus();
                                const range = document.createRange();
                                range.selectNodeContents(domElement);
                                const selection = window.getSelection();
                                selection.removeAllRanges();
                                selection.addRange(range);
                            }, 100);
                        } else if (element.type === 'button') {
                            // For buttons, make them contenteditable too
                            domElement.setAttribute('contenteditable', 'true');
                            domElement.contentEditable = 'true';
                            
                            // Focus and select text after a short delay
                            setTimeout(() => {
                                domElement.focus();
                                const range = document.createRange();
                                range.selectNodeContents(domElement);
                                const selection = window.getSelection();
                                selection.removeAllRanges();
                                selection.addRange(range);
                            }, 100);
                        }
                    }
                }
            });
        }, 50);
    }
    
    // Update preview whenever canvas is updated
    updatePreview();
}

function renderElement(element, index) {
    const isActive = activeElement === index;
    const baseStyle = `
        position: absolute;
        left: ${element.x}px;
        top: ${element.y}px;
        cursor: move;
        ${isActive ? 'outline: 2px solid #00b6b4; outline-offset: 2px;' : ''}
    `;
    
    switch(element.type) {
        case 'title':
            return `
                <div 
                    data-element-index="${index}"
                    style="${baseStyle} color: ${element.color}; font-size: ${element.fontSize}px; font-weight: bold; font-family: ${element.fontFamily || 'inherit'};"
                    contenteditable="false"
                >
                    ${element.content}
                </div>
            `;
        case 'text':
            return `
                <div 
                    data-element-index="${index}"
                    style="${baseStyle} color: ${element.color}; font-size: ${element.fontSize}px; font-family: ${element.fontFamily || 'inherit'};"
                    contenteditable="false"
                >
                    ${element.content}
                </div>
            `;
        case 'button':
            return `
                <div 
                    data-element-index="${index}"
                    style="${baseStyle}"
                >
                    <button 
                        class="px-4 py-2 rounded-lg text-white font-medium transition-colors duration-200"
                        style="background-color: ${element.backgroundColor}; color: ${element.color};"
                    >
                        ${element.content}
                    </button>
                </div>
            `;
        case 'image':
            return `
                <img 
                    data-element-index="${index}"
                    src="${element.src}" 
                    alt="${element.alt}" 
                    style="${baseStyle} max-width: ${element.width}px;"
                    onclick="selectElement(${index}); event.stopPropagation();"
                    onmousedown="startDrag(event, ${index})"
                />
            `;
        case 'emoji':
            return `
                <div 
                    data-element-index="${index}"
                    style="${baseStyle} font-size: ${element.fontSize}px;"
                    onclick="selectElement(${index}); event.stopPropagation();"
                    onmousedown="startDrag(event, ${index})"
                >
                    ${element.content}
                </div>
            `;
        case 'icon':
            return `
                <div 
                    data-element-index="${index}"
                    style="${baseStyle} color: ${element.color || '#f5f5f5'};"
                    onclick="selectElement(${index}); event.stopPropagation();"
                    onmousedown="startDrag(event, ${index})"
                >
                    ${getIconSVG(element.content)}
                </div>
            `;
        default:
            return '';
    }
}

function addTextElement(type) {
    const newElement = {
        type: type,
        content: type === 'title' ? 'Nouveau titre' : type === 'button' ? 'Nouveau bouton' : 'Nouveau texte',
        x: 20,
        y: 20 + (elements.length * 40),
        color: '#f5f5f5',
        fontSize: type === 'title' ? 18 : 14,
        backgroundColor: type === 'button' ? '#00b6b4' : 'transparent'
    };
    
    elements.push(newElement);
    updateCanvas();
    selectElement(elements.length - 1);
    updateFormData();
}

function addImage() {
    const input = document.createElement('input');
    input.type = 'file';
    input.accept = 'image/*';
    input.onchange = function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const newElement = {
                    type: 'image',
                    src: e.target.result,
                    alt: 'Image',
                    x: 20,
                    y: 20 + (elements.length * 100),
                    width: 200
                };
                elements.push(newElement);
                updateCanvas();
                selectElement(elements.length - 1);
            };
            reader.readAsDataURL(file);
        }
    };
    input.click();
}

function toggleEmojiPicker() {
    const picker = document.getElementById('emoji-picker');
    if (picker.classList.contains('hidden')) {
        picker.classList.remove('hidden');
    } else {
        picker.classList.add('hidden');
    }
}

function addEmoji(emoji) {
    const newElement = {
        type: 'emoji',
        content: emoji,
        x: 20,
        y: 20 + (elements.length * 40),
        fontSize: 24
    };
    
    elements.push(newElement);
    updateCanvas();
    selectElement(elements.length - 1);
    document.getElementById('emoji-picker').classList.add('hidden');
}

function addIconElement() {
    const icons = ['Bell', 'AlertTriangle', 'Info', 'CheckCircle', 'Gift', 'Clock', 'Star', 'Heart', 'ThumbsUp', 'MessageCircle'];
    const randomIcon = icons[Math.floor(Math.random() * icons.length)];
    
    const newElement = {
        type: 'icon',
        content: randomIcon,
        x: 20,
        y: 20 + (elements.length * 40),
        color: '#f5f5f5'
    };
    
    elements.push(newElement);
    updateCanvas();
    selectElement(elements.length - 1);
}

function getIconSVG(iconName) {
    const iconMap = {
        'Bell': '<svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/><path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"/></svg>',
        'AlertTriangle': '<svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"/><path d="M12 9v4"/><path d="M12 17h.01"/></svg>',
        'Info': '<svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>',
        'CheckCircle': '<svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="M22 4 12 14.01l-3-3"/></svg>',
        'Gift': '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-gift w-6 h-6"><rect x="3" y="8" width="18" height="4" rx="1"></rect><path d="M12 8v13"></path><path d="M19 12v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-7"></path><path d="M7.5 8a2.5 2.5 0 0 1 0-5A4.8 8 0 0 1 12 8a4.8 8 0 0 1 4.5-5 2.5 2.5 0 0 1 0 5"></path></svg>',
        'Clock': '<svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>',
        'Star': '<svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>',
        'Heart': '<svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.29 1.51 4.04 3 5.5l7 7Z"/></svg>',
        'ThumbsUp': '<svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M7 10v12"/><path d="M15 5.88 14 10h5.83a2 2 0 0 1 1.92 2.56l-2.33 8A2 2 0 0 1 17.5 22H4a2 2 0 0 1-2-2v-8a2 2 0 0 1 2-2h2.76a2 2 0 0 0 1.79-1.11L12 2h0a3.13 3.13 0 0 1 3 3.88Z"/></svg>',
        'MessageCircle': '<svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z"/></svg>'
    };
    return iconMap[iconName] || iconMap['Bell'];
}

function selectElement(index) {
    // First, make all elements non-editable
    document.querySelectorAll('[data-element-index]').forEach(el => {
        el.contentEditable = 'false';
        el.setAttribute('contenteditable', 'false');
    });
    
    activeElement = index;
    document.getElementById('delete-btn').disabled = false;
    
    // Update selection outline without re-rendering
    document.querySelectorAll('[data-element-index]').forEach(el => {
        el.style.outline = 'none';
        el.style.outlineOffset = '0px';
    });
    
    const currentElement = document.querySelector(`[data-element-index="${index}"]`);
    if (currentElement) {
        currentElement.style.outline = '2px solid #00b6b4';
        currentElement.style.outlineOffset = '2px';
    }
    
    // Make the selected element editable and focus it
    setTimeout(() => {
        const element = document.querySelector(`[data-element-index="${index}"]`);
        if (element) {
            const elementType = elements[index].type;
            if (elementType === 'title' || elementType === 'text') {
                // Force contenteditable to true using both methods
                element.setAttribute('contenteditable', 'true');
                element.contentEditable = 'true';
                element.focus();
                
                // Select all text for easy editing
                const range = document.createRange();
                range.selectNodeContents(element);
                const selection = window.getSelection();
                selection.removeAllRanges();
                selection.addRange(range);
            } else if (elementType === 'button') {
                // For buttons, make them contenteditable too
                element.setAttribute('contenteditable', 'true');
                element.contentEditable = 'true';
                element.focus();
                
                // Select all text for easy editing
                const range = document.createRange();
                range.selectNodeContents(element);
                const selection = window.getSelection();
                selection.removeAllRanges();
                selection.addRange(range);
            }
        }
    }, 200);
}

function updateElementContent(index, content) {
    if (elements[index]) {
        // Clean the content by removing extra whitespace and newlines
        const cleanContent = content.trim().replace(/\n\s+/g, ' ').replace(/\s+/g, ' ');
        elements[index].content = cleanContent;
        updateFormData();
    }
}

function deselectAllElements() {
    // Make all elements non-editable
    const allElements = document.querySelectorAll('[data-element-index]');
    allElements.forEach(element => {
        element.contentEditable = 'false';
    });
    // Don't set activeElement to null here, let selectElement handle it
    document.getElementById('delete-btn').disabled = true;
}


function updateElement(index, updates) {
    if (elements[index]) {
        elements[index] = { ...elements[index], ...updates };
        updateCanvas();
        updateFormData();
    }
}

function deleteActiveElement() {
    if (activeElement !== null) {
        elements.splice(activeElement, 1);
        activeElement = null;
        updateCanvas();
        document.getElementById('delete-btn').disabled = true;
        updateFormData();
    }
}

function clearCanvas() {
    elements = [];
    activeElement = null;
    updateCanvas();
    document.getElementById('delete-btn').disabled = true;
    updateFormData();
}

function startDrag(event, index) {
    event.preventDefault();
    isDragging = true;
    draggedElement = index;
    activeElement = index;
    dragPosition = {
        x: event.clientX,
        y: event.clientY
    };
    updateCanvas();
    
    document.addEventListener('mousemove', handleDrag);
    document.addEventListener('mouseup', endDrag);
}

function handleDrag(event) {
    if (!isDragging || draggedElement === null) return;
    
    const deltaX = event.clientX - dragPosition.x;
    const deltaY = event.clientY - dragPosition.y;
    
    elements[draggedElement].x += deltaX;
    elements[draggedElement].y += deltaY;
    
    dragPosition = {
        x: event.clientX,
        y: event.clientY
    };
    
    updateCanvas();
}

function endDrag() {
    isDragging = false;
    draggedElement = null;
    document.removeEventListener('mousemove', handleDrag);
    document.removeEventListener('mouseup', endDrag);
}

function zoomIn() {
    canvasScale = Math.min(2, canvasScale + 0.1);
    updateZoom();
}

function zoomOut() {
    canvasScale = Math.max(0.5, canvasScale - 0.1);
    updateZoom();
}

function updateZoom() {
    document.getElementById('canvas-content').style.transform = `scale(${canvasScale})`;
    document.getElementById('zoom-level').textContent = Math.round(canvasScale * 100) + '%';
}

function toggleTemplateGallery() {
    const gallery = document.getElementById('template-gallery');
    const btn = document.getElementById('template-btn');
    
    if (gallery.classList.contains('hidden')) {
        gallery.classList.remove('hidden');
        btn.classList.add('bg-[#00b6b4]/10', 'text-[#00b6b4]');
    } else {
        gallery.classList.add('hidden');
        btn.classList.remove('bg-[#00b6b4]/10', 'text-[#00b6b4]');
    }
}

function applyTemplate(templateType) {
    clearCanvas();
    
    // Get canvas element to change background
    const canvas = document.getElementById('notification-canvas');
    
    switch(templateType) {
        case 'alert':
            // Change canvas background
            canvas.style.backgroundColor = '#fff3f3';
            elements = [
                { type: 'icon', content: 'AlertTriangle', x: 20, y: 20, color: '#e53e3e' },
                { type: 'title', content: 'Alerte importante', x: 50, y: 20, color: '#e53e3e', fontSize: 18 },
                { type: 'text', content: 'Une action est requise de votre part.', x: 20, y: 60, color: '#e53e3e', fontSize: 14 },
                { type: 'button', content: 'Agir maintenant', x: 20, y: 90, color: '#ffffff', backgroundColor: '#e53e3e' }
            ];
            break;
        case 'info':
            // Change canvas background
            canvas.style.backgroundColor = '#ebf8ff';
            elements = [
                { type: 'icon', content: 'Info', x: 20, y: 20, color: '#3182ce' },
                { type: 'title', content: 'Information', x: 50, y: 20, color: '#3182ce', fontSize: 18 },
                { type: 'text', content: 'Voici une information importante pour vous.', x: 20, y: 60, color: '#3182ce', fontSize: 14 },
                { type: 'button', content: 'En savoir plus', x: 20, y: 90, color: '#ffffff', backgroundColor: '#3182ce' }
            ];
            break;
        case 'success':
            // Change canvas background
            canvas.style.backgroundColor = '#f0fff4';
            elements = [
                { type: 'icon', content: 'CheckCircle', x: 20, y: 20, color: '#38a169' },
                { type: 'title', content: 'Succès !', x: 50, y: 20, color: '#38a169', fontSize: 18 },
                { type: 'text', content: 'Votre action a été effectuée avec succès.', x: 20, y: 60, color: '#38a169', fontSize: 14 },
                { type: 'button', content: 'Continuer', x: 20, y: 90, color: '#ffffff', backgroundColor: '#38a169' }
            ];
            break;
        case 'promo':
            // Change canvas background
            canvas.style.backgroundColor = '#faf5ff';
            elements = [
                { type: 'icon', content: 'Gift', x: 20, y: 20, color: '#805ad5' },
                { type: 'title', content: 'Offre spéciale', x: 50, y: 20, color: '#805ad5', fontSize: 18 },
                { type: 'text', content: 'Profitez de cette offre limitée dans le temps.', x: 20, y: 60, color: '#805ad5', fontSize: 14 },
                { type: 'button', content: 'En profiter', x: 20, y: 90, color: '#ffffff', backgroundColor: '#805ad5' }
            ];
            break;
        case 'reminder':
            // Change canvas background
            canvas.style.backgroundColor = '#fffaf0';
            elements = [
                { type: 'icon', content: 'Clock', x: 20, y: 20, color: '#dd6b20' },
                { type: 'title', content: 'Rappel important', x: 50, y: 20, color: '#dd6b20', fontSize: 18 },
                { type: 'text', content: 'N\'oubliez pas cet événement important.', x: 20, y: 60, color: '#dd6b20', fontSize: 14 },
                { type: 'button', content: 'Voir détails', x: 20, y: 90, color: '#ffffff', backgroundColor: '#dd6b20' }
            ];
            break;
    }
    
    updateCanvas();
    updateFormData();
    
    // Reset activeElement so all elements are clickable
    activeElement = -1;
}

function togglePreview() {
    const btn = document.getElementById('preview-btn');
    if (btn.classList.contains('bg-[#00b6b4]/10')) {
        btn.classList.remove('bg-[#00b6b4]/10', 'text-[#00b6b4]');
    } else {
        btn.classList.add('bg-[#00b6b4]/10', 'text-[#00b6b4]');
    }
}

function toggleColorPicker(type) {
    const picker = document.getElementById('color-picker');
    const title = document.getElementById('color-picker-title');
    
    if (picker.classList.contains('hidden')) {
        picker.classList.remove('hidden');
        if (type === 'text') {
            title.textContent = 'Couleur du texte';
        } else if (type === 'canvas') {
            title.textContent = 'Couleur de fond du canvas';
        } else {
            title.textContent = 'Couleur de fond';
        }
        currentColorTarget = type;
    } else {
        picker.classList.add('hidden');
    }
}

function selectColor(color) {
    if (activeElement !== null && elements[activeElement]) {
        if (currentColorTarget === 'text') {
            elements[activeElement].color = color;
            document.getElementById('text-color-indicator').style.backgroundColor = color;
        } else if (currentColorTarget === 'background') {
            elements[activeElement].backgroundColor = color;
            document.getElementById('bg-color-indicator').style.backgroundColor = color;
        }
        updateCanvas();
    } else if (currentColorTarget === 'canvas') {
        // Change canvas background color
        document.getElementById('notification-canvas').style.backgroundColor = color;
        document.getElementById('bg-color-indicator').style.backgroundColor = color;
    }
    document.getElementById('color-picker').classList.add('hidden');
}

function updateActiveElementFont(fontFamily) {
    if (activeElement !== null && elements[activeElement] && fontFamily) {
        elements[activeElement].fontFamily = fontFamily;
        updateCanvas();
    }
}

// Global variable for color picker
let currentColorTarget = 'text';

function updateFormData() {
    console.log('🔄 DEBUG: updateFormData called');
    console.log('📝 DEBUG: Current elements:', elements);
    
    const titleElement = elements.find(el => el.type === 'title');
    const textElement = elements.find(el => el.type === 'text');
    const buttonElement = elements.find(el => el.type === 'button');
    
    console.log('🔍 DEBUG: Found elements:', {
        titleElement: titleElement ? titleElement.content : 'None',
        textElement: textElement ? textElement.content : 'None',
        buttonElement: buttonElement ? buttonElement.content : 'None'
    });
    
    // Update title
    const titleValue = titleElement ? titleElement.content : 'Nouvelle notification';
    document.getElementById('form-title').value = titleValue;
    console.log('📝 DEBUG: Updated form title:', titleValue);
    
    // Update message - combine text and button content
    let message = '';
    if (textElement) {
        message += textElement.content;
    }
    if (buttonElement) {
        message += (message ? '\n\n' : '') + `[Bouton: ${buttonElement.content}]`;
    }
    if (!message) {
        message = 'Contenu de la notification';
    }
    
    document.getElementById('form-message').value = message;
    console.log('📝 DEBUG: Updated form message:', message);
    
    updatePreview();
}

function updatePreview() {
    const preview = document.getElementById('notification-preview');
    const canvas = document.getElementById('canvas-content');
    const canvasBackground = document.getElementById('notification-canvas').style.backgroundColor;
    
    if (elements.length > 0) {
        // Create a preview version of the canvas content
        let previewContent = '';
        
        // Set the background color for preview
        const backgroundStyle = canvasBackground ? `background-color: ${canvasBackground};` : 'background-color: #2b2b2b;';
        
        elements.forEach((element, index) => {
            const baseStyle = `position: absolute; left: ${element.x}px; top: ${element.y}px; color: ${element.color || '#f5f5f5'}; font-size: ${element.fontSize || 14}px; font-family: ${element.fontFamily || 'inherit'};`;
            
            switch(element.type) {
                case 'title':
                    previewContent += `<div style="${baseStyle} font-weight: bold; font-size: ${element.fontSize || 18}px;">${element.content}</div>`;
                    break;
                case 'text':
                    previewContent += `<div style="${baseStyle}">${element.content}</div>`;
                    break;
                case 'button':
                    const buttonStyle = `${baseStyle} background-color: ${element.backgroundColor || '#00b6b4'}; color: ${element.color || '#ffffff'}; padding: 8px 16px; border-radius: 4px; display: inline-block; cursor: pointer;`;
                    previewContent += `<div style="${buttonStyle}">${element.content}</div>`;
                    break;
                case 'image':
                    previewContent += `<img src="${element.content}" style="${baseStyle} max-width: 200px; max-height: 100px; object-fit: contain;" alt="Image" />`;
                    break;
                case 'emoji':
                    previewContent += `<div style="${baseStyle} font-size: ${element.fontSize || 24}px;">${element.content}</div>`;
                    break;
                case 'icon':
                    previewContent += `<div style="${baseStyle}">${getIconSVG(element.content)}</div>`;
                    break;
            }
        });
        
        preview.innerHTML = `
            <div class="relative" style="min-height: 400px; ${backgroundStyle} border-radius: 8px; padding: 20px; overflow: hidden;">
                ${previewContent}
            </div>
        `;
    } else {
        preview.innerHTML = `
            <div class="text-center text-[#9ca3af]">
                <svg class="w-12 h-12 mx-auto mb-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/>
                    <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"/>
                </svg>
                <p>Aperçu de la notification</p>
            </div>
        `;
    }
    
    // Update preview info section
    updatePreviewInfo();
}

function updatePreviewInfo() {
    const recipients = document.getElementById('notification-recipients').value;
    let recipientText = '';
    switch(recipients) {
        case 'all':
            recipientText = 'Tous les utilisateurs';
            break;
        case 'candidate':
            recipientText = 'Candidats';
            break;
        case 'recruiter':
            recipientText = 'Recruteurs';
            break;
        default:
            recipientText = 'Tous les utilisateurs';
    }
    
    const previewInfo = document.getElementById('preview-info');
    if (previewInfo) {
        previewInfo.innerHTML = `
            <p>Cette notification sera envoyée à : <span class="text-[#00b6b4] font-medium">${recipientText}</span></p>
        `;
    }
}

function resetForm() {
    clearCanvas();
    document.querySelector('form').reset();
    updatePreview();
    showToast('Formulaire réinitialisé', 'Le formulaire a été réinitialisé', 'success');
}

function createNotification(event) {
    console.log('🚀 DEBUG: createNotification function called');
    addDebugMessage('🚀 createNotification function called', 'info');
    
    console.log('⏸️ DEBUG: PAUSE - Check console now before continuing...');
    addDebugMessage('⏸️ PAUSE - Check debug panel now before continuing...', 'info');
    
    // Add a small delay to let you read the debug panel
    setTimeout(() => {
        console.log('▶️ DEBUG: Continuing after pause...');
        addDebugMessage('▶️ Continuing after pause...', 'info');
    }, 3000);
    
    event.preventDefault();
    const form = event.target.closest('form');
    
    // Get data from the editor
    const title = document.getElementById('form-title').value || 'Nouvelle notification';
    const message = document.getElementById('form-message').value || 'Contenu de la notification';
    const type = document.getElementById('form-type').value || 'info';
    const targetType = document.getElementById('notification-recipients').value;
    
    console.log('📝 DEBUG: Form data collected:', {
        title: title,
        message: message,
        type: type,
        targetType: targetType
    });
    addDebugMessage(`📝 Form data: Title="${title}", Type="${type}", Target="${targetType}"`, 'info');
    
    if (!title.trim()) {
        console.log('❌ DEBUG: Title validation failed');
        addDebugMessage('❌ Title validation failed', 'error');
        showToast('Erreur', 'Le titre est requis', 'error');
        return;
    }
    
    if (!message.trim()) {
        console.log('❌ DEBUG: Message validation failed');
        addDebugMessage('❌ Message validation failed', 'error');
        showToast('Erreur', 'Le message est requis', 'error');
        return;
    }
    
    if (!targetType) {
        console.log('❌ DEBUG: Target type validation failed');
        addDebugMessage('❌ Target type validation failed', 'error');
        showToast('Erreur', 'Veuillez sélectionner les destinataires', 'error');
        return;
    }
    
    console.log('✅ DEBUG: All validations passed');
    addDebugMessage('✅ All validations passed', 'success');
    
    // Create form data
    const formData = new FormData();
    formData.append('title', title);
    formData.append('message', message);
    formData.append('type', type);
    formData.append('target_type', targetType);
    formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
    
    console.log('📤 DEBUG: Sending request to:', '{{ route("admin.notifications.store") }}');
    addDebugMessage('📤 Sending request to server...', 'info');
    
    console.log('📤 DEBUG: FormData contents:', {
        title: formData.get('title'),
        message: formData.get('message'),
        type: formData.get('type'),
        target_type: formData.get('target_type'),
        _token: formData.get('_token') ? 'Present' : 'Missing'
    });
    addDebugMessage(`📤 Request data: Title="${formData.get('title')}", Target="${formData.get('target_type')}"`, 'info');
    
    // Send to backend
    fetch('{{ route("admin.notifications.store") }}', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
        }
    })
    .then(response => {
        console.log('📡 DEBUG: Response received:', {
            status: response.status,
            statusText: response.statusText,
            ok: response.ok
        });
        addDebugMessage(`📡 Response received: Status ${response.status} (${response.statusText})`, response.ok ? 'success' : 'error');
        return response.json();
    })
    .then(data => {
        console.log('📊 DEBUG: Response data:', data);
        addDebugMessage(`📊 Server response: ${JSON.stringify(data)}`, 'info');
        
        if (data.success) {
            console.log('✅ DEBUG: Notification created successfully');
            addDebugMessage('✅ Notification created successfully!', 'success');
            showToast('Notification créée', data.message, 'success');
            form.reset();
            // Reload the page to show the new notification
            setTimeout(() => {
                console.log('🔄 DEBUG: Reloading page...');
                addDebugMessage('🔄 Reloading page...', 'info');
                location.reload();
            }, 1500);
        } else {
            console.log('❌ DEBUG: Notification creation failed:', data.error);
            addDebugMessage(`❌ Notification creation failed: ${data.error}`, 'error');
            showToast('Erreur', data.error, 'error');
        }
    })
    .catch(error => {
        console.log('💥 DEBUG: Request failed with error:', error);
        addDebugMessage(`💥 Request failed: ${error.message}`, 'error');
        showToast('Erreur', 'Une erreur est survenue lors de la création de la notification', 'error');
    });
}

function filterNotifications() {
    const searchValue = document.getElementById('search-input').value.toLowerCase();
    const statusFilter = document.getElementById('status-filter').value;
    const rows = document.querySelectorAll('tbody tr');
    let visibleCount = 0;

    rows.forEach(row => {
        const title = row.querySelector('td:first-child div:first-child').textContent.toLowerCase();
        const message = row.querySelector('td:first-child div:last-child').textContent.toLowerCase();
        const status = row.querySelector('td:nth-child(4) div:last-child').textContent;
        
        const matchesSearch = title.includes(searchValue) || message.includes(searchValue);
        const matchesStatus = statusFilter === '' || status.includes(statusFilter);
        
        if (matchesSearch && matchesStatus) {
            row.style.display = '';
            visibleCount++;
        } else {
            row.style.display = 'none';
        }
    });

    document.getElementById('no-results').classList.toggle('hidden', visibleCount > 0);
}

function duplicateNotification(notification) {
    showToast('Notification dupliquée', `La notification "${notification.title}" a été dupliquée`, 'success');
}

function sendExistingNotification(id) {
    console.log('🚀 DEBUG: sendExistingNotification function called with ID:', id);
    addDebugMessage(`🚀 sendExistingNotification called with ID: ${id}`, 'info');
    
    // Send notification directly without confirmation
    console.log('📤 DEBUG: Sending request to:', `/admin/notifications/${id}/send`);
    addDebugMessage(`📤 Sending existing notification ID: ${id}`, 'info');
    
    fetch(`/admin/notifications/${id}/send`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
        }
    })
    .then(response => {
        console.log('📡 DEBUG: Response received:', {
            status: response.status,
            statusText: response.statusText,
            ok: response.ok
        });
        addDebugMessage(`📡 Response received: Status ${response.status}`, response.ok ? 'success' : 'error');
        return response.json();
    })
    .then(data => {
        console.log('📊 DEBUG: Response data:', data);
        addDebugMessage(`📊 Server response: ${JSON.stringify(data)}`, 'info');
        
        if (data.success) {
            console.log('✅ DEBUG: Notification sent successfully');
            addDebugMessage('✅ Notification sent successfully!', 'success');
            showToast('Notification envoyée', data.message, 'success');
            setTimeout(() => {
                console.log('🔄 DEBUG: Reloading page...');
                addDebugMessage('🔄 Reloading page...', 'info');
                location.reload();
            }, 1500);
        } else {
            console.log('❌ DEBUG: Notification sending failed:', data.error);
            addDebugMessage(`❌ Notification sending failed: ${data.error}`, 'error');
            showToast('Erreur', data.error, 'error');
        }
    })
    .catch(error => {
        console.log('💥 DEBUG: Request failed with error:', error);
        addDebugMessage(`💥 Request failed: ${error.message}`, 'error');
        showToast('Erreur', 'Une erreur est survenue lors de l\'envoi de la notification', 'error');
    });
}

function deleteNotification(id, title) {
    if (confirm(`Êtes-vous sûr de vouloir supprimer la notification "${title}" ?`)) {
        fetch(`/admin/notifications/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showToast('Notification supprimée', data.message, 'success');
                setTimeout(() => {
                    location.reload();
                }, 1500);
            } else {
                showToast('Erreur', data.error, 'error');
            }
        })
        .catch(error => {
            showToast('Erreur', 'Une erreur est survenue lors de la suppression de la notification', 'error');
        });
    }
}

// Toast notifications with improved UI
function showToast(title, message, type = 'success') {
    console.log('🔔 DEBUG: showToast called:', { title, message, type });
    
    const container = document.getElementById('toast-container');
    console.log('📦 DEBUG: Toast container found:', container ? 'Yes' : 'No');
    
    const toast = document.createElement('div');
    
    // Improved styling with better colors and animations
    const bgColor = type === 'success' ? 'bg-gradient-to-r from-green-900/90 to-green-800/90' : 'bg-gradient-to-r from-red-900/90 to-red-800/90';
    const borderColor = type === 'success' ? 'border-green-400/50' : 'border-red-400/50';
    const iconColor = type === 'success' ? 'text-green-300' : 'text-red-300';
    
    toast.className = `${bgColor} border ${borderColor} rounded-xl p-4 max-w-sm shadow-2xl backdrop-blur-md transform transition-all duration-300 ease-out translate-x-full opacity-0 cursor-pointer hover:scale-105 transition-transform duration-200`;
    toast.innerHTML = `
        <div class="flex items-start gap-3">
            <div class="flex-shrink-0">
                <div class="w-8 h-8 rounded-full ${type === 'success' ? 'bg-green-500/20' : 'bg-red-500/20'} flex items-center justify-center">
                    ${type === 'success' ? 
                        '<svg class="w-5 h-5 text-green-300" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="M22 4 12 14.01l-3-3"/></svg>' :
                        '<svg class="w-5 h-5 text-red-300" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="m15 9-6 6"/><path d="m9 9 6 6"/></svg>'
                    }
                </div>
            </div>
            <div class="flex-1 min-w-0">
                <h4 class="text-sm font-semibold text-white mb-1">${title}</h4>
                <p class="text-xs text-gray-300 leading-relaxed">${message}</p>
                ${type === 'error' ? '<p class="text-xs text-gray-400 mt-1 italic">Survolez pour garder visible</p>' : ''}
            </div>
            <button onclick="this.parentElement.parentElement.remove()" class="flex-shrink-0 text-gray-400 hover:text-white transition-colors duration-200 p-1 rounded-full hover:bg-white/10">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6L6 18"/><path d="M6 6l12 12"/></svg>
            </button>
        </div>
                <div class="absolute bottom-0 left-0 h-1 ${type === 'success' ? 'bg-green-400' : 'bg-red-400'} rounded-b-xl animate-pulse"></div>
                <div class="absolute top-0 right-0 bg-blue-500 text-white text-xs px-2 py-1 rounded-bl-lg">DEBUG</div>
    `;
    
    // DEBUG MODE: No hover functionality needed since popups stay forever
    console.log('DEBUG: Popup will stay visible - no auto-hide enabled');
    
    container.appendChild(toast);
    
    // Animate in
    setTimeout(() => {
        toast.classList.remove('translate-x-full', 'opacity-0');
        toast.classList.add('translate-x-0', 'opacity-100');
    }, 10);
    
    // DEBUG MODE: Disable auto-hide completely for debugging
    console.log('DEBUG: Popup created - will stay visible until manually closed');
    
    // Don't set any timeout - popups stay until manually closed
    // This is for debugging purposes
}
</script>
@endsection
