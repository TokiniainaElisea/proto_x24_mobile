<?php
namespace App\Http\Controllers;

class SettingController extends Controller
{
    // pour afficher company, les réglages de la société quoi
    public function company()
    {
        return view('paramètres.company');
    }

    //réglade des préfixes
    public function numbering()
    {
        return view('paramètres.numbering');
    }

    //à propos
    public function about()
    {
        return view('paramètres.about');
    }
}
