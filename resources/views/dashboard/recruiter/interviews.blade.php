@extends('layouts.dashboard')
@section('page-title', 'Entretiens')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.css" rel="stylesheet">
<style>
/* Simple FullCalendar Dark Theme - Define CSS Variables */
.fc {
    --fc-button-bg-color: #2b2b2b;
    --fc-button-border-color: #444444;
    --fc-button-text-color: #f5f5f5;
    --fc-button-hover-bg-color: #3b3b3b;
    --fc-button-hover-border-color: #555555;
    --fc-button-hover-text-color: #ffffff;
    --fc-button-active-bg-color: #3b3b3b;
    --fc-button-active-border-color: #555555;
    --fc-button-active-text-color: #ffffff;
    --fc-button-disabled-bg-color: #1a1a1a;
    --fc-button-disabled-border-color: #333333;
    --fc-button-disabled-text-color: #666666;
    --fc-event-bg-color: #374151;
    --fc-event-border-color: #374151;
    --fc-event-text-color: #ffffff;
    --fc-today-bg-color: rgba(255, 255, 255, 0.04);
}

.fc,
.fc * {
    box-sizing: border-box;
}

/* Main calendar container */
.fc {
    background: #1f1f1f !important;
    color: #f5f5f5 !important;
    border-radius: 16px !important;
    overflow: hidden !important;
    box-shadow: none !important;
    border: 1px solid #333333 !important;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif !important;
}

.fc-theme-standard .fc-scrollgrid {
    border: 1px solid #333333 !important;
    border-radius: 16px !important;
}

.fc-theme-standard th {
    background: #2b2b2b !important;
    border-color: #333333 !important;
    color: #e5e7eb !important;
    font-weight: 600 !important;
    padding: 16px 12px !important;
    text-transform: none !important;
    font-size: 0.85rem !important;
    letter-spacing: 0 !important;
}

.fc-theme-standard td {
    border-color: #333333 !important;
    background: #1f1f1f !important;
    transition: all 0.2s ease !important;
    color: #ffffff !important;
}

.fc-theme-standard .fc-daygrid-day {
    background: #1f1f1f !important;
    border: 1px solid #333333 !important;
    color: #ffffff !important;
    min-height: 120px !important;
}

.fc-theme-standard .fc-daygrid-day:hover {
    background: #262626 !important;
    border-color: #555555 !important;
}

/* Specific day styling */
.fc-theme-standard .fc-day-other {
    background: #171717 !important;
    border-color: #2b2b2b !important;
}

.fc-theme-standard .fc-day-past {
    opacity: 0.8 !important;
}

.fc-theme-standard .fc-day-future {
    opacity: 1 !important;
}

.fc-theme-standard .fc-day-today {
    background: #2f2f2f !important;
    color: #ffffff !important;
    border: 2px solid #555555 !important;
}

.fc-theme-standard .fc-day-today .fc-daygrid-day-number {
    color: #ffffff !important;
    font-weight: 700 !important;
    font-size: 1rem !important;
    text-shadow: none !important;
}

.fc-theme-standard .fc-daygrid-day-number {
    color: #ffffff !important;
    padding: 12px !important;
    font-weight: 700 !important;
    font-size: 1rem !important;
    transition: all 0.2s ease !important;
    text-shadow: none !important;
    background: transparent !important;
    border: none !important;
    text-decoration: none !important;
}

.fc-theme-standard .fc-daygrid-day-number:hover {
    color: #e5e7eb !important;
    transform: none !important;
    text-shadow: none !important;
    background: transparent !important;
}

/* Specific styling for different day types */
.fc-theme-standard .fc-day-other .fc-daygrid-day-number {
    color: #6b7280 !important;
    opacity: 0.7 !important;
    font-weight: 500 !important;
}

.fc-theme-standard .fc-day-past .fc-daygrid-day-number {
    color: #9ca3af !important;
    opacity: 0.8 !important;
}

.fc-theme-standard .fc-day-future .fc-daygrid-day-number {
    color: #ffffff !important;
    opacity: 1 !important;
    font-weight: 700 !important;
}

