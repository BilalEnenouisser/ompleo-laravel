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
            <div class="mb-4 sm:mb-6">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-xs sm:text-sm text-[#9ca3af]">Taille du canvas</span>
                    <div class="flex items-center gap-2">
                        <button
                            type="button"
                            onclick="expandCanvas()"
                            class="flex items-center gap-1.5 sm:gap-2 p-1.5 sm:p-2 rounded text-[#9ca3af] hover:bg-[#444444] hover:text-[#00b6b4] text-xs sm:text-sm transition-colors"
                            title="Agrandir le canvas"
                        >
                            <svg class="w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3"/>
                            </svg>
                            <span class="hidden sm:inline">Agrandir</span>
                        </button>
                        <button
                            type="button"
                            onclick="resetCanvasSize()"
                            class="p-1.5 sm:p-2 rounded text-[#9ca3af] hover:bg-[#444444] hover:text-[#00b6b4] text-xs sm:text-sm flex items-center gap-1.5 sm:gap-2"
                            title="Réinitialiser la taille"
                        >
                            <svg class="w-3 h-3 sm:w-4 sm:h-4 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 12a9 9 0 0 1 9-9 9.75 9.75 0 0 1 6.74 2.74L21 8"/>
                                <path d="M21 3v5h-5"/>
                                <path d="M21 12a9 9 0 0 1-9 9 9.75 9.75 0 0 1-6.74-2.74L3 16"/>
                                <path d="M3 21v-5h5"/>
                            </svg>
                            <span>Réinitialiser</span>
                        </button>
                    </div>
                </div>
                <div 
                    id="notification-canvas"
                    class="border border-[#444444] rounded-lg overflow-auto mb-4 sm:mb-6 relative"
                    style="min-height: 300px; background-color: #2b2b2b; color: #f5f5f5;"
                    onclick="handleCanvasClick(event)"
                >
                    <div id="canvas-content" style="transform: scale(1); transform-origin: top left; min-height: 300px; position: relative;">
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
                
                {{-- Notification Type Selection --}}
                <div>
                    <label class="block text-sm font-medium text-[#9ca3af] mb-2">
                        Type de notification *
                    </label>
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-[#9ca3af] w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"/>
                            <path d="M12 16v-4"/>
                            <path d="M12 8h.01"/>
                        </svg>
                        <select
                            name="type"
                            id="notification-type"
                            onchange="updateFormType(this.value)"
                            class="w-full pl-8 sm:pl-10 pr-4 py-2.5 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none appearance-none bg-[#333333] text-[#f5f5f5] text-sm sm:text-base"
                        >
                            <option value="info">Information</option>
                            <option value="success">Succès</option>
                            <option value="warning">Avertissement</option>
                            <option value="error">Erreur</option>
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
            <table class="w-full min-w-[1000px]">
                <thead class="bg-[#333333]">
                    <tr>
                        <th class="text-left py-3 sm:py-4 px-4 sm:px-6 font-semibold text-[#f5f5f5] text-sm sm:text-base min-w-[200px]">Notification</th>
                        <th class="text-left py-3 sm:py-4 px-4 sm:px-6 font-semibold text-[#f5f5f5] text-sm sm:text-base min-w-[150px]">Destinataires</th>
                        <th class="text-left py-3 sm:py-4 px-4 sm:px-6 font-semibold text-[#f5f5f5] text-sm sm:text-base min-w-[140px]">Date d'envoi</th>
                        <th class="text-left py-3 sm:py-4 px-4 sm:px-6 font-semibold text-[#f5f5f5] text-sm sm:text-base min-w-[180px]">Statistiques</th>
                        <th class="text-left py-3 sm:py-4 px-4 sm:px-6 font-semibold text-[#f5f5f5] text-sm sm:text-base min-w-[120px]">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if($notifications->count() > 0)
                        @foreach($notifications as $notification)
                    <tr class="border-b border-[#444444] hover:bg-[#333333]">
                        <td class="py-3 sm:py-4 px-4 sm:px-6 min-w-[200px]">
                            <div class="min-w-0">
                                <div class="font-semibold text-[#f5f5f5] text-sm sm:text-base truncate">{{ $notification->title }}</div>
                                <div class="text-xs sm:text-sm text-[#9ca3af] line-clamp-2">{{ $notification->message }}</div>
                            </div>
                        </td>
                        <td class="py-3 sm:py-4 px-4 sm:px-6 min-w-[150px]">
                            <div class="flex items-center gap-1.5 sm:gap-2">
                                @if($notification->target_type === 'all')
                                    <svg class="w-3 h-3 sm:w-4 sm:h-4 text-[#9ca3af] flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                                        <circle cx="9" cy="7" r="4"/>
                                        <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                                    </svg>
                                    <span class="text-[#9ca3af] text-xs sm:text-sm whitespace-nowrap">Tous les utilisateurs</span>
                                @elseif($notification->target_type === 'candidates')
                                    <svg class="w-3 h-3 sm:w-4 sm:h-4 text-[#9ca3af] flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                        <circle cx="12" cy="7" r="4"/>
                                    </svg>
                                    <span class="text-[#9ca3af] text-xs sm:text-sm whitespace-nowrap">Candidats</span>
                                @else
                                    <svg class="w-3 h-3 sm:w-4 sm:h-4 text-[#9ca3af] flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"/>
                                        <path d="M6 12H4a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2"/>
                                        <path d="M18 9h2a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2h-2"/>
                                        <path d="M10 6h4"/>
                                        <path d="M10 10h4"/>
                                        <path d="M10 14h4"/>
                                        <path d="M10 18h4"/>
                                    </svg>
                                    <span class="text-[#9ca3af] text-xs sm:text-sm whitespace-nowrap">Recruteurs</span>
                                @endif
                            </div>
                        </td>
                        <td class="py-3 sm:py-4 px-4 sm:px-6 min-w-[140px]">
                            <div class="text-[#9ca3af] text-xs sm:text-sm whitespace-nowrap">
                                @if($notification->sent_at)
                                    {{ $notification->sent_at->format('d/m/Y') }} à {{ $notification->sent_at->format('H:i') }}
                                @else
                                    Non envoyée
                                @endif
                            </div>
                        </td>
                        <td class="py-3 sm:py-4 px-4 sm:px-6 min-w-[180px]">
                            <div class="flex flex-col min-w-0">
                                <div class="text-[#f5f5f5] font-medium text-xs sm:text-sm whitespace-nowrap">
                                    @if($notification->is_sent && isset($notification->total_recipients))
                                        {{ $notification->total_recipients }} destinataire{{ $notification->total_recipients > 1 ? 's' : '' }}
                                    @elseif($notification->target_users && is_array($notification->target_users))
                                        {{ count($notification->target_users) }} destinataire{{ count($notification->target_users) > 1 ? 's' : '' }}
                                    @else
                                        @if($notification->target_type === 'all')
                                            {{ $stats['all_users'] ?? 0 }} destinataire{{ ($stats['all_users'] ?? 0) > 1 ? 's' : '' }}
                                        @elseif($notification->target_type === 'candidates')
                                            {{ $stats['candidates'] ?? 0 }} destinataire{{ ($stats['candidates'] ?? 0) > 1 ? 's' : '' }}
                                        @else
                                            {{ $stats['recruiters'] ?? 0 }} destinataire{{ ($stats['recruiters'] ?? 0) > 1 ? 's' : '' }}
                                        @endif
                                    @endif
                                </div>
                                <div class="text-xs sm:text-sm">
                                    @if($notification->is_sent)
                                        @php
                                            $openingRate = $notification->opening_rate ?? 0;
                                            $openedCount = $notification->opened_count ?? 0;
                                            $totalRecipients = $notification->total_recipients ?? 0;
                                            $rateColor = $openingRate == 0 ? 'text-red-400' : ($openingRate < 30 ? 'text-yellow-400' : ($openingRate < 70 ? 'text-orange-400' : 'text-green-400'));
                                        @endphp
                                        <div class="flex flex-col gap-1">
                                            <div class="flex flex-col sm:flex-row sm:items-center gap-1">
                                                <span class="{{ $rateColor }} font-medium whitespace-nowrap">
                                                    Taux d'ouverture: {{ $openingRate }}%
                                                </span>
                                                @if($openingRate == 0)
                                                    <span class="text-red-500 text-xs whitespace-nowrap">(Aucune ouverture)</span>
                                                @elseif($openingRate < 30)
                                                    <span class="text-yellow-500 text-xs whitespace-nowrap">(Faible)</span>
                                                @elseif($openingRate < 70)
                                                    <span class="text-orange-500 text-xs whitespace-nowrap">(Moyen)</span>
                                                @else
                                                    <span class="text-green-500 text-xs whitespace-nowrap">(Excellent)</span>
                                                @endif
                                            </div>
                                            <div class="text-[#9ca3af] whitespace-nowrap">
                                                <span class="text-[#00b6b4] font-medium">{{ $openedCount }}</span> / <span>{{ $totalRecipients }}</span> ouvert{{ $openedCount > 1 ? 'es' : 'e' }}
                                            </div>
                                        </div>
                                    @else
                                        <span class="text-yellow-500 whitespace-nowrap">En attente</span>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="py-3 sm:py-4 px-4 sm:px-6 min-w-[120px]">
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


<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4" onclick="closeDeleteModal()">
    <div class="bg-[#2b2b2b] rounded-2xl shadow-2xl border border-[#333333] max-w-md w-full transform transition-all duration-300 scale-95 opacity-0" id="deleteModalContent" onclick="event.stopPropagation()">
        <div class="p-6">
            <!-- Header -->
            <div class="flex items-center gap-4 mb-6">
                <div class="w-12 h-12 bg-red-500/10 rounded-full flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-red-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 6h18"/>
                        <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
                        <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                        <line x1="10" x2="10" y1="11" y2="17"/>
                        <line x1="14" x2="14" y1="11" y2="17"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-[#f5f5f5]">Supprimer la notification</h3>
                    <p class="text-sm text-[#9ca3af]">Cette action est irréversible</p>
                </div>
            </div>
            
            <!-- Content -->
            <div class="mb-6">
                <p class="text-[#cccccc] mb-2">Êtes-vous sûr de vouloir supprimer cette notification ?</p>
                <div class="bg-[#333333] rounded-lg p-3 border border-[#444444]">
                    <p class="text-sm text-[#9ca3af] mb-1">Titre :</p>
                    <p class="text-[#f5f5f5] font-medium" id="deleteNotificationTitle">-</p>
                </div>
            </div>
            
            <!-- Actions -->
            <div class="flex items-center justify-end gap-3">
                <button
                    onclick="closeDeleteModal()"
                    class="px-4 py-2 text-[#9ca3af] hover:text-[#f5f5f5] transition-colors duration-200"
                >
                    Annuler
                </button>
                <button
                    onclick="confirmDeleteNotification()"
                    class="px-6 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium transition-colors duration-200 flex items-center gap-2"
                >
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 6h18"/>
                        <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
                        <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                    </svg>
                    Supprimer
                </button>
            </div>
        </div>
    </div>
</div>

{{-- Button URL Editor Modal --}}
<div id="button-url-modal" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 hidden">
    <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-4 sm:p-6 shadow-xl max-w-md w-full mx-4">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg sm:text-xl font-bold text-[#f5f5f5]">Éditer le bouton</h3>
            <button onclick="closeButtonUrlModal()" class="text-[#9ca3af] hover:text-[#f5f5f5] transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                    <path d="M18 6L6 18M6 6l12 12"/>
                </svg>
            </button>
        </div>
        
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-[#9ca3af] mb-2">Texte du bouton</label>
                <input
                    type="text"
                    id="button-text-input"
                    class="w-full px-3 py-2 border border-[#444444] rounded-lg bg-[#333333] text-[#f5f5f5] focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none"
                    placeholder="Ex: Cliquez ici"
                />
            </div>
            
            <div>
                <label class="block text-sm font-medium text-[#9ca3af] mb-2">URL du bouton</label>
                <input
                    type="url"
                    id="button-url-input"
                    class="w-full px-3 py-2 border border-[#444444] rounded-lg bg-[#333333] text-[#f5f5f5] focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none"
                    placeholder="Ex: https://example.com"
                />
                <p class="text-xs text-[#9ca3af] mt-1">Laissez vide pour un bouton sans lien</p>
            </div>
            
            <div class="flex items-center gap-3 pt-2">
                <button
                    onclick="saveButtonUrl()"
                    class="flex-1 px-4 py-2 bg-[#00b6b4] hover:bg-[#009999] text-white rounded-lg font-medium transition-colors"
                >
                    Enregistrer
                </button>
                <button
                    onclick="closeButtonUrlModal()"
                    class="px-4 py-2 border border-[#444444] text-[#9ca3af] hover:text-[#f5f5f5] rounded-lg font-medium transition-colors"
                >
                    Annuler
                </button>
            </div>
        </div>
    </div>
</div>

<script>
// Global variables for visual editor
let elements = [];
let activeElement = null;
let canvasScale = 1;
let isDragging = false;
let draggedElement = null;
let dragPosition = { x: 0, y: 0 };
let editingButtonIndex = null;


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
                                
                                // For buttons, don't add click listener that stops propagation
                                // Let handleCanvasClick handle it
                                if (element.type !== 'button') {
                                    // Add new click event listener for non-button elements
                                    domElement.addEventListener('click', function(e) {
                                        e.stopPropagation();
                                        selectElement(index);
                                    });
                                }
                                // For buttons, don't add click listener - let handleCanvasClick handle it
                                
                                // Add mousedown for drag
                                domElement.addEventListener('mousedown', function(e) {
                                    // Don't prevent drag on buttons, just let it work
                                    startDrag(e, index);
                                });
                    
                    // Add blur for text elements
                    if (element.type === 'title' || element.type === 'text') {
                        domElement.addEventListener('blur', function(e) {
                            updateElementContent(index, e.target.textContent);
                        });
                    }
                    
                    // Note: Button clicks are handled via event delegation on canvas-content
                    // No need to attach individual listeners here
                    
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
                        }
                    }
                }
            });
        }, 50);
    }
    
    // Auto-resize canvas based on content (with delay to let images load)
    setTimeout(() => {
        autoResizeCanvas();
    }, 100);
    
    // Update preview whenever canvas is updated
    updatePreview();
}

