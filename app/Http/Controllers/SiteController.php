<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function getHome()
    {

        $data = [
            'heroes' => Hero::where('status', 'active')->limit(1)->first(),
        ];

        return view('site.home', $data);
    }
}