.fc-theme-standard .fc-day-today .fc-daygrid-day-number {
    color: #ffffff !important;
    font-weight: 800 !important;
    font-size: 1.1rem !important;
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3) !important;
}

.fc-theme-standard .fc-col-header-cell {
    background: #2b2b2b !important;
    color: #e5e7eb !important;
    font-weight: 600 !important;
    text-transform: none !important;
    font-size: 0.85rem !important;
    letter-spacing: 0 !important;
}

/* Button styling - Override FullCalendar variables */
.fc-button,
.fc-button-primary {
    background-color: var(--fc-button-bg-color) !important;
    border-color: var(--fc-button-border-color) !important;
    color: var(--fc-button-text-color) !important;
    border-radius: 8px !important;
    font-weight: 600 !important;
    padding: 8px 12px !important;
    transition: all 0.3s ease !important;
    font-size: 0.875rem !important;
    text-transform: none !important;
}

.fc-button:hover,
.fc-button-primary:hover {
    background-color: var(--fc-button-hover-bg-color) !important;
    border-color: var(--fc-button-hover-border-color) !important;
    color: var(--fc-button-hover-text-color) !important;
    transform: translateY(-2px) !important;
}

.fc-button:focus,
.fc-button-primary:focus {
    outline: none !important;
}

.fc-button-primary:not(:disabled).fc-button-active,
.fc-dayGridMonth-button.fc-button-active,
.fc-timeGridWeek-button.fc-button-active,
.fc-timeGridDay-button.fc-button-active {
    background-color: var(--fc-button-active-bg-color) !important;
    border-color: var(--fc-button-active-border-color) !important;
    color: var(--fc-button-active-text-color) !important;
}

.fc-button:disabled,
.fc-button-primary:disabled {
    background-color: var(--fc-button-disabled-bg-color) !important;
    border-color: var(--fc-button-disabled-border-color) !important;
    color: var(--fc-button-disabled-text-color) !important;
    opacity: 0.5 !important;
    cursor: not-allowed !important;
}

/* Button icons */
.fc-icon,
.fc-icon-chevron-left,
.fc-icon-chevron-right {
    color: inherit !important;
}

.fc-theme-standard .fc-toolbar-title {
    color: #f5f5f5 !important;
    font-size: 1.75rem !important;
    font-weight: 700 !important;
    text-shadow: none !important;
    letter-spacing: 0 !important;
}

.fc-theme-standard .fc-event {
    border-radius: 8px !important;
    border: none !important;
    font-size: 11px !important;
    font-weight: 600 !important;
    padding: 4px 8px !important;
    margin: 2px 0 !important;
    box-shadow: none !important;
    text-shadow: none !important;
    transition: background-color 0.2s ease, border-color 0.2s ease !important;
    cursor: pointer !important;
}

.fc-theme-standard .fc-event:hover {
    transform: none !important;
    box-shadow: none !important;
    opacity: 1 !important;
}

.fc-theme-standard .fc-daygrid-event {
    margin: 2px 3px !important;
}

.fc-theme-standard .fc-more-link {
    color: #9ca3af !important;
    font-weight: 600 !important;
    text-decoration: none !important;
    padding: 4px 8px !important;
    border-radius: 4px !important;
    transition: background-color 0.2s ease !important;
    background: #2b2b2b !important;
}

.fc-theme-standard .fc-more-link:hover {
    color: #f5f5f5 !important;
    background: #333333 !important;
    text-decoration: none !important;
}

/* Event status colors - Site theme colors - High specificity to override FullCalendar styles */
.fc-theme-standard .fc-event[data-status="programme"],
.fc-event[data-status="programme"],
.fc-daygrid-event[data-status="programme"],
.fc-daygrid-block-event[data-status="programme"] {
    background-color: #374151 !important;
    border-color: #374151 !important;
    color: #ffffff !important;
}

.fc-theme-standard .fc-event[data-status="programme"]:hover,
.fc-event[data-status="programme"]:hover {
    background-color: #4b5563 !important;
    border-color: #4b5563 !important;
}

.fc-theme-standard .fc-event[data-status="confirme"],
.fc-event[data-status="confirme"],
.fc-daygrid-event[data-status="confirme"],
.fc-daygrid-block-event[data-status="confirme"] {
    background-color: #16a34a !important;
    border-color: #16a34a !important;
    color: #ffffff !important;
}

