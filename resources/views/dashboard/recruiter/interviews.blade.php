@extends('layouts.dashboard')
@section('page-title', 'Entretiens')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.css" rel="stylesheet">
<style>
/* Custom FullCalendar Site Theme */
.fc {
    background: linear-gradient(135deg, #1a1a1a 0%, #2b2b2b 100%) !important;
    color: #f5f5f5 !important;
    border-radius: 16px !important;
    overflow: hidden !important;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3) !important;
    border: 1px solid #333333 !important;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif !important;
}

.fc-theme-standard .fc-scrollgrid {
    border: 1px solid #00b6b4 !important;
    border-radius: 16px !important;
}

.fc-theme-standard th {
    background: linear-gradient(135deg, #00b6b4 0%, #009999 100%) !important;
    border-color: #00b6b4 !important;
    color: #ffffff !important;
    font-weight: 700 !important;
    padding: 16px 12px !important;
    text-transform: uppercase !important;
    font-size: 0.8rem !important;
    letter-spacing: 1px !important;
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3) !important;
}

.fc-theme-standard td {
    border-color: #333333 !important;
    background: linear-gradient(135deg, #2b2b2b 0%, #1a1a1a 100%) !important;
    transition: all 0.2s ease !important;
    color: #ffffff !important;
}

.fc-theme-standard .fc-daygrid-day {
    background: linear-gradient(135deg, #2b2b2b 0%, #1a1a1a 100%) !important;
    border: 1px solid #333333 !important;
    color: #ffffff !important;
    min-height: 120px !important;
}

.fc-theme-standard .fc-daygrid-day:hover {
    background: linear-gradient(135deg, #333333 0%, #2b2b2b 100%) !important;
    border-color: #00b6b4 !important;
    transform: scale(1.02) !important;
    box-shadow: 0 4px 8px rgba(0, 182, 180, 0.2) !important;
}

/* Specific day styling */
.fc-theme-standard .fc-day-other {
    background: linear-gradient(135deg, #1a1a1a 0%, #0f0f0f 100%) !important;
    border-color: #2b2b2b !important;
}

.fc-theme-standard .fc-day-past {
    background: linear-gradient(135deg, #2b2b2b 0%, #1a1a1a 100%) !important;
    opacity: 0.8 !important;
}

.fc-theme-standard .fc-day-future {
    background: linear-gradient(135deg, #2b2b2b 0%, #1a1a1a 100%) !important;
    opacity: 1 !important;
}

.fc-theme-standard .fc-day-today {
    background: linear-gradient(135deg, #00b6b4 0%, #009999 100%) !important;
    color: #ffffff !important;
    border: 2px solid #00b6b4 !important;
    box-shadow: 0 4px 12px rgba(0, 182, 180, 0.3) !important;
}

.fc-theme-standard .fc-day-today .fc-daygrid-day-number {
    color: #ffffff !important;
    font-weight: 800 !important;
    font-size: 1.1rem !important;
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3) !important;
}

.fc-theme-standard .fc-daygrid-day-number {
    color: #ffffff !important;
    padding: 12px !important;
    font-weight: 700 !important;
    font-size: 1rem !important;
    transition: all 0.2s ease !important;
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.5) !important;
    background: transparent !important;
    border: none !important;
    text-decoration: none !important;
}

.fc-theme-standard .fc-daygrid-day-number:hover {
    color: #00b6b4 !important;
    transform: scale(1.1) !important;
    text-shadow: 0 2px 4px rgba(0, 182, 180, 0.5) !important;
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
    background: linear-gradient(135deg, #00b6b4 0%, #009999 100%) !important;
    color: #ffffff !important;
    font-weight: 700 !important;
    text-transform: uppercase !important;
    font-size: 0.8rem !important;
    letter-spacing: 1px !important;
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3) !important;
}

.fc-theme-standard .fc-button {
    background: linear-gradient(135deg, #333333 0%, #2b2b2b 100%) !important;
    border: 1px solid #00b6b4 !important;
    color: #f5f5f5 !important;
    border-radius: 8px !important;
    font-weight: 600 !important;
    padding: 10px 16px !important;
    transition: all 0.3s ease !important;
    text-transform: uppercase !important;
    font-size: 0.75rem !important;
    letter-spacing: 0.5px !important;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2) !important;
}

.fc-theme-standard .fc-button:hover {
    background: linear-gradient(135deg, #00b6b4 0%, #009999 100%) !important;
    border-color: #00b6b4 !important;
    color: #ffffff !important;
    transform: translateY(-2px) !important;
    box-shadow: 0 6px 12px rgba(0, 182, 180, 0.4) !important;
}

.fc-theme-standard .fc-button:focus {
    box-shadow: 0 0 0 3px rgba(0, 182, 180, 0.3) !important;
    outline: none !important;
}

.fc-theme-standard .fc-button-primary:not(:disabled).fc-button-active {
    background: linear-gradient(135deg, #00b6b4 0%, #009999 100%) !important;
    border-color: #00b6b4 !important;
    color: #ffffff !important;
    box-shadow: 0 4px 8px rgba(0, 182, 180, 0.3) !important;
}

.fc-theme-standard .fc-toolbar-title {
    color: #f5f5f5 !important;
    font-size: 1.75rem !important;
    font-weight: 800 !important;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3) !important;
    letter-spacing: -0.5px !important;
}

.fc-theme-standard .fc-event {
    border-radius: 8px !important;
    border: none !important;
    font-size: 11px !important;
    font-weight: 600 !important;
    padding: 4px 8px !important;
    margin: 2px 0 !important;
    box-shadow: 0 3px 6px rgba(0, 0, 0, 0.3) !important;
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3) !important;
    transition: all 0.3s ease !important;
    cursor: pointer !important;
}

.fc-theme-standard .fc-event:hover {
    transform: translateY(-2px) !important;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.4) !important;
    opacity: 0.95 !important;
}

.fc-theme-standard .fc-daygrid-event {
    margin: 2px 3px !important;
}

.fc-theme-standard .fc-more-link {
    color: #00b6b4 !important;
    font-weight: 600 !important;
    text-decoration: none !important;
    padding: 4px 8px !important;
    border-radius: 4px !important;
    transition: all 0.2s ease !important;
    background: rgba(0, 182, 180, 0.1) !important;
}

.fc-theme-standard .fc-more-link:hover {
    color: #009999 !important;
    background: rgba(0, 182, 180, 0.2) !important;
    text-decoration: none !important;
}

/* Event status colors with gradients */
.fc-event[data-status="programme"] {
    background: linear-gradient(135deg, #00b6b4 0%, #009999 100%) !important;
    color: #ffffff !important;
}

.fc-event[data-status="confirme"] {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
    color: #ffffff !important;
}

.fc-event[data-status="en_attente"] {
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%) !important;
    color: #1a1a1a !important;
}

.fc-event[data-status="annule"] {
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%) !important;
    color: #ffffff !important;
}

.fc-event[data-status="termine"] {
    background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%) !important;
    color: #ffffff !important;
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
    background: linear-gradient(135deg, #2b2b2b 0%, #333333 100%) !important;
    border: 2px solid #00b6b4 !important;
    border-radius: 12px !important;
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.6) !important;
    backdrop-filter: blur(10px) !important;
}

.fc-theme-standard .fc-popover-header {
    background: linear-gradient(135deg, #00b6b4 0%, #009999 100%) !important;
    color: #ffffff !important;
    border-bottom: none !important;
    padding: 16px 20px !important;
    font-weight: 700 !important;
    border-radius: 12px 12px 0 0 !important;
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3) !important;
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
    background: linear-gradient(135deg, #00b6b4 0%, #009999 100%) !important;
    border-radius: 5px !important;
}

.fc-theme-standard .fc-scroller::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(135deg, #009999 0%, #007a7a 100%) !important;
}

/* Additional text visibility improvements */
.fc-theme-standard .fc-day-other {
    background: linear-gradient(135deg, #1a1a1a 0%, #0f0f0f 100%) !important;
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
.fc-theme-standard .fc-toolbar-title {
    color: #ffffff !important;
    font-size: 1.75rem !important;
    font-weight: 800 !important;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5) !important;
    letter-spacing: -0.5px !important;
}

/* Weekday names */
.fc-theme-standard .fc-col-header-cell {
    background: linear-gradient(135deg, #00b6b4 0%, #009999 100%) !important;
    color: #ffffff !important;
    font-weight: 700 !important;
    text-transform: uppercase !important;
    font-size: 0.8rem !important;
    letter-spacing: 1px !important;
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.5) !important;
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

</style>
@endpush

@section('content')
<div class="space-y-8">
    {{-- Header --}}
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-[#f5f5f5]">
                Entretiens
            </h1>
            <p class="text-[#9ca3af] mt-2">
                Planifiez et gérez vos entretiens candidats
            </p>
        </div>
        <div class="flex items-center gap-3">
            <div class="flex bg-[#333333] rounded-lg p-1">
                <button id="listView" class="px-4 py-2 rounded-md text-sm font-medium transition-colors bg-[#2b2b2b] text-[#f5f5f5] shadow-sm">
                    Liste
                </button>
                <button id="calendarViewBtn" class="px-4 py-2 rounded-md text-sm font-medium transition-colors text-[#9ca3af]">
                    Calendrier
                </button>
            </div>
            <a href="{{ route('recruiter.interviews.create') }}" class="bg-[#00b6b4] hover:bg-[#009999] text-white px-6 py-3 rounded-lg transition-colors flex items-center gap-2">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                Programmer entretien
            </a>
        </div>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="bg-green-500/10 border border-green-500/20 rounded-lg p-4 flex items-center gap-3">
            <svg class="w-5 h-5 text-green-400 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
            </svg>
            <p class="text-green-400">{{ session('success') }}</p>
        </div>
    @endif

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-[#9ca3af]">Total</p>
                    <p class="text-2xl font-bold text-[#f5f5f5]">{{ $stats['total'] }}</p>
                </div>
                <div class="w-12 h-12 bg-[#ffffff] rounded-xl flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar w-6 h-6 text-[#9ca3af]"><path d="M8 2v4"></path><path d="M16 2v4"></path><rect width="18" height="18" x="3" y="4" rx="2"></rect><path d="M3 10h18"></path></svg>
                </div>
            </div>
        </div>

        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-[#9ca3af]">Programmés</p>
                    <p class="text-2xl font-bold text-blue-600">{{ $stats['programme'] }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock w-6 h-6 text-blue-600"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                </div>
            </div>
        </div>

        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-[#9ca3af]">Confirmés</p>
                    <p class="text-2xl font-bold text-green-600">{{ $stats['confirme'] }}</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check-circle w-6 h-6 text-green-600"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><path d="m9 11 3 3L22 4"></path></svg>
                </div>
            </div>
        </div>

        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-[#9ca3af]">En attente</p>
                    <p class="text-2xl font-bold text-yellow-600">{{ $stats['en_attente'] }}</p>
                </div>
                <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock w-6 h-6 text-yellow-600"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                </div>
            </div>
        </div>

        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-[#9ca3af]">Annulés</p>
                    <p class="text-2xl font-bold text-red-600">{{ $stats['annule'] }}</p>
                </div>
                <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x-circle w-6 h-6 text-red-600"><circle cx="12" cy="12" r="10"></circle><path d="m15 9-6 6"></path><path d="m9 9 6 6"></path></svg>
                </div>
            </div>
        </div>
    </div>

    {{-- Filters --}}
    <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-6 shadow-lg">
        <form method="GET" action="{{ route('recruiter.interviews') }}" class="flex flex-col lg:flex-row gap-4">
            <div class="flex-1 relative">
                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-[#9ca3af] w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Rechercher par candidat ou poste..."
                    class="w-full pl-10 pr-4 py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none bg-[#333333] text-[#f5f5f5]"
                />
            </div>
            <div class="relative">
                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-[#9ca3af] w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="22,3 2,3 10,12.46 10,19 14,21 14,12.46 22,3"/></svg>
                <select name="status" class="pl-10 pr-8 py-3 border border-[#444444] rounded-lg focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none appearance-none bg-[#333333] text-[#f5f5f5] min-w-[200px]">
                    <option value="">Tous les statuts</option>
                    <option value="Programmé" {{ request('status') == 'Programmé' ? 'selected' : '' }}>Programmé</option>
                    <option value="Confirmé" {{ request('status') == 'Confirmé' ? 'selected' : '' }}>Confirmé</option>
                    <option value="En attente" {{ request('status') == 'En attente' ? 'selected' : '' }}>En attente</option>
                    <option value="Terminé" {{ request('status') == 'Terminé' ? 'selected' : '' }}>Terminé</option>
                    <option value="Annulé" {{ request('status') == 'Annulé' ? 'selected' : '' }}>Annulé</option>
                </select>
            </div>
            <div class="flex gap-2">
                <button type="submit" class="bg-[#00b6b4] hover:bg-[#009999] text-white px-6 py-3 rounded-lg transition-colors flex items-center gap-2">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
                    Rechercher
                </button>
                <a href="{{ route('recruiter.interviews') }}" class="px-4 py-3 border border-[#444444] rounded-lg text-[#9ca3af] hover:bg-[#333333] transition-colors flex items-center">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6L6 18"/><path d="M6 6l12 12"/></svg>
                </a>
        </div>
        </form>
    </div>

    {{-- Interviews List --}}
    <div id="interviewsList" class="space-y-6">
        @forelse($interviews as $interview)
        <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300">
            <div class="flex flex-col lg:flex-row lg:items-center gap-6">
                <div class="flex items-start gap-4 flex-1">
                    <div class="w-16 h-16 bg-gradient-to-br from-[#00b6b4] to-[#009999] rounded-full flex items-center justify-center text-white font-bold text-lg flex-shrink-0">
                            {{ strtoupper(substr($interview->candidate->name, 0, 2)) }}
                    </div>
                    
                    <div class="flex-1">
                        <div class="flex items-start justify-between mb-2">
                            <div>
                                <h3 class="text-xl font-bold text-[#f5f5f5]">
                                        {{ $interview->candidate->name }}
                                </h3>
                                <p class="text-[#00b6b4] font-medium">
                                        {{ $interview->job->title }}
                                </p>
                            </div>
                                <span class="px-3 py-1 rounded-full text-sm font-medium 
                                    @if($interview->status == 'programme') text-blue-400 bg-blue-400/20
                                    @elseif($interview->status == 'confirme') text-green-400 bg-green-400/20
                                    @elseif($interview->status == 'en_attente') text-yellow-400 bg-yellow-400/20
                                    @elseif($interview->status == 'termine') text-gray-400 bg-gray-400/20
                                    @elseif($interview->status == 'annule') text-red-400 bg-red-400/20
                                    @endif">
                                    {{ $interview->status_in_french }}
                            </span>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 text-sm text-[#9ca3af] mb-4">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                                    <span>{{ $interview->formatted_date }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12,6 12,12 16,14"/></svg>
                                    <span>{{ $interview->full_time }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                    @if($interview->type == 'visioconference')
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                    @elseif($interview->type == 'presentiel')
                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                                    @else
                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                                    @endif
                                    <span>{{ $interview->type_in_french }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                                    <span class="truncate">{{ $interview->location }}</span>
                            </div>
                        </div>
                        
                            @if($interview->notes)
                        <div class="bg-[#333333] rounded-lg p-3 mb-4">
                            <p class="text-sm text-[#9ca3af]">
                                        <strong>Notes :</strong> {{ $interview->notes }}
                            </p>
                        </div>
                            @endif
                    </div>
                </div>
                
                <div class="flex items-center gap-3 lg:flex-col lg:items-end">
                    <div class="flex items-center gap-2">
                            {{-- Status Update Dropdown --}}
                            <form method="POST" action="{{ route('recruiter.interviews.update-status', $interview) }}" class="inline">
                                @csrf
                                @method('PUT')
                                <select name="status" onchange="this.form.submit()" class="text-xs px-2 py-1 border border-[#444444] rounded bg-[#333333] text-[#f5f5f5] focus:ring-2 focus:ring-[#00b6b4] focus:border-[#00b6b4] outline-none">
                                    <option value="programme" {{ $interview->status == 'programme' ? 'selected' : '' }}>Programmé</option>
                                    <option value="confirme" {{ $interview->status == 'confirme' ? 'selected' : '' }}>Confirmé</option>
                                    <option value="en_attente" {{ $interview->status == 'en_attente' ? 'selected' : '' }}>En attente</option>
                                    <option value="termine" {{ $interview->status == 'termine' ? 'selected' : '' }}>Terminé</option>
                                    <option value="annule" {{ $interview->status == 'annule' ? 'selected' : '' }}>Annulé</option>
                                </select>
                            </form>
                            
                            <a href="{{ route('recruiter.interviews.edit', $interview) }}" class="p-2 text-[#9ca3af] hover:text-blue-400 transition-colors duration-200">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="m18.5 2.5 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                            </a>
                            <button type="button" onclick="showDeleteModal({{ $interview->id }}, '{{ $interview->candidate->name }}')" class="p-2 text-[#9ca3af] hover:text-red-400 transition-colors duration-200">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                        </button>
                    </div>
                    <div class="flex gap-2">
                        <button class="px-4 py-2 border border-[#444444] rounded-lg text-[#9ca3af] hover:bg-[#333333] transition-colors flex items-center gap-2">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                            Contacter
                        </button>
                            @if($interview->type == 'visioconference' && $interview->meeting_link)
                                <a href="{{ $interview->meeting_link }}" target="_blank" class="bg-[#00b6b4] hover:bg-[#009999] text-white px-4 py-2 rounded-lg transition-colors">
                            Rejoindre
                                </a>
                            @endif
                    </div>
                </div>
            </div>
        </div>
        @empty
            <div class="text-center py-12">
                <div class="w-16 h-16 mx-auto mb-4 bg-blue-500/10 rounded-full flex items-center justify-center">
                    <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <rect width="18" height="18" x="3" y="4" rx="2" ry="2"/>
                        <line x1="16" x2="16" y1="2" y2="6"/>
                        <line x1="8" x2="8" y1="2" y2="6"/>
                        <line x1="3" x2="21" y1="10" y2="10"/>
                    </svg>
                    </div>
                <h3 class="text-lg font-semibold text-[#f5f5f5] mb-2">Aucun entretien trouvé</h3>
                <p class="text-[#9ca3af] mb-4">Vous n'avez pas encore programmé d'entretiens.</p>
                <a href="{{ route('recruiter.interviews.create') }}" class="bg-[#00b6b4] hover:bg-[#009999] text-white px-6 py-3 rounded-lg transition-colors inline-flex items-center gap-2">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                    Programmer un entretien
                </a>
                            </div>
        @endforelse
                        </div>
                        
    {{-- Pagination --}}
    @if($interviews->hasPages())
        <div class="mt-8">
            {{ $interviews->appends(request()->query())->links() }}
                            </div>
    @endif


    {{-- Calendar View --}}
    <div id="calendarView" class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-8 shadow-lg hidden">
        <div id="calendar">    </div>
        </div>

{{-- Delete Confirmation Modal --}}
<div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
    <div class="bg-[#2b2b2b] border border-[#333333] rounded-2xl p-6 max-w-md w-full">
        <div class="flex items-center gap-4 mb-4">
            <div class="w-12 h-12 bg-red-500/20 rounded-full flex items-center justify-center">
                <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                </svg>
                    </div>
                            <div>
                <h3 class="text-lg font-semibold text-[#f5f5f5]">Supprimer l'entretien</h3>
                <p class="text-[#9ca3af] text-sm">Cette action est irréversible</p>
                            </div>
                        </div>
                        
        <p class="text-[#f5f5f5] mb-6">
            Êtes-vous sûr de vouloir supprimer l'entretien avec <span id="candidateName" class="font-semibold text-[#00b6b4]"></span> ?
        </p>
        
        <div class="flex gap-3 justify-end">
            <button onclick="hideDeleteModal()" class="px-4 py-2 border border-[#444444] rounded-lg text-[#9ca3af] hover:bg-[#333333] transition-colors">
                Annuler
                        </button>
            <form id="deleteForm" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition-colors">
                    Supprimer
                        </button>
            </form>
                </div>
            </div>
        </div>

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>
<script>
let calendar;


try {
    // Delete Modal Functions
    function showDeleteModal(interviewId, candidateName) {
        document.getElementById('candidateName').textContent = candidateName;
        document.getElementById('deleteForm').action = `/recruiter/interviews/${interviewId}`;
        document.getElementById('deleteModal').classList.remove('hidden');
    }
    
    function hideDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }
    
    // Close modal when clicking outside
    document.getElementById('deleteModal').addEventListener('click', function(e) {
        if (e.target === this) {
            hideDeleteModal();
        }
    });
    
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize calendar
        const calendarEl = document.getElementById('calendar');
        
        if (!calendarEl || typeof FullCalendar === 'undefined') {
            return;
        }
        
        calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            locale: 'fr',
            buttonText: {
                today: 'Aujourd\'hui',
                month: 'Mois',
                week: 'Semaine',
                day: 'Jour',
                list: 'Liste'
            },
            dayHeaderFormat: { weekday: 'long' },
            dayMaxEvents: 3,
            moreLinkClick: 'popover',
            eventDisplay: 'block',
            events: function(info, successCallback, failureCallback) {
                // Fetch interviews for the current date range
                fetch('{{ route("recruiter.interviews.calendar") }}?start=' + info.startStr + '&end=' + info.endStr)
                    .then(response => response.json())
                    .then(data => successCallback(data))
                    .catch(error => failureCallback(error));
            },
            eventClick: function(info) {
                // Show interview details in a modal or redirect
                const interviewId = info.event.id;
                window.location.href = `/recruiter/interviews/${interviewId}`;
            },
            eventColor: function(info) {
                // Color events based on status - matching site theme
                const status = info.event.extendedProps.status;
                switch(status) {
                    case 'programme': return '#00b6b4'; // Site primary color
                    case 'confirme': return '#10b981'; // Green
                    case 'en_attente': return '#f59e0b'; // Yellow
                    case 'annule': return '#ef4444'; // Red
                    case 'termine': return '#6b7280'; // Gray
                    default: return '#00b6b4';
                }
            },
            height: 'auto',
            themeSystem: 'standard',
            eventTextColor: '#ffffff',
            eventBackgroundColor: '#00b6b4',
            eventBorderColor: '#00b6b4',
            dayMaxEventRows: 2,
            // Event popover styling
            eventDidMount: function(info) {
                // Add status data attribute for CSS styling
                const status = info.event.extendedProps.status;
                info.el.setAttribute('data-status', status);
                
                // Add custom styling to events
                info.el.style.borderRadius = '6px';
                info.el.style.fontSize = '12px';
                info.el.style.fontWeight = '500';
                info.el.style.padding = '2px 6px';
                info.el.style.margin = '1px 0';
                
                // Add tooltip with interview details
                const event = info.event;
                const title = event.title;
                const time = event.start.toLocaleTimeString('fr-FR', { hour: '2-digit', minute: '2-digit' });
                const type = event.extendedProps.type;
                const location = event.extendedProps.location;
                
                info.el.title = `${title}\n${time}\n${type}\n${location}`;
            }
        });
        
        calendar.render();
        
        // View mode toggle - moved inside DOMContentLoaded
        const listBtn = document.getElementById('listView');
        const calendarBtn = document.getElementById('calendarViewBtn');
        
        if (!listBtn || !calendarBtn) {
            return;
        }
        
        listBtn.addEventListener('click', function() {
            // Show list view, hide calendar view
            document.getElementById('interviewsList').classList.remove('hidden');
            document.getElementById('calendarView').classList.add('hidden');
            
            // Update button styles
            this.classList.add('bg-[#2b2b2b]', 'text-[#f5f5f5]', 'shadow-sm');
            this.classList.remove('text-[#9ca3af]');
            
            // Reset calendar button
            const calendarBtn = document.getElementById('calendarViewBtn');
            calendarBtn.classList.remove('bg-[#2b2b2b]', 'text-[#f5f5f5]', 'shadow-sm');
            calendarBtn.classList.add('text-[#9ca3af]');
        });

        calendarBtn.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Hide list view, show calendar view
            document.getElementById('interviewsList').classList.add('hidden');
            document.getElementById('calendarView').classList.remove('hidden');
            
            // Update button styles
            this.classList.add('bg-[#2b2b2b]', 'text-[#f5f5f5]', 'shadow-sm');
            this.classList.remove('text-[#9ca3af]');
            
            // Reset list button
            const listBtn = document.getElementById('listView');
            listBtn.classList.remove('bg-[#2b2b2b]', 'text-[#f5f5f5]', 'shadow-sm');
            listBtn.classList.add('text-[#9ca3af]');
            
            // Refresh calendar when switching to calendar view
            if (calendar) {
                calendar.refetchEvents();
            }
        });
    });
} catch (error) {
    // Silent error handling for production
}
    </script>
@endsection
</div>
@endsection

