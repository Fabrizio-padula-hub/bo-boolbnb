<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sponsorship;

class SponsorshipController extends Controller
{
    public function index()
    {
        
        $sponsorships = Sponsorship::all(); 
        // dd($sponshorships);
        return view('admin.sponsorships', compact('sponsorships'));
    }
}
