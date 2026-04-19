@props(['interview'])

<div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-4 sm:p-6 shadow-lg hover:shadow-xl transition-all duration-300">
    <div class="flex flex-col lg:flex-row lg:items-center gap-4 sm:gap-6">
        <div class="flex items-start gap-3 sm:gap-4 flex-1 min-w-0">
            <div class="w-12 h-12 sm:w-14 sm:h-14 md:w-16 md:h-16 bg-gradient-to-br from-[#00b6b4] to-[#009999] rounded-full flex items-center justify-center text-white font-bold text-sm sm:text-base md:text-lg flex-shrink-0">
                {{ strtoupper(substr($interview->candidate->name, 0, 2)) }}
            </div>

            <div class="flex-1 min-w-0">
                <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-2 sm:gap-3 mb-2">
                    <div class="flex-1 min-w-0">
                        <h3 class="text-base sm:text-lg md:text-xl font-bold text-[#f5f5f5] truncate">
                            {{ $interview->candidate->name }}
                        </h3>
                        <p class="text-xs sm:text-sm md:text-base text-[#00b6b4] font-medium truncate">
                            {{ $interview->job->title }}
                        </p>
                    </div>
                    <x-status-badge
                        :status="$interview->status"
                        :label="$interview->status_in_french"
                        size="sm"
                        class="flex-shrink-0 self-start sm:self-auto"
                    />
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-2 sm:gap-3 md:gap-4 text-xs sm:text-sm text-[#9ca3af] mb-3 sm:mb-4">
                    <div class="flex items-center gap-2">
                        <svg class="w-3 h-3 sm:w-4 sm:h-4 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                        <span class="truncate">{{ $interview->formatted_date }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-3 h-3 sm:w-4 sm:h-4 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12,6 12,12 16,14"/></svg>
                        <span class="truncate">{{ $interview->full_time }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <x-interview-type-icon :type="$interview->type" />
                        <span class="truncate">{{ $interview->type_in_french }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-3 h-3 sm:w-4 sm:h-4 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                        <span class="truncate">{{ $interview->location }}</span>
                    </div>
                </div>

                <div class="flex items-center gap-2 mb-2 sm:mb-3">
                    @if(!empty($interview->notification_read))
                        <div class="flex items-center gap-2 px-2 sm:px-3 py-1 rounded-full bg-green-400/20 text-green-400 text-xs sm:text-sm">
                            <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                                <path d="m9 11 3 3L22 4"/>
                            </svg>
                            <span>{{ __('Notification lue') }}</span>
                            @if($interview->notification_read_at_human)
                                <span class="text-[#9ca3af]">. {{ $interview->notification_read_at_human }}</span>
                            @endif
                        </div>
                    @else
                        <div class="flex items-center gap-2 px-2 sm:px-3 py-1 rounded-full bg-yellow-400/20 text-yellow-400 text-xs sm:text-sm">
                            <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"/>
                                <line x1="12" x2="12" y1="8" y2="12"/>
                                <line x1="12" x2="12.01" y1="16" y2="16"/>
                            </svg>
                            <span>{{ __('Notification non lue') }}</span>
                        </div>
                    @endif
                </div>

                @if($interview->notes)
                    <div class="bg-[#333333] rounded-lg p-2 sm:p-3 mb-3 sm:mb-4">
                        <p class="text-xs sm:text-sm text-[#9ca3af]">
                            <strong>{{ __('Notes') }}:</strong> {{ $interview->notes }}
                        </p>
                    </div>
                @endif
            </div>
        </div>

        <div class="flex flex-col lg:flex-row lg:items-end items-end gap-2 sm:gap-3">
            <div class="flex items-center gap-2 justify-end w-full sm:w-auto">
                <form method="POST" action="{{ route('recruiter.interviews.update-status', $interview) }}" class="inline flex-1 sm:flex-none">
                    @csrf
                    @method('PUT')
                    <select name="status" onchange="this.form.submit()" class="w-full sm:w-auto text-xs px-2 py-2 sm:py-1 border border-[#444444] rounded bg-[#333333] text-[#f5f5f5] focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none">
                        <option value="programme" {{ $interview->status == 'programme' ? 'selected' : '' }}>{{ __('Programme') }}</option>
                        <option value="confirme" {{ $interview->status == 'confirme' ? 'selected' : '' }}>{{ __('Confirme') }}</option>
                        <option value="en_attente" {{ $interview->status == 'en_attente' ? 'selected' : '' }}>{{ __('En attente') }}</option>
                        <option value="termine" {{ $interview->status == 'termine' ? 'selected' : '' }}>{{ __('Termine') }}</option>
                        <option value="annule" {{ $interview->status == 'annule' ? 'selected' : '' }}>{{ __('Annule') }}</option>
                    </select>
                </form>

                <a href="{{ route('recruiter.interviews.edit', $interview) }}" class="p-1.5 sm:p-2 text-[#9ca3af] hover:text-blue-400 transition-colors duration-200 flex-shrink-0" aria-label="{{ __('Modifier') }}">
                    <svg class="w-7 h-7 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="m18.5 2.5 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                </a>
                <button type="button" onclick="showDeleteModal({{ $interview->id }}, @js($interview->candidate->name))" class="p-1.5 sm:p-2 text-[#9ca3af] hover:text-red-400 transition-colors duration-200 flex-shrink-0" aria-label="{{ __('Supprimer') }}">
                    <svg class="w-7 h-7 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                </button>
            </div>

            <div class="flex flex-row flex-wrap gap-2">
                <button type="button" class="w-full sm:w-auto px-3 sm:px-4 py-2 border border-[#444444] rounded-lg text-[#9ca3af] hover:bg-[#333333] transition-colors flex items-center justify-center gap-1 sm:gap-2 text-xs sm:text-sm">
                    <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                    {{ __('Contacter') }}
                </button>
                @if($interview->type == 'visioconference' && $interview->meeting_link)
                    <a href="{{ $interview->meeting_link }}" target="_blank" class="w-full sm:w-auto bg-[#00b6b4] hover:bg-[#009999] text-white px-3 sm:px-4 py-2 rounded-lg transition-colors text-xs sm:text-sm text-center">
                        {{ __('Rejoindre') }}
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>
