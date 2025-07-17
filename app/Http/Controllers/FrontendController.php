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
        return response()->json([
'about' => $about,
'hero' => $hero,
'milestone' => $milestone,
'logos' => $logos,
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
    $newsthree = News::take(3)->get();
    $news = News::all();
    return response()->json([
        'newsthree' => $newsthree,
        'news' => $news,
    ]);
}


        public function events()
    {
        $eventsthree = Events::take(3)->get();
        $events = Events::all();
        return response()->json([
'eventsthree' => $eventsthree,
'events' => $events,
        ]);
    }

        public function projects()
    {
        $projectssix = Projects::take(6)->get();
        $projects = Projects::all();
        return response()->json([
'projectssix' => $projectssix,
'projects' => $projects
        ]);
    }
        public function technologies()
    {
        $technologiessix = Technologies::take(6)->get();
        $technologies = Technologies::all();
        return response()->json([
'technologiessix' => $technologiessix,
'technologies' => $technologies
        ]);
    }

    public function locations()
    {
        $locations = Locations::all();
        return response()->json([
            'locations' => $locations
        ]);
    }
}
