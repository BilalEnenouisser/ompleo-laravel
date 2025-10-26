<?php

if (!function_exists('getWorkTypeLabel')) {
    function getWorkTypeLabel($type) {
        switch ($type) {
            case 'remote': return 'Télétravail';
            case 'onsite': return 'Présentiel';
            case 'hybrid': return 'Hybride';
            default: return $type;
        }
    }
}

if (!function_exists('getWorkTypeIcon')) {
    function getWorkTypeIcon($type) {
        switch ($type) {
            case 'remote': return '🏠';
            case 'onsite': return '🏢';
            case 'hybrid': return '🔄';
            default: return '💼';
        }
    }
}
