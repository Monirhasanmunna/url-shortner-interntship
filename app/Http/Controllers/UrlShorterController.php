<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;

class UrlShorterController extends Controller
{
    public function index(Request $request)
    {
        $search     = $request->input('input');
        $item       = $request->input('select');
        $urls       = Url::Search($search)->orderByDesc('id')->paginate($item);

        return Inertia::render('ShortUrl', [
            'urls' => $urls
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'main_url' => 'required|url'
        ]);

        Url::create([
            'main_url'  => $request->main_url,
            'short_url' => Str::random(6)
        ]);

        return redirect()->back();
    }


    public function shorterLinkShow($shorterlink)
    {
        $url = Url::where('short_url', $shorterlink)->first()->main_url;
        return redirect($url);
    }

}