function autoResizeCanvas() {
    const canvasContent = document.getElementById('canvas-content');
    const canvasContainer = document.getElementById('notification-canvas');
    
    if (elements.length === 0) {
        canvasContent.style.height = '300px';
        canvasContainer.style.minHeight = '300px';
        return;
    }
    
    // Calculate the maximum bottom position of all elements
    let maxBottom = 300; // Minimum height
    
    // First, try to calculate from actual DOM elements (more accurate)
    const domElements = canvasContent.querySelectorAll('[data-element-index]');
    if (domElements.length > 0) {
        domElements.forEach(domElement => {
            const rect = domElement.getBoundingClientRect();
            const canvasRect = canvasContent.getBoundingClientRect();
            const relativeBottom = rect.bottom - canvasRect.top + rect.height;
            if (relativeBottom > maxBottom) {
                maxBottom = relativeBottom;
            }
        });
    } else {
        // Fallback: calculate from element data
        elements.forEach(element => {
            let elementHeight = 40; // Default height for text elements
            
            if (element.type === 'image') {
                // For images, use the stored height or calculate from aspect ratio
                if (element.height) {
                    elementHeight = element.height;
                } else if (element.originalHeight && element.originalWidth) {
                    // Calculate based on original dimensions
                    const aspectRatio = element.originalHeight / element.originalWidth;
                    elementHeight = (element.width || 200) * aspectRatio;
                } else {
                    elementHeight = (element.width || 200) * 0.75; // Default aspect ratio
                }
            } else if (element.type === 'title') {
                elementHeight = element.fontSize || 18;
            } else if (element.type === 'emoji' || element.type === 'icon') {
                elementHeight = element.fontSize || 24;
            } else if (element.type === 'button') {
                elementHeight = 40; // Button height
            }
            
            const bottomPosition = element.y + elementHeight + 20; // Add padding
            if (bottomPosition > maxBottom) {
                maxBottom = bottomPosition;
            }
        });
    }
    
    // Set the canvas height (add some padding)
    const newHeight = Math.max(300, maxBottom + 50);
    canvasContent.style.height = newHeight + 'px';
    canvasContainer.style.minHeight = newHeight + 'px';
}

