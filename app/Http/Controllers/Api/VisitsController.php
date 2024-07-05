<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Visit;

class VisitsController extends Controller
{
    public function store(Request $request)
    {
        $visit = new Visit();
        $visit->apartment_id = $request->apartment_id;
        $visit->ip_address = $request->ip_address;
        $visit->save();

        return response()->json(['success' => true, 'data' => $visit]);
    }
}