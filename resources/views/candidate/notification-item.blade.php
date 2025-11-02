<div class="flex items-start gap-4">
    <div class="w-12 h-12 rounded-full flex items-center justify-center flex-shrink-0 {{ !$userNotification->is_read ? 'bg-[#00b6b4]/10 text-[#00b6b4]' : 'bg-[#333333] text-[#9ca3af]' }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bell w-6 h-6">
            <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/>
            <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"/>
        </svg>
    </div>
    
    <div class="flex-1 min-w-0">
        <div class="flex items-start justify-between mb-2">
            <h3 class="text-xl font-bold text-[#f5f5f5]">
                {{ $userNotification->notification->title }}
            </h3>
            <div class="flex items-center gap-2">
                @if(!$userNotification->is_read)
                    <button onclick="event.stopPropagation(); markAsRead({{ $userNotification->id }})" class="p-1 text-[#00b6b4] hover:text-[#009e9c] bg-[#00b6b4]/10 rounded-full" title="Marquer comme lu">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check w-4 h-4">
                            <path d="M20 6 9 17l-5-5"/>
                        </svg>
                    </button>
                @endif
                <button onclick="event.stopPropagation(); deleteNotification({{ $userNotification->id }})" class="p-1 text-[#9ca3af] hover:text-red-500 bg-[#333333] rounded-full" title="Supprimer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2 w-4 h-4">
                        <path d="M3 6h18"/>
                        <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
                        <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                    </svg>
                </button>
            </div>
        </div>
        
        @if($userNotification->notification->rich_content && is_array($userNotification->notification->rich_content) && count($userNotification->notification->rich_content) > 0)
            <div class="mb-4 rounded-lg overflow-hidden" style="background-color: {{ $userNotification->notification->background_color ?? '#2b2b2b' }}; padding: 20px; min-height: 200px;">
                @foreach($userNotification->notification->rich_content as $element)
                    @php
                        $baseStyle = 'color: ' . ($element['color'] ?? '#f5f5f5') . '; font-size: ' . ($element['fontSize'] ?? 14) . 'px; font-family: ' . ($element['fontFamily'] ?? 'inherit') . '; margin-bottom: 8px;';
                    @endphp
                    @if($element['type'] === 'title')
                        <div style="{{ $baseStyle }} font-weight: bold; font-size: {{ $element['fontSize'] ?? 18 }}px;">{{ $element['content'] ?? '' }}</div>
                    @elseif($element['type'] === 'text')
                        <div style="{{ $baseStyle }}">{{ $element['content'] ?? '' }}</div>
                    @elseif($element['type'] === 'button')
                        <div style="{{ $baseStyle }} background-color: {{ $element['backgroundColor'] ?? '#00b6b4' }}; color: {{ $element['color'] ?? '#ffffff' }}; padding: 8px 16px; border-radius: 4px; display: inline-block; margin-top: 8px;">{{ $element['content'] ?? '' }}</div>
                    @elseif($element['type'] === 'image')
                        <img src="{{ $element['src'] ?? '' }}" style="max-width: {{ $element['width'] ?? 200 }}px; max-height: 300px; object-fit: contain; margin-top: 8px; margin-bottom: 8px; display: block;" alt="{{ $element['alt'] ?? 'Image' }}" />
                    @elseif($element['type'] === 'emoji')
                        <div style="{{ $baseStyle }} font-size: {{ $element['fontSize'] ?? 24 }}px;">{{ $element['content'] ?? '' }}</div>
                    @elseif($element['type'] === 'icon')
                        @php
                            $iconMap = [
                                'Bell' => '<svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/><path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"/></svg>',
                                'AlertTriangle' => '<svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"/><path d="M12 9v4"/><path d="M12 17h.01"/></svg>',
                                'Info' => '<svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>',
                                'CheckCircle' => '<svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="M22 4 12 14.01l-3-3"/></svg>',
                                'Gift' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-gift w-6 h-6"><rect x="3" y="8" width="18" height="4" rx="1"></rect><path d="M12 8v13"></path><path d="M19 12v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-7"></path><path d="M7.5 8a2.5 2.5 0 0 1 0-5A4.8 8 0 0 1 12 8a4.8 8 0 0 1 4.5-5 2.5 2.5 0 0 1 0 5"></path></svg>',
                                'Clock' => '<svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>',
                                'Star' => '<svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>',
                                'Heart' => '<svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.29 1.51 4.04 3 5.5l7 7Z"/></svg>',
                                'ThumbsUp' => '<svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M7 10v12"/><path d="M15 5.88 14 10h5.83a2 2 0 0 1 1.92 2.56l-2.33 8A2 2 0 0 1 17.5 22H4a2 2 0 0 1-2-2v-8a2 2 0 0 1 2-2h2.76a2 2 0 0 0 1.79-1.11L12 2h0a3.13 3.13 0 0 1 3 3.88Z"/></svg>',
                                'MessageCircle' => '<svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z"/></svg>'
                            ];
                            $iconName = $element['content'] ?? 'Bell';
                            $iconSVG = $iconMap[$iconName] ?? $iconMap['Bell'];
                        @endphp
                        <div style="{{ $baseStyle }} display: inline-block; vertical-align: middle;">
                            {!! $iconSVG !!}
                        </div>
                    @endif
                @endforeach
            </div>
        @else
            <p class="text-[#9ca3af] mb-4">
                {{ $userNotification->notification->message }}
            </p>
        @endif
        
        {{-- Interview Details for interview notifications --}}
        @if(isset($userNotification->interview) && $userNotification->interview)
            <div class="mt-4 mb-4 p-4 bg-[#333333] rounded-lg border border-[#444444]">
                <h4 class="text-sm sm:text-base font-semibold text-[#f5f5f5] mb-3 flex items-center gap-2">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect width="18" height="18" x="3" y="4" rx="2" ry="2"/>
                        <line x1="16" x2="16" y1="2" y2="6"/>
                        <line x1="8" x2="8" y1="2" y2="6"/>
                        <line x1="3" x2="21" y1="10" y2="10"/>
                    </svg>
                    Détails de l'entretien
                </h4>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                    <div class="flex items-start gap-2 sm:gap-3">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-[#00b6b4] flex-shrink-0 mt-0.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="18" height="18" x="3" y="4" rx="2" ry="2"/>
                            <line x1="16" x2="16" y1="2" y2="6"/>
                            <line x1="8" x2="8" y1="2" y2="6"/>
                            <line x1="3" x2="21" y1="10" y2="10"/>
                        </svg>
                        <div>
                            <p class="text-xs text-[#9ca3af]">Date</p>
                            <p class="text-sm font-medium text-[#f5f5f5]">{{ $userNotification->interview->interview_date->format('d/m/Y') }}</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start gap-2 sm:gap-3">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-[#00b6b4] flex-shrink-0 mt-0.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"/>
                            <polyline points="12,6 12,12 16,14"/>
                        </svg>
                        <div>
                            <p class="text-xs text-[#9ca3af]">Heure</p>
                            <p class="text-sm font-medium text-[#f5f5f5]">{{ \Carbon\Carbon::parse($userNotification->interview->start_time)->format('H:i') }} ({{ $userNotification->interview->duration_minutes }} min)</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start gap-2 sm:gap-3">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-[#00b6b4] flex-shrink-0 mt-0.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/>
                            <circle cx="12" cy="10" r="3"/>
                        </svg>
                        <div>
                            <p class="text-xs text-[#9ca3af]">Lieu</p>
                            <p class="text-sm font-medium text-[#f5f5f5]">{{ $userNotification->interview->location }}</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start gap-2 sm:gap-3">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-[#00b6b4] flex-shrink-0 mt-0.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"/>
                            <path d="M6 12H4a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2"/>
                            <path d="M18 9h2a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2h-2"/>
                        </svg>
                        <div>
                            <p class="text-xs text-[#9ca3af]">Entreprise</p>
                            <p class="text-sm font-medium text-[#f5f5f5]">{{ $userNotification->interview->job->company->name ?? 'N/A' }}</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start gap-2 sm:gap-3 sm:col-span-2">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-[#00b6b4] flex-shrink-0 mt-0.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                        </svg>
                        <div>
                            <p class="text-xs text-[#9ca3af]">Poste</p>
                            <p class="text-sm font-medium text-[#f5f5f5]">{{ $userNotification->interview->job->title }}</p>
                        </div>
                    </div>
                    
                    @if($userNotification->interview->type == 'visioconference' && $userNotification->interview->meeting_link)
                        <div class="flex items-start gap-2 sm:gap-3 sm:col-span-2">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-[#00b6b4] flex-shrink-0 mt-0.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                            </svg>
                            <div>
                                <p class="text-xs text-[#9ca3af]">Lien de visioconférence</p>
                                <a href="{{ $userNotification->interview->meeting_link }}" target="_blank" class="text-sm font-medium text-[#00b6b4] hover:text-[#009999] break-all">
                                    {{ $userNotification->interview->meeting_link }}
                                </a>
                            </div>
                        </div>
                    @endif
                    
                    @if($userNotification->interview->notes)
                        <div class="flex items-start gap-2 sm:gap-3 sm:col-span-2">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-[#00b6b4] flex-shrink-0 mt-0.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8Z"/>
                                <path d="M14 2v6h6"/>
                                <path d="M16 13H8"/>
                                <path d="M16 17H8"/>
                                <path d="M10 9H8"/>
                            </svg>
                            <div>
                                <p class="text-xs text-[#9ca3af]">Notes</p>
                                <p class="text-sm text-[#f5f5f5]">{{ $userNotification->interview->notes }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endif
        
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-2 text-sm text-[#666666]">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar w-4 h-4">
                    <path d="M8 2v4"/>
                    <path d="M16 2v4"/>
                    <rect width="18" height="18" x="3" y="4" rx="2"/>
                    <path d="M3 10h18"/>
                </svg>
                <span>{{ $userNotification->created_at->diffForHumans() }}</span>
            </div>
            
            <div class="flex items-center gap-2">
                <span class="px-2 py-1 text-xs rounded-full {{ $userNotification->notification->type === 'info' ? 'bg-blue-900/20 text-blue-400' : ($userNotification->notification->type === 'success' ? 'bg-green-900/20 text-green-400' : ($userNotification->notification->type === 'warning' ? 'bg-yellow-900/20 text-yellow-400' : ($userNotification->notification->type === 'interview' || $userNotification->notification->type === 'interview_update' ? 'bg-purple-900/20 text-purple-400' : 'bg-red-900/20 text-red-400'))) }}">
                    @if($userNotification->notification->type === 'interview')
                        Entretien
                    @elseif($userNotification->notification->type === 'interview_update')
                        Mise à jour
                    @else
                        {{ ucfirst($userNotification->notification->type) }}
                    @endif
                </span>
            </div>
        </div>
    </div>
</div>

