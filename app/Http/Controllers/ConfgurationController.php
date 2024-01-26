<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ConfgurationController extends Controller
{
    public function index()
    {
        $config = Configuration::first();

        return Inertia::render('Configuration',[
            'config' => $config
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'click_limit' => 'required',
            'block_duration' => 'required'
        ]);

        $config =  Configuration::first();

        if(isset($config)){
            $config->update([
                'click_limit' => $request->click_limit,
                'block_duration' => $request->block_duration
            ]);
        }

        return redirect()->back();
    }
}
