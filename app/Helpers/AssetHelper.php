<?php

if (!function_exists('vite_asset')) {
    /**
     * Get the asset path from Vite manifest.json
     * 
     * @param string $entry The entry point (e.g., 'resources/css/app.css' or 'resources/js/app.js')
     * @return string|null The asset path or null if not found
     */
    function vite_asset($entry)
    {
        $manifestPath = public_path('build/manifest.json');
        
        if (!file_exists($manifestPath)) {
            return null;
        }
        
        $manifest = json_decode(file_get_contents($manifestPath), true);
        
        if (!isset($manifest[$entry])) {
            return null;
        }
        
        return asset('build/' . $manifest[$entry]['file']);
    }
}

