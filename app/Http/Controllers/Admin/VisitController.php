<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Visit;
use Carbon\Carbon;

class VisitController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $apartments = $user->apartments;
        $visits = [];

        // Verifica se ci sono appartamenti e visite
        if ($apartments->isEmpty()) {
            return view('admin.dashboard', [
                'user' => $user,
                'apartments' => $apartments,
                'apartmentsCount' => 0,
                'trashCount' => 0,
                'visits' => [],
                'apartmentVisits' => []
            ]);
        }

        // Recupero delle visite per ciascun appartamento e raggruppamento per mese
        $apartmentVisits = [];
        foreach ($apartments as $apartment) {
            $monthlyVisits = $apartment->visits()
                ->selectRaw('MONTH(created_at) as month, COUNT(*) as visit_count')
                ->groupBy('month')
                ->orderBy('month')
                ->get()
                ->pluck('visit_count', 'month')
                ->toArray();

            // Inizializzazione di tutti i mesi con 0 visite
            $monthlyData = array_fill(1, 12, 0);
            foreach ($monthlyVisits as $month => $count) {
                $monthlyData[$month] = $count;
            }

            $apartmentVisits[] = [
                'apartment' => $apartment->title,
                'apartment_slug' => $apartment->slug,
                'visits' => $monthlyData
            ];
        }

        $messages = [];
        foreach ($apartments as $apartment) {
            foreach ($apartment->messages as $message) {
                $messages[] = $message;
            }
        }
        $apartmentsDeleted = $user->apartments()->onlyTrashed()->get();
        $apartmentsCount = count($apartments);
        $trashCount = count($apartmentsDeleted);
        $messagesCount = count($messages);
        $data = [
            'user' => $user,
            'apartments' => $apartments,
            'apartmentsCount' => $apartmentsCount,
            'trashCount' => $trashCount,
            'apartmentVisits' => $apartmentVisits,
            'messagesCount' => $messagesCount
        ];
        return view('admin.dashboard', $data);
    }
}