.fc-theme-standard .fc-event[data-status="confirme"]:hover,
.fc-event[data-status="confirme"]:hover {
    background-color: #15803d !important;
    border-color: #15803d !important;
}

.fc-theme-standard .fc-event[data-status="en_attente"],
.fc-event[data-status="en_attente"],
.fc-daygrid-event[data-status="en_attente"],
.fc-daygrid-block-event[data-status="en_attente"] {
    background-color: #d97706 !important;
    border-color: #d97706 !important;
    color: #1a1a1a !important;
}

.fc-theme-standard .fc-event[data-status="en_attente"]:hover,
.fc-event[data-status="en_attente"]:hover {
    background-color: #b45309 !important;
    border-color: #b45309 !important;
}

.fc-theme-standard .fc-event[data-status="annule"],
.fc-event[data-status="annule"],
.fc-daygrid-event[data-status="annule"],
.fc-daygrid-block-event[data-status="annule"] {
    background-color: #ef4444 !important;
    border-color: #ef4444 !important;
    color: #ffffff !important;
}

.fc-theme-standard .fc-event[data-status="annule"]:hover,
.fc-event[data-status="annule"]:hover {
    background-color: #dc2626 !important;
    border-color: #dc2626 !important;
}

.fc-theme-standard .fc-event[data-status="termine"],
.fc-event[data-status="termine"],
.fc-daygrid-event[data-status="termine"],
.fc-daygrid-block-event[data-status="termine"] {
    background-color: #6b7280 !important;
    border-color: #6b7280 !important;
    color: #ffffff !important;
}

.fc-theme-standard .fc-event[data-status="termine"]:hover,
.fc-event[data-status="termine"]:hover {
    background-color: #4b5563 !important;
    border-color: #4b5563 !important;
}

/* Default event color if no status */
.fc-theme-standard .fc-event:not([data-status]),
.fc-event:not([data-status]) {
    background-color: #00b6b4 !important;
    border-color: #00b6b4 !important;
    color: #ffffff !important;
}

/* Override FullCalendar's event text colors */
.fc-event-main[data-status="programme"],
.fc-event-main[data-status="confirme"],
.fc-event-main[data-status="annule"],
.fc-event-main[data-status="termine"] {
    color: #ffffff !important;
}

.fc-event-main[data-status="en_attente"] {
    color: #1a1a1a !important;
}

.fc-event-title {
    color: inherit !important;
}

.fc-event-time {
    color: inherit !important;
    opacity: 0.9 !important;
}

/* Additional calendar styling */
.fc-theme-standard .fc-scrollgrid-sync-table {
    border-collapse: separate !important;
    border-spacing: 0 !important;
}

.fc-theme-standard .fc-daygrid-day-frame {
    min-height: 120px !important;
}

.fc-theme-standard .fc-daygrid-day-events {
    margin-top: 4px !important;
}

.fc-theme-standard .fc-daygrid-day-top {
    flex-direction: row !important;
    justify-content: flex-start !important;
}

.fc-theme-standard .fc-daygrid-day-number {
    margin: 0 !important;
}

/* Popover styling */
.fc-theme-standard .fc-popover {
    background: #2b2b2b !important;
    border: 1px solid #444444 !important;
    border-radius: 12px !important;
    box-shadow: none !important;
}

.fc-theme-standard .fc-popover-header {
    background: #333333 !important;
    color: #ffffff !important;
    border-bottom: none !important;
    padding: 16px 20px !important;
    font-weight: 600 !important;
    border-radius: 12px 12px 0 0 !important;
}

.fc-theme-standard .fc-popover-body {
    background: transparent !important;
    color: #f5f5f5 !important;
    padding: 16px 20px !important;
}

/* Scrollbar styling */
.fc-theme-standard .fc-scroller::-webkit-scrollbar {
    width: 10px !important;
    height: 10px !important;
}

.fc-theme-standard .fc-scroller::-webkit-scrollbar-track {
    background: #2b2b2b !important;
    border-radius: 5px !important;
}

.fc-theme-standard .fc-scroller::-webkit-scrollbar-thumb {
    background: #555555 !important;
    border-radius: 5px !important;
}

