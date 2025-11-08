<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $featured = Content::where('is_featured', true)->first();
        $continueWatching = Content::limit(6)->get();
        $trending = Content::where('is_trending', true)->limit(6)->get();
        $topPicks = Content::where('is_top_pick', true)->limit(6)->get();

        return Inertia::render('Dashboard', [
            'featured' => $featured,
            'continueWatching' => $continueWatching,
            'trending' => $trending,
            'topPicks' => $topPicks,
        ]);
    }
}
