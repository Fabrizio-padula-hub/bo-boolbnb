<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Visit;

class VisitsController extends Controller
{
    public function store(Request $request)
    {
        $ip = $request->ip();
        $apartmentId = $request->input('apartment_id');

        // Controlla se esiste già una visita per questo IP e appartamento nelle ultime 24 ore
        $existingVisit = Visit::where('ip_address', $ip)
            ->where('apartment_id', $apartmentId)
            ->where('created_at', '>=', now()->subDay())
            ->first();

        if ($existingVisit) {
            return response()->json(['success' => false, 'message' => 'IP already registered in the last 24 hours'], 400);
        }

        // Crea una nuova visita
        $visit = new Visit();
        $visit->apartment_id = $apartmentId;
        $visit->ip_address = $ip;
        $visit->save();

        return response()->json(['success' => true, 'data' => $visit]);
    }
}