.fc-theme-standard .fc-scroller::-webkit-scrollbar-thumb:hover {
    background: #666666 !important;
}

/* Additional text visibility improvements */
.fc-theme-standard .fc-day-other {
    background: #171717 !important;
    color: #6b7280 !important;
}

.fc-theme-standard .fc-day-other .fc-daygrid-day-number {
    color: #6b7280 !important;
    opacity: 0.7 !important;
}

.fc-theme-standard .fc-day-past {
    opacity: 0.8 !important;
}

.fc-theme-standard .fc-day-future {
    opacity: 1 !important;
}

/* Month/year text in header */
.fc-theme-standard .fc-toolbar-title,
.fc-toolbar-title {
    color: #f5f5f5 !important;
    font-size: 1.75rem !important;
    font-weight: 800 !important;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5) !important;
    letter-spacing: -0.5px !important;
}

/* All text elements */
.fc-col-header-cell a,
.fc-col-header-cell-cushion {
    color: #ffffff !important;
    text-decoration: none !important;
}

.fc-daygrid-day-number,
.fc-daygrid-day-number a {
    color: #ffffff !important;
}

/* Ensure all text is visible */
.fc-event-main,
.fc-event-title {
    color: #ffffff !important;
}

.fc-event-time {
    color: rgba(255, 255, 255, 0.9) !important;
}

/* Weekday names */
.fc-theme-standard .fc-col-header-cell {
    background: #2b2b2b !important;
    color: #e5e7eb !important;
    font-weight: 600 !important;
    text-transform: none !important;
    font-size: 0.85rem !important;
    letter-spacing: 0 !important;
}

/* Force day number styling - override any conflicting styles */
.fc-daygrid-day-number,
.fc-daygrid-day-number:link,
.fc-daygrid-day-number:visited,
.fc-daygrid-day-number:hover,
.fc-daygrid-day-number:active {
    color: #ffffff !important;
    text-decoration: none !important;
    background: transparent !important;
    border: none !important;
    outline: none !important;
    box-shadow: none !important;
}

/* Ensure proper contrast for all day numbers */
.fc-daygrid-day .fc-daygrid-day-number {
    color: #ffffff !important;
    font-weight: 700 !important;
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.5) !important;
}

.fc-day-other .fc-daygrid-day-number {
    color: #6b7280 !important;
    opacity: 0.7 !important;
    font-weight: 500 !important;
}

.fc-day-past .fc-daygrid-day-number {
    color: #9ca3af !important;
    opacity: 0.8 !important;
}

.fc-day-future .fc-daygrid-day-number {
    color: #ffffff !important;
    opacity: 1 !important;
    font-weight: 700 !important;
}

.fc-day-today .fc-daygrid-day-number {
    color: #ffffff !important;
    font-weight: 800 !important;
    font-size: 1.1rem !important;
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3) !important;
}

