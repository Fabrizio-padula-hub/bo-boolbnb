<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Visit;

class VisitController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $apartments = $user->apartments;
        $visits = [];
        foreach ($apartments as $apartment) {
            foreach ($apartment->visits as $visit) {
                $visits[] = $visit;
            }
        }
        $apartmentsDeleted = $user->apartments()->onlyTrashed()->get();
        $apartmentsCount = count($apartments);
        $trashCount = count($apartmentsDeleted);
        $data = [
            'user' => $user,
            'apartments' => $apartments,
            'apartmentsCount' => $apartmentsCount,
            'trashCount' => $trashCount,
            'visits' => $visits
        ];
        return view('admin.dashboard', $data);
    }
}
