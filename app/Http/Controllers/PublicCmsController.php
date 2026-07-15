<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Career;
use App\Models\SocialFeed;
use App\Models\Setting;
use Illuminate\Http\Request;

class PublicCmsController extends Controller
{
    public function welcome()
    {
        $settings = Setting::pluck('value', 'key')->all();
        $feeds = SocialFeed::latest()->get();
        return view('welcome', compact('settings', 'feeds'));
    }

    public function news()
    {
        $news = News::latest()->get();
        return view('news', compact('news'));
    }

    public function showNews($slug)
    {
        $article = News::where('slug', $slug)->firstOrFail();
        $article->increment('views_count');
        return view('news-detail', compact('article'));
    }

    public function careers()
    {
        $jobs = Career::where('status', true)->latest()->get();
        return view('careers', compact('jobs'));
    }
}