/* Mobile Responsive Calendar Styles */
@media (max-width: 640px) {
    .fc {
        font-size: 12px !important;
        border-radius: 12px !important;
    }
    
    .fc-theme-standard th,
    .fc-col-header-cell {
        padding: 8px 2px !important;
        font-size: 0.65rem !important;
        text-transform: capitalize !important;
    }
    
    .fc-theme-standard .fc-daygrid-day {
        min-height: 70px !important;
    }
    
    .fc-theme-standard .fc-daygrid-day-number {
        padding: 4px 6px !important;
        font-size: 0.75rem !important;
    }
    
    .fc-theme-standard .fc-toolbar,
    .fc-header-toolbar {
        flex-direction: column !important;
        gap: 10px !important;
        padding: 10px !important;
    }
    
    .fc-theme-standard .fc-toolbar-chunk,
    .fc-toolbar-chunk {
        display: flex !important;
        justify-content: center !important;
        align-items: center !important;
        gap: 4px !important;
        width: 100% !important;
    }
    
    .fc-theme-standard .fc-toolbar-title,
    .fc-toolbar-title {
        font-size: 1rem !important;
        text-align: center !important;
        color: #f5f5f5 !important;
        margin: 0 !important;
        padding: 8px 0 !important;
    }
    
    .fc-button,
    .fc-button-primary,
    .fc-prev-button,
    .fc-next-button,
    .fc-today-button,
    .fc-dayGridMonth-button,
    .fc-timeGridWeek-button,
    .fc-timeGridDay-button {
        padding: 6px 10px !important;
        font-size: 0.7rem !important;
        min-width: auto !important;
    }
    
    .fc-button-group {
        display: flex !important;
        gap: 4px !important;
    }
    
    .fc-theme-standard .fc-event {
        font-size: 8px !important;
        padding: 1px 3px !important;
        margin: 1px 0 !important;
        line-height: 1.2 !important;
    }
    
    .fc-theme-standard .fc-daygrid-event {
        margin: 1px 2px !important;
    }
    
    .fc-theme-standard .fc-daygrid-day-frame {
        min-height: 70px !important;
    }
    
    .fc-theme-standard .fc-scrollgrid-sync-table {
        font-size: 10px !important;
    }
    
    .fc-event-title {
        font-size: 8px !important;
        white-space: nowrap !important;
        overflow: hidden !important;
        text-overflow: ellipsis !important;
    }
    
    .fc-event-time {
        font-size: 7px !important;
        display: block !important;
    }

    #calendarView {
        position: relative;
        z-index: 10;
        overflow: visible !important;
        isolation: isolate;
    }

    #calendar {
        position: relative;
        z-index: 11;
    }

    .fc-theme-standard .fc-toolbar,
    .fc-header-toolbar,
    .fc-toolbar-chunk,
    .fc-button-group,
    .fc-button {
        position: relative;
        z-index: 20;
        pointer-events: auto !important;
    }
    
    /* Hide some buttons on mobile */
    .fc-timeGridWeek-button,
    .fc-timeGridDay-button {
        display: none !important;
    }
}

/* Tablet Responsive Calendar Styles */
@media (min-width: 641px) and (max-width: 1024px) {
    .fc-theme-standard .fc-daygrid-day {
        min-height: 100px !important;
    }
    
    .fc-theme-standard .fc-daygrid-day-frame {
        min-height: 100px !important;
    }
    
    .fc-theme-standard th {
        padding: 12px 8px !important;
        font-size: 0.75rem !important;
    }
    
    .fc-theme-standard .fc-toolbar-title {
        font-size: 1.5rem !important;
    }
}

/* Improved Event Colors for Better Visibility */
.fc-event[data-status="programme"] {
    background: #374151 !important;
    color: #ffffff !important;
    border: 1px solid #374151 !important;
}

.fc-event[data-status="confirme"] {
    background: #16a34a !important;
    color: #ffffff !important;
    border: 1px solid #16a34a !important;
}

.fc-event[data-status="en_attente"] {
    background: #d97706 !important;
    color: #1a1a1a !important;
    border: 1px solid #d97706 !important;
}

.fc-event[data-status="annule"] {
    background: #ef4444 !important;
    color: #ffffff !important;
    border: 1px solid #ef4444 !important;
}

.fc-event[data-status="termine"] {
    background: #6b7280 !important;
    color: #ffffff !important;
    border: 1px solid #6b7280 !important;
}

</style>
@endpush

