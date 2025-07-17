<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Events;
use App\Models\HeroSlider;
use App\Models\Locations;
use App\Models\Logos;
use App\Models\Milestone;
use App\Models\News;
use App\Models\Projects;
use App\Models\Technologies;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Location;

class FrontendController extends Controller
{
    public function index()
    {
        $about = About::first();
        $hero = HeroSlider::first();
        $milestone = Milestone::all();
        $logos = Logos::all();
        $locations = Locations::all();
        return response()->json([
'about' => $about,
'hero' => $hero,
'milestone' => $milestone,
'logos' => $logos,
'locations' => $locations
        ]);
    }
    public function about()
    {
    $about = About::first();
    $milestone = Milestone::all();
    return response()->json([
'about' => $about,
'milestone' => $milestone,
        ]);
    }
        public function logos()
    {
    $logos = Logos::all();
    return response()->json([
'logos' => $logos,
        ]);
    }
    public function news()
    {
        $news = News::all();
        return response()->json([
'news' => $news
        ]);
    }

        public function events()
    {
        $events = Events::all();
        return response()->json([
'events' => $events
        ]);
    }

        public function projects()
    {
        $projects = Projects::all();
        return response()->json([
'projects' => $projects
        ]);
    }
        public function technologies()
    {
        $technologies = Technologies::all();
        return response()->json([
'technologies' => $technologies
        ]);
    }
}
