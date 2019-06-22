<?php

namespace App\Http\Controllers;

use App\Center;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $items = Center::with([
            'region','city','map','address'
        ])->get();
        
        return view('home', compact('items'));
    }
    
    public function show(Center $center)
    {
        $center = Center::with(['region','city','map','address'])->where('id', $center->id)->first();
        return view("show", compact('center'));
    }
}