@section('content')
<div class="space-y-4 sm:space-y-6 md:space-y-8">
    {{-- Header --}}
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-3 sm:gap-4">
        <div class="flex-1 min-w-0">
            <h1 class="text-xl sm:text-2xl md:text-3xl font-bold text-[#f5f5f5]">
                {{ __('Entretiens') }}
            </h1>
            <p class="text-xs sm:text-sm md:text-base text-[#9ca3af] mt-1 sm:mt-2">
                {{ __('Planifiez et gerez vos entretiens candidats') }}
            </p>
        </div>
        <div class="flex items-center gap-2 sm:gap-3 flex-shrink-0 flex-wrap">
            <div class="flex bg-[#333333] rounded-lg p-1">
                <button id="listView" class="px-2 sm:px-3 md:px-4 py-1.5 sm:py-2 rounded-md text-xs sm:text-sm font-medium transition-colors bg-[#2b2b2b] text-[#f5f5f5] shadow-sm">
                    {{ __('Liste') }}
                </button>
                <button id="calendarViewBtn" class="px-2 sm:px-3 md:px-4 py-1.5 sm:py-2 rounded-md text-xs sm:text-sm font-medium transition-colors text-[#9ca3af]">
                    {{ __('Calendrier') }}
                </button>
            </div>
            <a href="{{ route('recruiter.interviews.create') }}" class="bg-[#00b6b4] hover:bg-[#009999] text-white px-3 sm:px-4 md:px-6 py-2 sm:py-3 rounded-lg transition-colors flex items-center gap-1 sm:gap-2 text-xs sm:text-sm md:text-base">
                <svg class="w-3 h-3 sm:w-4 sm:h-5 md:w-5 md:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                <span class="hidden sm:inline">{{ __('Programmer entretien') }}</span>
                <span class="sm:hidden">{{ __('Programmer') }}</span>
            </a>
        </div>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="bg-green-500/10 border border-green-500/20 rounded-lg p-3 sm:p-4 flex items-center gap-2 sm:gap-3">
            <svg class="w-7 h-7 sm:w-5 sm:h-5 text-green-400 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
            </svg>
            <p class="text-xs sm:text-sm md:text-base text-green-400">{{ session('success') }}</p>
        </div>
    @endif

    {{-- Stats Cards --}}
    <div class="grid grid-cols-2 lg:grid-cols-5 gap-3 sm:gap-4 md:gap-6">
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-3 sm:p-4 md:p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs sm:text-sm text-[#9ca3af]">{{ __('Total') }}</p>
                    <p class="text-lg sm:text-xl md:text-2xl font-bold text-[#f5f5f5]">{{ $stats['total'] }}</p>
                </div>
                <div class="w-8 h-8 sm:w-10 sm:h-10 md:w-12 md:h-12 bg-[#ffffff] rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar w-7 h-7 sm:w-5 sm:h-5 md:w-6 md:h-6 text-[#9ca3af]"><path d="M8 2v4"></path><path d="M16 2v4"></path><rect width="18" height="18" x="3" y="4" rx="2"></rect><path d="M3 10h18"></path></svg>
                </div>
            </div>
        </div>

        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-3 sm:p-4 md:p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs sm:text-sm text-[#9ca3af]">{{ __('Programmes') }}</p>
                    <p class="text-lg sm:text-xl md:text-2xl font-bold text-blue-600">{{ $stats['programme'] }}</p>
                </div>
                <div class="w-8 h-8 sm:w-10 sm:h-10 md:w-12 md:h-12 bg-blue-100 rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock w-7 h-7 sm:w-5 sm:h-5 md:w-6 md:h-6 text-blue-600"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                </div>
            </div>
        </div>

        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-3 sm:p-4 md:p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs sm:text-sm text-[#9ca3af]">{{ __('Confirmes') }}</p>
                    <p class="text-lg sm:text-xl md:text-2xl font-bold text-green-600">{{ $stats['confirme'] }}</p>
                </div>
                <div class="w-8 h-8 sm:w-10 sm:h-10 md:w-12 md:h-12 bg-green-100 rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check-circle w-7 h-7 sm:w-5 sm:h-5 md:w-6 md:h-6 text-green-600"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><path d="m9 11 3 3L22 4"></path></svg>
                </div>
            </div>
        </div>

        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-3 sm:p-4 md:p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs sm:text-sm text-[#9ca3af]">{{ __('En attente') }}</p>
                    <p class="text-lg sm:text-xl md:text-2xl font-bold text-yellow-600">{{ $stats['en_attente'] }}</p>
                </div>
                <div class="w-8 h-8 sm:w-10 sm:h-10 md:w-12 md:h-12 bg-yellow-100 rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock w-7 h-7 sm:w-5 sm:h-5 md:w-6 md:h-6 text-yellow-600"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                </div>
            </div>
        </div>

        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-3 sm:p-4 md:p-6 shadow-lg col-span-2 lg:col-span-1">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs sm:text-sm text-[#9ca3af]">{{ __('Annules') }}</p>
                    <p class="text-lg sm:text-xl md:text-2xl font-bold text-red-600">{{ $stats['annule'] }}</p>
                </div>
                <div class="w-8 h-8 sm:w-10 sm:h-10 md:w-12 md:h-12 bg-red-100 rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x-circle w-7 h-7 sm:w-5 sm:h-5 md:w-6 md:h-6 text-red-600"><circle cx="12" cy="12" r="10"></circle><path d="m15 9-6 6"></path><path d="m9 9 6 6"></path></svg>
                </div>
            </div>
        </div>
    </div>

    {{-- Filters --}}
    <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-3 sm:p-4 md:p-6 shadow-lg">
        <form method="GET" action="{{ route('recruiter.interviews') }}" class="flex flex-col lg:flex-row gap-3 sm:gap-4">
            <div class="flex-1 relative">
                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-[#9ca3af] w-7 h-7 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Rechercher par candidat ou poste..."
                    class="w-full pl-8 sm:pl-10 pr-4 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5] text-xs sm:text-sm md:text-base"
                />
            </div>
            <div class="relative">
                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-[#9ca3af] w-7 h-7 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="22,3 2,3 10,12.46 10,19 14,21 14,12.46 22,3"/></svg>
                <select name="status" class="w-full lg:min-w-[200px] pl-8 sm:pl-10 pr-8 py-2 sm:py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none appearance-none bg-[#333333] text-[#f5f5f5] text-xs sm:text-sm md:text-base">
                    <option value="">{{ __('Tous les statuts') }}</option>
                    <option value="Programmé" {{ request('status') == 'Programmé' ? 'selected' : '' }}>{{ __('Programme') }}</option>
                    <option value="Confirmé" {{ request('status') == 'Confirmé' ? 'selected' : '' }}>{{ __('Confirme') }}</option>
                    <option value="En attente" {{ request('status') == 'En attente' ? 'selected' : '' }}>{{ __('En attente') }}</option>
                    <option value="Terminé" {{ request('status') == 'Terminé' ? 'selected' : '' }}>{{ __('Termine') }}</option>
                    <option value="Annulé" {{ request('status') == 'Annulé' ? 'selected' : '' }}>{{ __('Annule') }}</option>
                </select>
            </div>
            <div class="flex gap-2">
                <button type="submit" class="bg-[#00b6b4] hover:bg-[#009999] text-white px-3 sm:px-4 md:px-6 py-2 sm:py-3 rounded-lg transition-colors flex items-center gap-1 sm:gap-2 text-xs sm:text-sm md:text-base">
                    <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
                    <span class="hidden sm:inline">{{ __('Rechercher') }}</span>
                    <span class="sm:hidden">{{ __('Recherche') }}</span>
                </button>
                <a href="{{ route('recruiter.interviews') }}" class="px-3 sm:px-4 py-2 sm:py-3 border border-[#444444] rounded-lg text-[#9ca3af] hover:bg-[#333333] transition-colors flex items-center justify-center">
                    <svg class="w-3 h-3 sm:w-4 sm:h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6L6 18"/><path d="M6 6l12 12"/></svg>
                </a>
        </div>
        </form>
    </div>

    <div id="interviewsList">
        {{-- Interviews List --}}
        @include('dashboard.recruiter.partials.interviews.list', ['interviews' => $interviews])
                            
        {{-- Pagination --}}
        @if($interviews->hasPages())
            <div class="mt-6 sm:mt-8">
                {{ $interviews->appends(request()->query())->links() }}
            </div>
        @endif
    </div>


    {{-- Calendar View --}}
    <div id="calendarView" class="rounded-2xl p-2 sm:p-4 md:p-6 lg:p-8 hidden overflow-visible">
        <div id="calendar" class="min-w-[300px] sm:min-w-full min-h-[700px] bg-[#1f1f1f] rounded-xl"></div>
    </div>

    @include('dashboard.recruiter.partials.interviews.delete-modal')

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>
<script>
window.recruiterInterviewsConfig = {
    calendarFeedUrl: "{{ route('recruiter.interviews.calendar') }}",
    interviewsUrl: "{{ route('recruiter.interviews') }}",
    destroyBaseUrl: "{{ url('/recruiter/interviews') }}"
};
</script>
<script src="{{ asset('js/recruiter-interviews.js') }}"></script>
@endsection
@endsection