function expandCanvas() {
    const canvasContent = document.getElementById('canvas-content');
    const canvasContainer = document.getElementById('notification-canvas');
    
    const currentHeight = parseInt(canvasContent.style.height) || 300;
    const newHeight = currentHeight + 200; // Add 200px
    
    canvasContent.style.height = newHeight + 'px';
    canvasContainer.style.minHeight = newHeight + 'px';
}

function resetCanvasSize() {
    autoResizeCanvas();
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
            // In the editor, buttons are always editable regardless of URL
            // URLs only make buttons clickable when displayed in notifications
            const buttonContent = `<button type="button" class="px-4 py-2 rounded-lg text-white font-medium transition-colors duration-200" style="background-color: ${element.backgroundColor}; color: ${element.color}; cursor: pointer; pointer-events: auto;" data-button-index="${index}">${element.content}</button>`;
            return `
                <div 
                    data-element-index="${index}"
                    data-button-container="${index}"
                    style="${baseStyle}"
                    onmousedown="startDrag(event, ${index})"
                >
                    ${buttonContent}
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
                    onload="autoResizeCanvas()"
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
        backgroundColor: type === 'button' ? '#00b6b4' : 'transparent',
        url: type === 'button' ? '' : undefined
    };
    
    elements.push(newElement);
    updateCanvas();
    if (type === 'button') {
        openButtonUrlModal(elements.length - 1);
    } else {
        selectElement(elements.length - 1);
    }
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
                // Create image to get actual dimensions
                const img = new Image();
                img.onload = function() {
                    const aspectRatio = img.height / img.width;
                    const displayWidth = 200; // Default width
                    const displayHeight = displayWidth * aspectRatio;
                    
                    const newElement = {
                        type: 'image',
                        src: e.target.result,
                        alt: 'Image',
                        x: 20,
                        y: 20 + (elements.length * 100),
                        width: displayWidth,
                        height: displayHeight,
                        originalWidth: img.width,
                        originalHeight: img.height
                    };
                    elements.push(newElement);
                    updateCanvas();
                    selectElement(elements.length - 1);
                };
                img.src = e.target.result;
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
                // For buttons, open URL editor modal immediately
                openButtonUrlModal(index);
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

function handleCanvasClick(event) {
    // Check if click is on a button first
    const button = event.target.closest('button[data-button-index]');
    if (button) {
        const buttonIndex = parseInt(button.getAttribute('data-button-index'));
        event.stopPropagation();
        openButtonUrlModal(buttonIndex);
        return;
    }
    
    // Check if click is on button container
    const buttonContainer = event.target.closest('[data-button-container]');
    if (buttonContainer && !event.target.closest('button')) {
        const containerIndex = parseInt(buttonContainer.getAttribute('data-button-container'));
        event.stopPropagation();
        openButtonUrlModal(containerIndex);
        return;
    }
    
    // Otherwise, deselect all elements
    deselectAllElements();
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
    // Don't prevent default on buttons - allow clicks to work
    if (elements[index] && elements[index].type === 'button') {
        // Check if it's actually a drag (moved more than 5px) or just a click
        const startX = event.clientX;
        const startY = event.clientY;
        
        const handleMouseMove = function(moveEvent) {
            const deltaX = Math.abs(moveEvent.clientX - startX);
            const deltaY = Math.abs(moveEvent.clientY - startY);
            
            // If moved more than 5px, it's a drag
            if (deltaX > 5 || deltaY > 5) {
                event.preventDefault();
                isDragging = true;
                draggedElement = index;
                activeElement = index;
                dragPosition = {
                    x: moveEvent.clientX,
                    y: moveEvent.clientY
                };
                document.addEventListener('mousemove', handleDrag);
                document.addEventListener('mouseup', endDrag);
                document.removeEventListener('mousemove', handleMouseMove);
                document.removeEventListener('mouseup', handleMouseUp);
            }
        };
        
        const handleMouseUp = function() {
            document.removeEventListener('mousemove', handleMouseMove);
            document.removeEventListener('mouseup', handleMouseUp);
        };
        
        document.addEventListener('mousemove', handleMouseMove);
        document.addEventListener('mouseup', handleMouseUp);
        return;
    }
    
    // For non-button elements, start drag immediately
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
                { type: 'button', content: 'Agir maintenant', x: 20, y: 90, color: '#ffffff', backgroundColor: '#e53e3e', url: '' }
            ];
            break;
        case 'info':
            // Change canvas background
            canvas.style.backgroundColor = '#ebf8ff';
            elements = [
                { type: 'icon', content: 'Info', x: 20, y: 20, color: '#3182ce' },
                { type: 'title', content: 'Information', x: 50, y: 20, color: '#3182ce', fontSize: 18 },
                { type: 'text', content: 'Voici une information importante pour vous.', x: 20, y: 60, color: '#3182ce', fontSize: 14 },
                { type: 'button', content: 'En savoir plus', x: 20, y: 90, color: '#ffffff', backgroundColor: '#3182ce', url: '' }
            ];
            break;
        case 'success':
            // Change canvas background
            canvas.style.backgroundColor = '#f0fff4';
            elements = [
                { type: 'icon', content: 'CheckCircle', x: 20, y: 20, color: '#38a169' },
                { type: 'title', content: 'Succès !', x: 50, y: 20, color: '#38a169', fontSize: 18 },
                { type: 'text', content: 'Votre action a été effectuée avec succès.', x: 20, y: 60, color: '#38a169', fontSize: 14 },
                { type: 'button', content: 'Continuer', x: 20, y: 90, color: '#ffffff', backgroundColor: '#38a169', url: '' }
            ];
            break;
        case 'promo':
            // Change canvas background
            canvas.style.backgroundColor = '#faf5ff';
            elements = [
                { type: 'icon', content: 'Gift', x: 20, y: 20, color: '#805ad5' },
                { type: 'title', content: 'Offre spéciale', x: 50, y: 20, color: '#805ad5', fontSize: 18 },
                { type: 'text', content: 'Profitez de cette offre limitée dans le temps.', x: 20, y: 60, color: '#805ad5', fontSize: 14 },
                { type: 'button', content: 'En profiter', x: 20, y: 90, color: '#ffffff', backgroundColor: '#805ad5', url: '' }
            ];
            break;
        case 'reminder':
            // Change canvas background
            canvas.style.backgroundColor = '#fffaf0';
            elements = [
                { type: 'icon', content: 'Clock', x: 20, y: 20, color: '#dd6b20' },
                { type: 'title', content: 'Rappel important', x: 50, y: 20, color: '#dd6b20', fontSize: 18 },
                { type: 'text', content: 'N\'oubliez pas cet événement important.', x: 20, y: 60, color: '#dd6b20', fontSize: 14 },
                { type: 'button', content: 'Voir détails', x: 20, y: 90, color: '#ffffff', backgroundColor: '#dd6b20', url: '' }
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
    const titleElement = elements.find(el => el.type === 'title');
    const textElement = elements.find(el => el.type === 'text');
    const buttonElement = elements.find(el => el.type === 'button');
    
    // Update title
    const titleValue = titleElement ? titleElement.content : 'Nouvelle notification';
    document.getElementById('form-title').value = titleValue;
    
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
                    previewContent += `<img src="${element.src}" style="${baseStyle} max-width: ${element.width || 200}px; max-height: 100px; object-fit: contain;" alt="${element.alt || 'Image'}" />`;
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

function updateFormType(type) {
    document.getElementById('form-type').value = type;
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
    
    event.preventDefault();
    const form = event.target.closest('form');
    
    // Get data from the editor
    const title = document.getElementById('form-title').value || 'Nouvelle notification';
    const message = document.getElementById('form-message').value || 'Contenu de la notification';
    const type = document.getElementById('notification-type').value || 'info';
    const targetType = document.getElementById('notification-recipients').value;
    
    // Ensure we have at least some content
    if (elements.length === 0) {
        showToast('Erreur', 'Veuillez ajouter du contenu à votre notification', 'error');
        return;
    }
    
    if (!title.trim()) {
        showToast('Erreur', 'Le titre est requis', 'error');
        return;
    }
    
    if (!message.trim()) {
        showToast('Erreur', 'Le message est requis', 'error');
        return;
    }
    
    if (!targetType) {
        showToast('Erreur', 'Veuillez sélectionner les destinataires', 'error');
        return;
    }
    
    // Create form data
    const formData = new FormData();
    formData.append('title', title);
    formData.append('message', message);
    formData.append('type', type);
    formData.append('target_type', targetType);
    formData.append('rich_content', JSON.stringify(elements));
    formData.append('background_color', document.getElementById('notification-canvas').style.backgroundColor || '#2b2b2b');
    formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
    
    
    // Send to backend
    fetch('{{ route("admin.notifications.store") }}', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showToast('Notification créée', data.message, 'success');
            
            // Auto-send the notification after creation
            
            setTimeout(() => {
                fetch(`/admin/notifications/${data.notification.id}/send`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json',
                    }
                })
                .then(response => response.json())
                .then(sendData => {
                    if (sendData.success) {
                        showToast('Notification envoyée', sendData.message, 'success');
                        form.reset();
                        location.reload();
                    } else {
                        showToast('Erreur', sendData.error || 'Erreur inconnue lors de l\'envoi', 'error');
                    }
                })
                .catch(error => {
                    showToast('Erreur', 'Erreur lors de l\'envoi de la notification', 'error');
                });
            }, 1000);
        } else {
            showToast('Erreur', data.error || 'Erreur inconnue lors de la création', 'error');
        }
    })
    .catch(error => {
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
    // Send notification directly without confirmation
    
    fetch(`/admin/notifications/${id}/send`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showToast('Notification envoyée', data.message, 'success');
            setTimeout(() => {
                location.reload();
            }, 1500);
        } else {
            showToast('Erreur', data.error, 'error');
        }
    })
    .catch(error => {
        showToast('Erreur', 'Une erreur est survenue lors de l\'envoi de la notification', 'error');
    });
}

// Global variables for delete modal
let deleteNotificationId = null;
let deleteNotificationTitle = null;

function deleteNotification(id, title) {
    deleteNotificationId = id;
    deleteNotificationTitle = title;
    
    // Update modal content
    document.getElementById('deleteNotificationTitle').textContent = title;
    
    // Show modal with animation
    const modal = document.getElementById('deleteModal');
    const modalContent = document.getElementById('deleteModalContent');
    
    modal.classList.remove('hidden');
    
    // Trigger animation
    setTimeout(() => {
        modalContent.classList.remove('scale-95', 'opacity-0');
        modalContent.classList.add('scale-100', 'opacity-100');
    }, 10);
}

function closeDeleteModal() {
    const modal = document.getElementById('deleteModal');
    const modalContent = document.getElementById('deleteModalContent');
    
    // Animate out
    modalContent.classList.remove('scale-100', 'opacity-100');
    modalContent.classList.add('scale-95', 'opacity-0');
    
    // Hide modal after animation
    setTimeout(() => {
        modal.classList.add('hidden');
    }, 300);
}

function confirmDeleteNotification() {
    if (!deleteNotificationId) return;
    
    // Close modal first
    closeDeleteModal();
    
    // Show loading state
    showToast('Suppression en cours...', 'Suppression de la notification', 'info');
    
    // Delete notification
    fetch(`/admin/notifications/${deleteNotificationId}`, {
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

// Keyboard support for modal
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        const modal = document.getElementById('deleteModal');
        if (!modal.classList.contains('hidden')) {
            closeDeleteModal();
        }
    }
});

// Button URL Modal Functions
function openButtonUrlModal(index) {
    if (index === null || index === undefined || !elements[index] || elements[index].type !== 'button') {
        return;
    }
    
    editingButtonIndex = index;
    const button = elements[index];
    
    const textInput = document.getElementById('button-text-input');
    const urlInput = document.getElementById('button-url-input');
    const modal = document.getElementById('button-url-modal');
    
    if (textInput) textInput.value = button.content || '';
    if (urlInput) urlInput.value = button.url || '';
    if (modal) {
        modal.classList.remove('hidden');
    }
}

function closeButtonUrlModal() {
    document.getElementById('button-url-modal').classList.add('hidden');
    editingButtonIndex = null;
    document.getElementById('button-text-input').value = '';
    document.getElementById('button-url-input').value = '';
}

function saveButtonUrl() {
    if (editingButtonIndex === null || editingButtonIndex === undefined || !elements[editingButtonIndex]) {
        closeButtonUrlModal();
        return;
    }
    
    const textInput = document.getElementById('button-text-input').value.trim();
    const urlInput = document.getElementById('button-url-input').value.trim();
    
    if (!textInput) {
        showToast('Erreur', 'Le texte du bouton est requis', 'error');
        return;
    }
    
    // Update the button element
    elements[editingButtonIndex].content = textInput;
    elements[editingButtonIndex].url = urlInput || '';
    
    updateCanvas();
    updateFormData();
    closeButtonUrlModal();
    
    // Select the button after updating
    selectElement(editingButtonIndex);
    
    showToast('Succès', 'Bouton mis à jour avec succès', 'success');
}

// Close modal when clicking outside
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('button-url-modal');
    if (modal) {
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                closeButtonUrlModal();
            }
        });
        
        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
                closeButtonUrlModal();
            }
        });
        
        // Save with Enter key (when focused on inputs)
        const textInput = document.getElementById('button-text-input');
        const urlInput = document.getElementById('button-url-input');
        
        [textInput, urlInput].forEach(input => {
            if (input) {
                input.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter' && e.ctrlKey) {
                        e.preventDefault();
                        saveButtonUrl();
                    }
                });
            }
        });
    }
});

// Toast notifications with improved UI
function showToast(title, message, type = 'success') {
    
    const container = document.getElementById('toast-container');
    
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
    `;
    
    container.appendChild(toast);
    
    // Animate in
    setTimeout(() => {
        toast.classList.remove('translate-x-full', 'opacity-0');
        toast.classList.add('translate-x-0', 'opacity-100');
    }, 10);
    
    // Auto-hide after 4 seconds for success, 8 seconds for error
    const hideDelay = type === 'success' ? 4000 : 8000;
    setTimeout(() => {
        toast.classList.remove('translate-x-0', 'opacity-100');
        toast.classList.add('translate-x-full', 'opacity-0');
        setTimeout(() => {
            if (toast.parentElement) {
                toast.parentElement.removeChild(toast);
            }
        }, 300);
    }, hideDelay);
}
</script>
@endsection
