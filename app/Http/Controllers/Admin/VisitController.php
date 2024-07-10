<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
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

        // Verifica se ci sono appartamenti
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
        $start = Carbon::create(2023, 7, 1);
        $end = Carbon::create(2024, 8, 1);

        foreach ($apartments as $apartment) {
            $monthlyVisits = $apartment->visits()
                ->selectRaw('DATE_FORMAT(visited_at, "%Y-%m") as month, COUNT(*) as visit_count')
                ->whereBetween('visited_at', [$start, $end])
                ->groupBy('month')
                ->orderBy('month')
                ->get()
                ->pluck('visit_count', 'month')
                ->toArray();

            // Inizializzazione di tutti i mesi con 0 visite
            $monthlyData = [];
            for ($date = $start->copy(); $date->lessThan($end); $date->addMonth()) {
                $formattedMonth = $date->format('Y-m');
                $monthlyData[$formattedMonth] = $monthlyVisits[$formattedMonth] ?? 0;
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
        $apartmentsCount = $apartments->count();
        $trashCount = $apartmentsDeleted->count();
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
