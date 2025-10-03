@extends('layouts.dashboard')

@section('page-title', 'Éditeur de Blog')
@section('content')
<div class="flex flex-col bg-[#1a1a1a]">
    {{-- Header --}}
    <div class="flex items-center justify-between p-4 border-b border-[#333333] bg-[#2b2b2b]">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.blog') }}" class="flex items-center gap-2 text-[#9ca3af] hover:text-[#00b6b4] transition-colors">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 12H5"/>
                    <path d="M12 19l-7-7 7-7"/>
                </svg>
                Retour au blog
            </a>
            <div class="h-6 w-px bg-[#444444]"></div>
            <h1 class="text-xl font-bold text-[#f5f5f5]">Nouvel article</h1>
        </div>
        
        <div class="flex items-center gap-3">
            <button id="fullscreenBtn" class="flex items-center gap-2 px-4 py-2 text-[#9ca3af] hover:text-[#00b6b4] hover:bg-[#333333] rounded-lg transition-colors">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M8 3H5a2 2 0 0 0-2 2v3"/>
                    <path d="M21 8V5a2 2 0 0 0-2-2h-3"/>
                    <path d="M3 16v3a2 2 0 0 0 2 2h3"/>
                    <path d="M16 21h3a2 2 0 0 0 2-2v-3"/>
                </svg>
                Plein écran
            </button>
            <button id="previewBtn" class="flex items-center gap-2 px-4 py-2 text-[#9ca3af] hover:text-[#00b6b4] hover:bg-[#333333] rounded-lg transition-colors">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/>
                    <circle cx="12" cy="12" r="3"/>
                </svg>
                Aperçu
            </button>
            <button id="saveBtn" class="flex items-center gap-2 px-4 py-2 bg-[#333333] hover:bg-[#444444] text-[#f5f5f5] rounded-lg transition-colors">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                    <polyline points="17,21 17,13 7,13 7,21"/>
                    <polyline points="7,3 7,8 15,8"/>
                </svg>
                Sauvegarder
            </button>
            <button id="publishBtn" class="flex items-center gap-2 px-4 py-2 bg-[#00b6b4] hover:bg-[#009e9c] text-white rounded-lg transition-colors">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                </svg>
                Publier
            </button>
        </div>
    </div>

    <div class="flex-1 flex overflow-hidden">
        {{-- Sidebar --}}
        <div class="w-80 bg-[#2b2b2b] border-r border-[#333333] flex flex-col">
            {{-- Informations de base --}}
            <div class="p-4 border-b border-[#333333]">
                <h3 class="text-lg font-semibold text-[#f5f5f5] mb-4">Informations de base</h3>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-[#cccccc] mb-2">Titre</label>
                        <input type="text" id="articleTitle" placeholder="Titre de l'article" class="w-full px-3 py-2 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5]">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-[#cccccc] mb-2">Extrait</label>
                        <textarea id="articleExcerpt" rows="3" placeholder="Description courte de l'article" class="w-full px-3 py-2 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5]"></textarea>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-[#cccccc] mb-2">Statut</label>
                        <select id="articleStatus" class="w-full px-3 py-2 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5]">
                            <option value="draft">Brouillon</option>
                            <option value="published">Publié</option>
                        </select>
                    </div>
                </div>
            </div>

            {{-- Image à la une --}}
            <div class="p-4 border-b border-[#333333]">
                <h3 class="text-lg font-semibold text-[#f5f5f5] mb-4">Image à la une</h3>
                
                <div class="border-2 border-dashed border-[#444444] rounded-lg p-6 text-center cursor-pointer hover:bg-[#333333] transition-colors" onclick="uploadFeaturedImage()">
                    <div class="flex flex-col items-center">
                        <svg class="w-12 h-12 text-[#9ca3af] mb-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="18" height="18" x="3" y="3" rx="2" ry="2"/>
                            <circle cx="9" cy="9" r="2"/>
                            <path d="M21 15l-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/>
                        </svg>
                        <p class="text-[#cccccc] font-medium mb-2">
                            Glissez-déposez une image ici
                        </p>
                        <p class="text-[#9ca3af] text-sm mb-4">
                            ou cliquez pour sélectionner un fichier
                        </p>
                        <button
                            type="button"
                            class="px-4 py-2 bg-[#00b6b4] hover:bg-[#009e9c] text-white rounded-lg flex items-center gap-2 transition-colors"
                            onclick="event.stopPropagation(); uploadFeaturedImage()"
                        >
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M14.5 4h-5L7 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-3l-2.5-3z"/>
                                <circle cx="12" cy="13" r="3"/>
                            </svg>
                            Parcourir
                        </button>
                    </div>
                    <input type="file" id="featuredImageInput" accept="image/*" style="display: none;" onchange="handleFeaturedImageUpload(this)">
                </div>
            </div>

            {{-- Content Blocks --}}
            <div class="flex-1 p-4">
                <h3 class="text-lg font-semibold text-[#f5f5f5] mb-4">Ajouter du contenu</h3>
                
                <div class="grid grid-cols-2 gap-2">
                    <button onclick="addBlock('title')" class="flex items-center gap-2 p-3 border border-[#e5e7eb] rounded-lg text-[#9ca3af] hover:text-[#00b6b4] hover:bg-[#333333] transition-colors">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 12h8"/>
                            <path d="M4 18V6"/>
                            <path d="M12 18V6"/>
                            <path d="m17 12 3-2v8"/>
                        </svg>
                        <span class="text-sm">Titre</span>
                    </button>
                    
                    <button onclick="addBlock('subtitle')" class="flex items-center gap-2 p-3 border border-[#e5e7eb] rounded-lg text-[#9ca3af] hover:text-[#00b6b4] hover:bg-[#333333] transition-colors">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 12h8"/>
                            <path d="M4 18V6"/>
                            <path d="M12 18V6"/>
                            <path d="m17 12 3-2v8"/>
                        </svg>
                        <span class="text-sm">Sous-titre</span>
                    </button>
                    
                    <button onclick="addBlock('paragraph')" class="flex items-center gap-2 p-3 border border-[#e5e7eb] rounded-lg text-[#9ca3af] hover:text-[#00b6b4] hover:bg-[#333333] transition-colors">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M6 4h8a4 4 0 0 1 4 4 4 4 0 0 1-4 4H6z"/>
                            <path d="M6 12h9"/>
                        </svg>
                        <span class="text-sm">Paragraphe</span>
                    </button>
                    
                    <button onclick="addBlock('image')" class="flex items-center gap-2 p-3 border border-[#e5e7eb] rounded-lg text-[#9ca3af] hover:text-[#00b6b4] hover:bg-[#333333] transition-colors">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="18" height="18" x="3" y="3" rx="2" ry="2"/>
                            <circle cx="9" cy="9" r="2"/>
                            <path d="M21 15l-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/>
                        </svg>
                        <span class="text-sm">Image</span>
                    </button>
                    
                    <button onclick="addBlock('quote')" class="flex items-center gap-2 p-3 border border-[#e5e7eb] rounded-lg text-[#9ca3af] hover:text-[#00b6b4] hover:bg-[#333333] transition-colors">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 21c3 0 7-1 7-8V5c0-1.25-.756-2.017-2-2H4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2 1 0 1 0 1 1v1c0 1-1 2-2 2s-1 .008-1 1.031V20c0 1 0 1 1 1z"/>
                            <path d="M15 21c3 0 7-1 7-8V5c0-1.25-.757-2.017-2-2h-4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2h.75c0 2.25.25 4-2.75 4v3c0 1 0 1 1 1z"/>
                        </svg>
                        <span class="text-sm">Citation</span>
                    </button>
                    
                    <button onclick="addBlock('list')" class="flex items-center gap-2 p-3 border border-[#e5e7eb] rounded-lg text-[#9ca3af] hover:text-[#00b6b4] hover:bg-[#333333] transition-colors">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="8" x2="21" y1="6" y2="6"/>
                            <line x1="8" x2="21" y1="12" y2="12"/>
                            <line x1="8" x2="21" y1="18" y2="18"/>
                            <line x1="3" x2="3.01" y1="6" y2="6"/>
                            <line x1="3" x2="3.01" y1="12" y2="12"/>
                            <line x1="3" x2="3.01" y1="18" y2="18"/>
                        </svg>
                        <span class="text-sm">Liste</span>
                    </button>
                    
                    <button onclick="addBlock('code')" class="flex items-center gap-2 p-3 border border-[#e5e7eb] rounded-lg text-[#9ca3af] hover:text-[#00b6b4] hover:bg-[#333333] transition-colors">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="16,18 22,12 16,6"/>
                            <polyline points="8,6 2,12 8,18"/>
                        </svg>
                        <span class="text-sm">Code</span>
                    </button>
                    
                    <button onclick="addBlock('separator')" class="flex items-center gap-2 p-3 border border-[#e5e7eb] rounded-lg text-[#9ca3af] hover:text-[#00b6b4] hover:bg-[#333333] transition-colors">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="3" x2="21" y1="12" y2="12"/>
                            <line x1="3" x2="21" y1="6" y2="6"/>
                            <line x1="3" x2="21" y1="18" y2="18"/>
                        </svg>
                        <span class="text-sm">Séparateur</span>
                    </button>
                    
                    <button onclick="addBlock('columns')" class="flex items-center gap-2 p-3 border border-[#e5e7eb] rounded-lg text-[#9ca3af] hover:text-[#00b6b4] hover:bg-[#333333] transition-colors">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="18" height="18" x="3" y="3" rx="2"/>
                            <path d="M3 9h18"/>
                            <path d="M9 21V9"/>
                        </svg>
                        <span class="text-sm">Colonnes</span>
                    </button>
                </div>
            </div>

            {{-- Tags --}}
            <div class="p-4 border-b border-[#333333]">
                <h3 class="text-lg font-semibold text-[#f5f5f5] mb-4">Tags</h3>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-[#cccccc] mb-2">Mots-clés</label>
                        <input type="text" id="articleTags" placeholder="tag1, tag2, tag3" class="w-full px-3 py-2 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5]">
                    </div>
                </div>
            </div>

            {{-- SEO --}}
            <div class="p-4">
                <h3 class="text-lg font-semibold text-[#f5f5f5] mb-4">SEO</h3>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-[#cccccc] mb-2">Meta titre</label>
                        <input type="text" id="metaTitle" placeholder="Titre SEO" class="w-full px-3 py-2 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5]">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-[#cccccc] mb-2">Meta description</label>
                        <textarea id="metaDescription" rows="3" placeholder="Description SEO" class="w-full px-3 py-2 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5]"></textarea>
                    </div>
                    
                   
                </div>
            </div>
        </div>

        {{-- Main Editor --}}
        <div class="flex-1 bg-[#1a1a1a] overflow-y-auto">
            <div class="max-w-4xl mx-auto p-8">
                <div id="editorContent" class="space-y-6">
                    <div class="text-center py-12 text-[#9ca3af]">
                        <svg class="w-16 h-16 mx-auto mb-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                            <polyline points="14,2 14,8 20,8"/>
                            <line x1="16" x2="8" y1="13" y2="13"/>
                            <line x1="16" x2="8" y1="17" y2="17"/>
                            <polyline points="10,9 9,9 8,9"/>
                        </svg>
                        <p class="text-lg mb-4 text-[#cccccc]">Votre article est vide</p>
                        <p class="text-sm">Utilisez la barre latérale pour ajouter du contenu</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let contentBlocks = [];
let blockIdCounter = 0;

function addBlock(type) {
    const blockId = 'block_' + (++blockIdCounter);
    
    // Create new block object
    const newBlock = { id: blockId, type: type };
    
    // Check if block with same ID already exists (prevent duplicates)
    const existingBlock = contentBlocks.find(block => block.id === blockId);
    if (existingBlock) {
        return;
    }
    
    // Add ONLY the new block to contentBlocks array
    contentBlocks.push(newBlock);
    
    // Re-render all content (like React does)
    renderAllBlocks();
}

// Test function to clear all blocks
function clearAllBlocks() {
    contentBlocks = [];
    blockIdCounter = 0;
    renderAllBlocks();
}

// Function to remove duplicate blocks
function removeDuplicateBlocks() {
    const uniqueBlocks = [];
    const seenIds = new Set();
    
    contentBlocks.forEach(block => {
        if (!seenIds.has(block.id)) {
            seenIds.add(block.id);
            uniqueBlocks.push(block);
        }
    });
    
    contentBlocks = uniqueBlocks;
    renderAllBlocks();
}

function renderAllBlocks() {
    const editorContent = document.getElementById('editorContent');
    
    if (contentBlocks.length === 0) {
        editorContent.innerHTML = `
            <div class="text-center py-12 text-[#9ca3af]">
                <svg class="w-16 h-16 mx-auto mb-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                    <polyline points="14,2 14,8 20,8"/>
                    <line x1="16" x2="8" y1="13" y2="13"/>
                    <line x1="16" x2="8" y1="17" y2="17"/>
                </svg>
                <p class="text-lg mb-4 text-[#f5f5f5]">Votre article est vide</p>
                <p class="text-sm">Utilisez la barre latérale pour ajouter du contenu</p>
            </div>
        `;
        return;
    }
    
    // Clear and rebuild all blocks
    editorContent.innerHTML = '';
    
    contentBlocks.forEach((block, index) => {
        const blockHTML = generateBlockHTML(block.id, block.type);
        if (blockHTML && typeof blockHTML === 'string') {
            editorContent.insertAdjacentHTML('beforeend', blockHTML);
        }
    });
}

function generateBlockHTML(blockId, type) {
    let blockHTML = '';
    let defaultContent = '';
    
    switch(type) {
        case 'title':
            defaultContent = 'Nouveau titre';
            blockHTML = `
                <div id="${blockId}" class="block-item relative group hover:bg-[#333333] p-2 rounded-lg transition-colors">
                    <h1 contenteditable="true" class="text-3xl font-bold text-[#f5f5f4] mb-4 focus:outline-none cursor-pointer" data-placeholder="Titre de l'article">${defaultContent}</h1>
                    <div class="absolute -right-2 -top-2 opacity-0 group-hover:opacity-100 transition-opacity flex gap-1">
                        <button onclick="moveBlock('${blockId}', 'up')" class="p-1 bg-blue-500 text-white rounded text-xs hover:bg-blue-600 transition-colors">
                            <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m18 15-6-6-6 6"/>
                            </svg>
                        </button>
                        <button onclick="moveBlock('${blockId}', 'down')" class="p-1 bg-blue-500 text-white rounded text-xs hover:bg-blue-600 transition-colors">
                            <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m6 9 6 6 6-6"/>
                            </svg>
                        </button>
                        <button onclick="deleteBlock('${blockId}')" class="p-1 bg-red-500 text-white rounded text-xs hover:bg-red-600 transition-colors">
                            <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 6h18"/>
                                <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
                                <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                            </svg>
                        </button>
                    </div>
                </div>
            `;
            break;
            
        case 'subtitle':
            defaultContent = 'Nouveau sous-titre';
            blockHTML = `
                <div id="${blockId}" class="block-item relative group hover:bg-[#333333] p-2 rounded-lg transition-colors">
                    <h2 contenteditable="true" class="text-2xl font-semibold text-[#f5f5f4] mb-4 focus:outline-none cursor-pointer" data-placeholder="Sous-titre">${defaultContent}</h2>
                    <div class="absolute -right-2 -top-2 opacity-0 group-hover:opacity-100 transition-opacity flex gap-1">
                        <button onclick="moveBlock('${blockId}', 'up')" class="p-1 bg-blue-500 text-white rounded text-xs hover:bg-blue-600 transition-colors">
                            <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m18 15-6-6-6 6"/>
                            </svg>
                        </button>
                        <button onclick="moveBlock('${blockId}', 'down')" class="p-1 bg-blue-500 text-white rounded text-xs hover:bg-blue-600 transition-colors">
                            <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m6 9 6 6 6-6"/>
                            </svg>
                        </button>
                        <button onclick="deleteBlock('${blockId}')" class="p-1 bg-red-500 text-white rounded text-xs hover:bg-red-600 transition-colors">
                            <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 6h18"/>
                                <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
                                <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                            </svg>
                        </button>
                    </div>
                </div>
            `;
            break;
            
        case 'paragraph':
            defaultContent = 'Nouveau paragraphe. Cliquez pour modifier le contenu.';
            blockHTML = `
                <div id="${blockId}" class="block-item relative group hover:bg-[#333333] p-2 rounded-lg transition-colors">
                    <p contenteditable="true" class="text-[#f5f5f4] mb-4 focus:outline-none cursor-pointer" data-placeholder="Contenu du paragraphe">${defaultContent}</p>
                    <div class="absolute -right-2 -top-2 opacity-0 group-hover:opacity-100 transition-opacity flex gap-1">
                        <button onclick="moveBlock('${blockId}', 'up')" class="p-1 bg-blue-500 text-white rounded text-xs hover:bg-blue-600 transition-colors">
                            <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m18 15-6-6-6 6"/>
                            </svg>
                        </button>
                        <button onclick="moveBlock('${blockId}', 'down')" class="p-1 bg-blue-500 text-white rounded text-xs hover:bg-blue-600 transition-colors">
                            <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m6 9 6 6 6-6"/>
                            </svg>
                        </button>
                        <button onclick="deleteBlock('${blockId}')" class="p-1 bg-red-500 text-white rounded text-xs hover:bg-red-600 transition-colors">
                            <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 6h18"/>
                                <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
                                <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                            </svg>
                        </button>
                    </div>
                </div>
            `;
            break;
            
        case 'image':
            // Check if this block has uploaded image data
            const blockData = contentBlocks.find(block => block.id === blockId);
            if (blockData && blockData.imageData) {
                // Show uploaded image
                blockHTML = `
                    <div id="${blockId}" class="block-item relative group hover:bg-[#333333] p-2 rounded-lg transition-colors">
                        <div class="border-2 border-dashed border-[#444444] rounded-lg p-8 text-center cursor-pointer" onclick="uploadImage('${blockId}')">
                            <img src="${blockData.imageData}" alt="${blockData.imageAlt || 'Uploaded image'}" class="max-w-full h-auto rounded-lg mb-2">
                            <p class="text-[#9ca3af] text-sm mb-1">Image ajoutée</p>
                            <p class="text-xs text-[#666666]">Cliquez pour changer</p>
                            <input type="file" id="imageInput_${blockId}" accept="image/*" style="display: none;" onchange="handleImageUpload('${blockId}', this)">
                        </div>
                        <div class="absolute -right-2 -top-2 opacity-0 group-hover:opacity-100 transition-opacity flex gap-1">
                            <button onclick="moveBlock('${blockId}', 'up')" class="p-1 bg-blue-500 text-white rounded text-xs hover:bg-blue-600 transition-colors">
                                <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m18 15-6-6-6 6"/>
                                </svg>
                            </button>
                            <button onclick="moveBlock('${blockId}', 'down')" class="p-1 bg-blue-500 text-white rounded text-xs hover:bg-blue-600 transition-colors">
                                <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m6 9 6 6 6-6"/>
                                </svg>
                            </button>
                            <button onclick="deleteBlock('${blockId}')" class="p-1 bg-red-500 text-white rounded text-xs hover:bg-red-600 transition-colors">
                                <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 6h18"/>
                                    <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
                                    <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                `;
            } else {
                // Show upload area
                blockHTML = `
                    <div id="${blockId}" class="block-item relative group hover:bg-[#333333] p-2 rounded-lg transition-colors">
                        <div class="border-2 border-dashed border-[#444444] rounded-lg p-6 text-center cursor-pointer hover:bg-[#333333] transition-colors" onclick="uploadImage('${blockId}')">
                            <div class="flex flex-col items-center">
                                <svg class="w-12 h-12 text-[#9ca3af] mb-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect width="18" height="18" x="3" y="3" rx="2" ry="2"/>
                                    <circle cx="9" cy="9" r="2"/>
                                    <path d="M21 15l-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/>
                                </svg>
                                <p class="text-[#cccccc] font-medium mb-2">
                                    Glissez-déposez une image ici
                                </p>
                                <p class="text-[#9ca3af] text-sm mb-4">
                                    ou cliquez pour sélectionner un fichier
                                </p>
                                <button
                                    type="button"
                                    class="px-4 py-2 bg-[#00b6b4] hover:bg-[#009e9c] text-white rounded-lg flex items-center gap-2 transition-colors"
                                    onclick="event.stopPropagation(); uploadImage('${blockId}')"
                                >
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14.5 4h-5L7 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-3l-2.5-3z"/>
                                        <circle cx="12" cy="13" r="3"/>
                                    </svg>
                                    Parcourir
                                </button>
                            </div>
                            <input type="file" id="imageInput_${blockId}" accept="image/*" style="display: none;" onchange="handleImageUpload('${blockId}', this)">
                        </div>
                        <div class="absolute -right-2 -top-2 opacity-0 group-hover:opacity-100 transition-opacity flex gap-1">
                            <button onclick="moveBlock('${blockId}', 'up')" class="p-1 bg-blue-500 text-white rounded text-xs hover:bg-blue-600 transition-colors">
                                <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m18 15-6-6-6 6"/>
                                </svg>
                            </button>
                            <button onclick="moveBlock('${blockId}', 'down')" class="p-1 bg-blue-500 text-white rounded text-xs hover:bg-blue-600 transition-colors">
                                <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m6 9 6 6 6-6"/>
                                </svg>
                            </button>
                            <button onclick="deleteBlock('${blockId}')" class="p-1 bg-red-500 text-white rounded text-xs hover:bg-red-600 transition-colors">
                                <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 6h18"/>
                                    <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
                                    <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                `;
            }
            break;
            
        case 'quote':
            defaultContent = 'Citation inspirante';
            blockHTML = `
                <div id="${blockId}" class="block-item relative group hover:bg-[#333333] p-2 rounded-lg transition-colors">
                    <blockquote contenteditable="true" class="border-l-4 border-[#00b6b4] pl-4 italic text-[#f5f5f4] mb-4 focus:outline-none cursor-pointer" data-placeholder="Citation">${defaultContent}</blockquote>
                    <div class="absolute -right-2 -top-2 opacity-0 group-hover:opacity-100 transition-opacity flex gap-1">
                        <button onclick="moveBlock('${blockId}', 'up')" class="p-1 bg-blue-500 text-white rounded text-xs hover:bg-blue-600 transition-colors">
                            <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m18 15-6-6-6 6"/>
                            </svg>
                        </button>
                        <button onclick="moveBlock('${blockId}', 'down')" class="p-1 bg-blue-500 text-white rounded text-xs hover:bg-blue-600 transition-colors">
                            <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m6 9 6 6 6-6"/>
                            </svg>
                        </button>
                        <button onclick="deleteBlock('${blockId}')" class="p-1 bg-red-500 text-white rounded text-xs hover:bg-red-600 transition-colors">
                            <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 6h18"/>
                                <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
                                <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                            </svg>
                        </button>
                    </div>
                </div>
            `;
            break;
            
        case 'list':
            defaultContent = 'Élément de liste';
            blockHTML = `
                <div id="${blockId}" class="block-item relative group hover:bg-[#333333] p-2 rounded-lg transition-colors">
                    <ul class="list-disc list-inside text-[#f5f5f4] mb-4">
                        <li contenteditable="true" class="focus:outline-none cursor-pointer" data-placeholder="Élément de liste">${defaultContent}</li>
                    </ul>
                    <div class="absolute -right-2 -top-2 opacity-0 group-hover:opacity-100 transition-opacity flex gap-1">
                        <button onclick="moveBlock('${blockId}', 'up')" class="p-1 bg-blue-500 text-white rounded text-xs hover:bg-blue-600 transition-colors">
                            <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m18 15-6-6-6 6"/>
                            </svg>
                        </button>
                        <button onclick="moveBlock('${blockId}', 'down')" class="p-1 bg-blue-500 text-white rounded text-xs hover:bg-blue-600 transition-colors">
                            <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m6 9 6 6 6-6"/>
                            </svg>
                        </button>
                        <button onclick="deleteBlock('${blockId}')" class="p-1 bg-red-500 text-white rounded text-xs hover:bg-red-600 transition-colors">
                            <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 6h18"/>
                                <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
                                <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                            </svg>
                        </button>
                    </div>
                </div>
            `;
            break;
            
        case 'code':
            defaultContent = 'console.log("Hello World");';
            blockHTML = `
                <div id="${blockId}" class="block-item relative group hover:bg-[#333333] p-2 rounded-lg transition-colors">
                    <pre class="bg-[#333333] p-4 rounded-lg text-[#f5f5f4] mb-4 overflow-x-auto"><code contenteditable="true" class="focus:outline-none cursor-pointer" data-placeholder="Code">${defaultContent}</code></pre>
                    <div class="absolute -right-2 -top-2 opacity-0 group-hover:opacity-100 transition-opacity flex gap-1">
                        <button onclick="moveBlock('${blockId}', 'up')" class="p-1 bg-blue-500 text-white rounded text-xs hover:bg-blue-600 transition-colors">
                            <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m18 15-6-6-6 6"/>
                            </svg>
                        </button>
                        <button onclick="moveBlock('${blockId}', 'down')" class="p-1 bg-blue-500 text-white rounded text-xs hover:bg-blue-600 transition-colors">
                            <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m6 9 6 6 6-6"/>
                            </svg>
                        </button>
                        <button onclick="deleteBlock('${blockId}')" class="p-1 bg-red-500 text-white rounded text-xs hover:bg-red-600 transition-colors">
                            <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 6h18"/>
                                <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
                                <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                            </svg>
                        </button>
                    </div>
                </div>
            `;
            break;
            
        case 'separator':
            blockHTML = `
                <div id="${blockId}" class="block-item relative group hover:bg-[#333333] p-2 rounded-lg transition-colors">
                    <hr class="border-[#444444] my-8">
                    <div class="absolute -right-2 -top-2 opacity-0 group-hover:opacity-100 transition-opacity flex gap-1">
                        <button onclick="moveBlock('${blockId}', 'up')" class="p-1 bg-blue-500 text-white rounded text-xs hover:bg-blue-600 transition-colors">
                            <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m18 15-6-6-6 6"/>
                            </svg>
                        </button>
                        <button onclick="moveBlock('${blockId}', 'down')" class="p-1 bg-blue-500 text-white rounded text-xs hover:bg-blue-600 transition-colors">
                            <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m6 9 6 6 6-6"/>
                            </svg>
                        </button>
                        <button onclick="deleteBlock('${blockId}')" class="p-1 bg-red-500 text-white rounded text-xs hover:bg-red-600 transition-colors">
                            <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 6h18"/>
                                <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
                                <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                            </svg>
                        </button>
                    </div>
                </div>
            `;
            break;
            
        case 'columns':
            blockHTML = `
                <div id="${blockId}" class="block-item relative group hover:bg-[#333333] p-2 rounded-lg transition-colors">
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div contenteditable="true" class="p-4 border border-[#444444] rounded-lg text-[#f5f5f4] focus:outline-none cursor-pointer" data-placeholder="Colonne 1">Contenu de la colonne 1</div>
                        <div contenteditable="true" class="p-4 border border-[#444444] rounded-lg text-[#f5f5f4] focus:outline-none cursor-pointer" data-placeholder="Colonne 2">Contenu de la colonne 2</div>
                    </div>
                    <div class="absolute -right-2 -top-2 opacity-0 group-hover:opacity-100 transition-opacity flex gap-1">
                        <button onclick="moveBlock('${blockId}', 'up')" class="p-1 bg-blue-500 text-white rounded text-xs hover:bg-blue-600 transition-colors">
                            <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m18 15-6-6-6 6"/>
                            </svg>
                        </button>
                        <button onclick="moveBlock('${blockId}', 'down')" class="p-1 bg-blue-500 text-white rounded text-xs hover:bg-blue-600 transition-colors">
                            <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m6 9 6 6 6-6"/>
                            </svg>
                        </button>
                        <button onclick="deleteBlock('${blockId}')" class="p-1 bg-red-500 text-white rounded text-xs hover:bg-red-600 transition-colors">
                            <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 6h18"/>
                                <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
                                <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                            </svg>
                        </button>
                    </div>
                </div>
            `;
            break;
    }
    
    return blockHTML;
}

// Missing functions added
function uploadImage(blockId) {
    const input = document.getElementById(`imageInput_${blockId}`);
    if (input) {
        input.click();
    }
}

function handleImageUpload(blockId, input) {
    const file = input.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            // Update the contentBlocks array with the image data
            const blockIndex = contentBlocks.findIndex(block => block.id === blockId);
            if (blockIndex !== -1) {
                contentBlocks[blockIndex].imageData = e.target.result;
                contentBlocks[blockIndex].imageAlt = file.name;
            }
            
            // Re-render all content to show the uploaded image
            renderAllBlocks();
        };
        reader.readAsDataURL(file);
    }
}

function uploadFeaturedImage() {
    const input = document.getElementById('featuredImageInput');
    input.click();
}

function handleFeaturedImageUpload(input) {
    const file = input.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const uploadArea = input.parentElement;
            uploadArea.innerHTML = `
                <img src="${e.target.result}" alt="Featured image" class="max-w-full h-auto rounded-lg mb-2">
                <p class="text-sm text-[#9ca3af] mb-1">Image à la une ajoutée</p>
                <p class="text-xs text-[#666666]">Cliquez pour changer</p>
                <input type="file" id="featuredImageInput" accept="image/*" style="display: none;" onchange="handleFeaturedImageUpload(this)">
            `;
        };
        reader.readAsDataURL(file);
    }
}

function deleteBlock(blockId) {
    // Remove from contentBlocks array
    contentBlocks = contentBlocks.filter(block => block.id !== blockId);
    
    // Re-render all content (like React does)
    renderAllBlocks();
}

function moveBlock(blockId, direction) {
    const currentIndex = contentBlocks.findIndex(block => block.id === blockId);
    
    if (direction === 'up' && currentIndex > 0) {
        // Move up
        [contentBlocks[currentIndex], contentBlocks[currentIndex - 1]] = 
        [contentBlocks[currentIndex - 1], contentBlocks[currentIndex]];
    } else if (direction === 'down' && currentIndex < contentBlocks.length - 1) {
        // Move down
        [contentBlocks[currentIndex], contentBlocks[currentIndex + 1]] = 
        [contentBlocks[currentIndex + 1], contentBlocks[currentIndex]];
    }
    
    // Re-render all content
    renderAllBlocks();
}

// Preview state
let isPreview = false;

// Header button functionality
document.getElementById('previewBtn').addEventListener('click', function(e) {
    isPreview = !isPreview;
    const sidebar = document.querySelector('.w-80');
    
    if (isPreview) {
        // Switch to preview mode - hide sidebar
        this.innerHTML = `
            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/>
                <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>
            </svg>
            Éditer
        `;
        this.classList.remove('text-[#9ca3af]', 'hover:text-[#00b6b4]', 'hover:bg-[#333333]');
        this.classList.add('bg-[#00b6b4]', 'text-white', 'hover:bg-[#009e9c]');
        
        // Hide sidebar
        if (sidebar) {
            sidebar.style.display = 'none';
        }
        
        renderPreview();
    } else {
        // Switch to edit mode - show sidebar
        this.innerHTML = `
            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/>
                <circle cx="12" cy="12" r="3"/>
            </svg>
            Aperçu
        `;
        this.classList.remove('bg-[#00b6b4]', 'text-white', 'hover:bg-[#009e9c]');
        this.classList.add('text-[#9ca3af]', 'hover:text-[#00b6b4]', 'hover:bg-[#333333]');
        
        // Show sidebar
        if (sidebar) {
            sidebar.style.display = 'flex';
        }
        
        // Only render blocks if we're switching back to edit mode
        renderAllBlocks();
    }
});

function renderPreview() {
    const editorContent = document.getElementById('editorContent');
    const title = document.getElementById('articleTitle').value;
    const excerpt = document.getElementById('articleExcerpt').value;
    
    // Get featured image
    const featuredImage = document.querySelector('#featuredImageInput').parentElement.querySelector('img') ? 
        document.querySelector('#featuredImageInput').parentElement.querySelector('img').src : '';
    
    // Generate preview content using stored data instead of DOM queries
    let previewContent = '';
    contentBlocks.forEach(block => {
        switch(block.type) {
            case 'title':
                const titleContent = block.content || 'Titre de l\'article';
                previewContent += `<h1 class="text-4xl font-bold mb-6 text-[#f5f5f5]">${titleContent}</h1>`;
                break;
            case 'subtitle':
                const subtitleContent = block.content || 'Sous-titre';
                previewContent += `<h2 class="text-2xl font-semibold mb-4 text-[#f5f5f5]">${subtitleContent}</h2>`;
                break;
            case 'paragraph':
                const paragraphContent = block.content || 'Contenu du paragraphe';
                previewContent += `<p class="mb-4 text-[#f5f5f5]">${paragraphContent}</p>`;
                break;
            case 'image':
                if (block.imageData) {
                    previewContent += `<img src="${block.imageData}" alt="${block.imageAlt || 'Image'}" class="max-w-full h-auto rounded-lg mb-4">`;
                }
                break;
            case 'quote':
                const quoteContent = block.content || 'Citation';
                previewContent += `<blockquote class="border-l-4 border-[#00b6b4] pl-4 italic mb-4 text-[#f5f5f5]">${quoteContent}</blockquote>`;
                break;
            case 'list':
                const listContent = block.content || 'Élément de liste';
                previewContent += `<ul class="list-disc list-inside mb-4 text-[#f5f5f5]"><li>${listContent}</li></ul>`;
                break;
            case 'code':
                const codeContent = block.content || 'Code';
                previewContent += `<pre class="bg-[#333333] p-4 rounded-lg text-[#f5f5f5] mb-4 overflow-x-auto"><code>${codeContent}</code></pre>`;
                break;
            case 'separator':
                previewContent += `<hr class="border-[#444444] my-8">`;
                break;
            case 'columns':
                const col1Content = block.col1Content || 'Colonne 1';
                const col2Content = block.col2Content || 'Colonne 2';
                previewContent += `<div class="grid grid-cols-2 gap-4 mb-4"><div class="p-4 border border-[#444444] rounded-lg text-[#f5f5f5]">${col1Content}</div><div class="p-4 border border-[#444444] rounded-lg text-[#f5f5f5]">${col2Content}</div></div>`;
                break;
        }
    });
    
    // Show preview content
    editorContent.innerHTML = `
        <div class="prose prose-invert max-w-none">
            ${featuredImage ? `<img src="${featuredImage}" alt="Featured image" class="w-full h-48 object-cover rounded-lg mb-6">` : ''}
            <h1 class="text-4xl font-bold mb-4 text-[#f5f5f5]">${title || 'Titre de l\'article'}</h1>
            <p class="text-lg text-[#cccccc] mb-6">${excerpt || 'Description courte de l\'article'}</p>
            <div class="space-y-6">
                ${previewContent}
            </div>
        </div>
    `;
}

function renderAllBlocks() {
    const editorContent = document.getElementById('editorContent');
    editorContent.innerHTML = '';
    
    contentBlocks.forEach(block => {
        const blockHTML = generateBlockHTML(block.id, block.type);
        if (blockHTML && typeof blockHTML === 'string') {
            editorContent.innerHTML += blockHTML;
        }
    });
    
    // Re-attach event listeners after re-rendering
    attachEventListeners();
}

function updateBlockContent(blockId, content) {
    const blockIndex = contentBlocks.findIndex(block => block.id === blockId);
    if (blockIndex !== -1) {
        contentBlocks[blockIndex].content = content;
    }
}

function attachEventListeners() {
    // Add blur event listeners to all contenteditable elements
    document.querySelectorAll('[contenteditable="true"]').forEach(element => {
        element.addEventListener('blur', function() {
            const blockId = this.closest('.block-item').id;
            updateBlockContent(blockId, this.textContent);
        });
    });
}

document.getElementById('fullscreenBtn').addEventListener('click', function() {
    if (document.fullscreenElement) {
        document.exitFullscreen();
    } else {
        document.documentElement.requestFullscreen();
    }
});

document.getElementById('saveBtn').addEventListener('click', function() {
    alert('Article sauvegardé!');
});

document.getElementById('publishBtn').addEventListener('click', function() {
    alert('Article publié avec succès!');
});
</script>
@endsection
