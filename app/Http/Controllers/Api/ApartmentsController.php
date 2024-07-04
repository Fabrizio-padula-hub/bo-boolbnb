<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Apartment;

class ApartmentsController extends Controller
{
    public function index(Request $request)
    {
        try {
            $latitude = $request->input('latitude');
            $longitude = $request->input('longitude');
            $radius = $request->input('radius');
        // Query per ottenere gli appartamenti con la distanza calcolata e i servizi correlati
            $apartments = Apartment::select(
                DB::raw('apartments.*, (6371 * acos(cos(radians(' . $latitude . ')) * cos(radians(apartments.lat)) * cos(radians(apartments.long) - radians(' . $longitude . ')) + sin(radians(' . $latitude . ')) * sin(radians(apartments.lat)))) AS distance')
            )
            ->leftJoin('apartment_service', 'apartments.id', '=', 'apartment_service.apartment_id')
            ->leftJoin('services', 'services.id', '=', 'apartment_service.service_id')
            ->where('apartments.visibility', '=', 1)
            ->having('distance', '<', $radius)
            ->orderBy('distance')
            ->with('services') // Carica i servizi correlati
            ->get();

        // Conta il numero totale di risultati
        $totalResults = $apartments->count();

            return response()->json([
                'total_results' => $totalResults,
                'apartments' => $apartments
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Si è verificato un errore durante l\'elaborazione della richiesta: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show($slug) {
        $apartment = Apartment::where('slug', '=', $slug)->with('users', 'messages', 'visits', 'sponsorships', 'services')->first();

        if ($apartment) {
            $data = [
                'success' => true,
                'apartment'=> $apartment
            ];
        } else {
            $data = [
                'success' => false,
                'error' => 'Non ci sono appartmenti che corrispondono a questo slug'
            ];
        }
        return response()->json($data);
    }
}
