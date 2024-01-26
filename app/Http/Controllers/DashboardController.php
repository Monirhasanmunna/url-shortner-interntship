<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $totalUrl = Url::all()->count();
        return Inertia::render('Dashboard',[
            'totalUrl' => $totalUrl
        ]);
    }
}
