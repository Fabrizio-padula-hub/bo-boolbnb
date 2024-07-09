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
            $serviceIds = $request->input('services'); // Dal fo deve arrivare un array di id che sarà scritto nelle url in forma estare tipo &services[]=1&services[]=2
            $numberOfRooms = $request->input('number_of_rooms');
            $numberOfBeds = $request->input('number_of_beds');
            $numberOfBathrooms = $request->input('number_of_bathrooms');
            $squareMeters = $request->input('square_meters');

            $query = Apartment::select(
                'apartments.*',
                DB::raw('(6371 * acos(cos(radians(' . $latitude . ')) * cos(radians(apartments.lat)) * cos(radians(apartments.long) - radians(' . $longitude . ')) + sin(radians(' . $latitude . ')) * sin(radians(apartments.lat)))) AS distance')
            )
                // ->where('apartments.visibility', '=', 1)
                ->having('distance', '<', $radius)
                ->orderBy('distance')
                ->with('services'); // Carica i servizi correlati

            // Join aggiustato per prendere tutti gli appartamenti che hanno almeno un servizio selezionato compresa la possibilità di selezionarne più di uno
            // (vi conviene aggiungere agli appartamenti nel db tramite edit tanti servizi così la potete testare bene)
            // Con la if si rende il filtro opzionale solo se il 'array è popolato
            if (!empty($serviceIds)) {
                $query->leftJoin('apartment_service', 'apartment_service.apartment_id', '=', 'apartments.id')
                    ->leftJoin('services', 'apartment_service.service_id', '=', 'services.id')
                    ->whereIn('services.id', $serviceIds)
                    ->groupBy('apartments.id');
            }

            // Per filtrale anche number of rooms, beds, bathrooms e square meters usare lo stesso metodo dei servizi con if (!empty) e dentro $query->where
            if (!empty($numberOfRooms)) {
                $query->where('apartments.number_of_rooms', '>=', $numberOfRooms);
            }

            if (!empty($numberOfBeds)) {
                $query->where('apartments.number_of_beds', '>=', $numberOfBeds);
            }

            if (!empty($numberOfBathrooms)) {
                $query->where('apartments.number_of_bathrooms', '>=', $numberOfBathrooms);
            }

            if (!empty($squareMeters)) {
                $query->where('apartments.square_meters', '>=', $squareMeters);
            }

            $apartments = $query->get();

            // Filtra gli appartamenti che hanno tutti i servizi richiesti, se forniti usando pluk per prendere gli id e pusharli in un array con toArray
            if (!empty($serviceIds)) {
                $apartments = $apartments->filter(function ($apartment) use ($serviceIds) {
                    $apartmentServiceIds = $apartment->services->pluck('id')->toArray();
                    return empty(array_diff($serviceIds, $apartmentServiceIds));
                });
            }

            // Conta il numero totale di risultati
            $totalResults = $apartments->count();

            return response()->json([
                'total_results' => $totalResults,
                'apartments' => $apartments->values() // Ritorna i valori filtrati
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Si è verificato un errore durante l\'elaborazione della richiesta: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show($slug)
    {
        $apartment = Apartment::where('slug', '=', $slug)->with('users', 'messages', 'visits', 'sponsorships', 'services')->first();

        if ($apartment) {
            $data = [
                'success' => true,
                'apartment' => $apartment
            ];
        } else {
            $data = [
                'success' => false,
                'error' => 'Non ci sono appartamenti che corrispondono a questo slug'
            ];
        }
        return response()->json($data);
    }

    public function getSponsoredApartments()
    {
        $apartments = Apartment::whereHas('sponsorships')->get();
        return response()->json($apartments);
    }
}
