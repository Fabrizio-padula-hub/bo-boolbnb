<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        dd(config('user'));
        $user = Auth::user();
        $apartments = Apartment::all();
        $apartmentsCount = Apartment::count();
        $data = [
            'user' => $user,
            'apartments' => $apartments,
            'apartmentsCount' => $apartmentsCount,
        ];
        return view('admin.dashboard', $data);
    }
}
