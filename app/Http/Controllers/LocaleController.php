<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LocaleController extends Controller
{
    public function setLocale($locale)
    {
        $supportedLocales = ['fr', 'en', 'ar'];
        
        if (in_array($locale, $supportedLocales)) {
            App::setLocale($locale);
            Session::put('locale', $locale);
        }
        
        return redirect()->back();
    }
}

