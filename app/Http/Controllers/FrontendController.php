<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\HeroSlider;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $about = About::first();
        $hero = HeroSlider::first();
        return response()->json([
'about' => $about,
'hero' => $hero
        ]);
    }
}
