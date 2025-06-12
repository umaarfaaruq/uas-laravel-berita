<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $latestNews = News::where('status', 'published')
                            ->latest('published_at')
                            ->take(5)
                            ->get();

        return view('admin.dashboard', compact('latestNews'));
    }

}
