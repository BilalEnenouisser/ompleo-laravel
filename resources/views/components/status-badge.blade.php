@props([
    'status' => null,
    'label' => null,
    'size' => 'md',
])

@php $statusKey = (string) $status; $themeMap = [ 'programme' => 'text-blue-400 bg-blue-400/20', 'confirme' => 'text-green-400 bg-green-400/20', 'en_attente' => 'text-yellow-400 bg-yellow-400/20', 'termine' => 'text-gray-400 bg-gray-400/20', 'annule' => 'text-red-400 bg-red-400/20', 'pending' => 'text-blue-700 bg-blue-100', 'reviewed' => 'text-yellow-700 bg-yellow-100', 'accepted' => 'text-green-700 bg-green-100', 'rejected' => 'text-red-700 bg-red-100', 'active' => 'text-green-400 bg-green-900/30', 'expired' => 'text-red-400 bg-red-900/30', 'cancelled' => 'text-gray-400 bg-gray-900/30', 'resolved' => 'text-green-400 bg-green-900/30', 'dismissed' => 'text-gray-400 bg-gray-900/30', ]; $labelMap = [ 'programme' => __('Programme'), 'confirme' => __('Confirme'), 'en_attente' => __('En attente'), 'termine' => __('Termine'), 'annule' => __('Annule'), 'pending' => __('Nouveau'), 'reviewed' => __('En cours'), 'accepted' => __('Accepte'), 'rejected' => __('Rejete'), 'active' => __('Actif'), 'expired' => __('Expire'), 'cancelled' => __('Annule'), 'resolved' => __('Resolu'), 'dismissed' => __('Rejete'), ]; $sizeMap = [ 'sm' => 'px-2 py-1 text-xs', 'md' => 'px-3 py-1 text-sm', ]; $themeClass = $themeMap[$statusKey] ?? 'text-slate-300 bg-slate-500/20'; $sizeClass = $sizeMap[$size] ?? $sizeMap['md']; $resolvedLabel = $label ?? ($labelMap[$statusKey] ?? ucfirst(str_replace('_', ' ', $statusKey))); @endphp

<span {{ $attributes->merge(['class' => trim("rounded-full font-medium whitespace-nowrap {$sizeClass} {$themeClass}")]) }}>
    {{ $resolvedLabel }}
</span>
