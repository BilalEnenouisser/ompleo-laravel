<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $stats = config('content_catalog.about.stats', []); $values = config('content_catalog.about.values', []); $team = config('content_catalog.about.team', []); $timeline = config('content_catalog.about.timeline', []); return view('about', compact('stats', 'values', 'team', 'timeline'));
    }
}

