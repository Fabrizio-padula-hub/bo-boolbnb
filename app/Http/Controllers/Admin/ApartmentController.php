<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Service;
use App\Models\Sponsorship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->apartmentsCount();
        return view('admin.apartments.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::all();
        $sponsorships = Sponsorship::all();
        $data = $this->apartmentsCount();
        $data['services'] = $services;
        $data['sponsorships'] = $sponsorships;
        return view('admin.apartments.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Recuperare i dati dalla sessione
        $lat = session('lat');
        $long = session('long');

        // Verificare che i dati siano presenti
        if ($lat === null || $long === null) {
            return redirect()->back()->with('error', 'Latitudine e Longitudine mancanti');
        }
        $formData = $request->all();
        $this->validation($formData);
        $formData['lat'] = $lat;
        $formData['long'] = $long;
        $user = auth()->user();
        $id = $user->id;
        $formData['user_id'] = $id;

        $formData['slug'] = Str::slug($formData['title'], '-');
        $slug = $formData['slug'];
        $counter = 1;
        while (Apartment::where('slug', $slug)->exists()) {
            $slug = $formData['slug'] . '-' . $counter;
            $counter++;
        }
        $formData['slug'] = $slug;
        if ($request->hasFile('image')) {
            $img_path = Storage::disk('public')->put('apartments_images', $formData['image']);
            $formData['image'] = $img_path;
        }
        $newApartment = new Apartment();
        $newApartment->fill($formData);
        $newApartment->save();
        if ($request->has('services')) {
            $newApartment->services()->attach($formData['services']);
        }
        return redirect()->route('admin.apartments.show', ['apartment' => $newApartment->slug])->with('message', $newApartment->title . ' creato con successo.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Apartment $apartment)
    {
        $data = $this->apartmentsCount();
        $data['apartment'] = $apartment;
        return view('admin.apartments.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment)
    {
        $services = Service::all();
        $sponsorships = Sponsorship::all();
        $data = $this->apartmentsCount();
        $data['apartment'] = $apartment;
        $data['services'] = $services;
        $data['sponsorships'] = $sponsorships;
        return view('admin.apartments.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Apartment $apartment)
    {
        $formData = $request->all();
        $this->validation($formData);
        $apartment['slug'] = Str::slug($formData['title'], '-');
        $slug = $apartment['slug'];
        $counter = 1;
        while (Apartment::where('slug', $slug)->exists()) {
            $slug = $apartment['slug'] . '-' . $counter;
            $counter++;
        }
        $apartment['slug'] = $slug;
        if ($request->hasFile('image')) {
            if ($apartment->image) {
                Storage::delete($apartment->image);
            }
            $img_path = Storage::disk('public')->put('apartments_images', $formData['image']);
            $formData['image'] = $img_path;
        }
        $apartment->update($formData);
        session()->flash('message', $apartment->name . ' corettamente aggiornato.');
        if ($request->has('services')) {
            $apartment->services()->sync($formData['services']);
        } else {
            $apartment->services()->sync([]);
        }
        return redirect()->route('admin.apartments.show', ['apartment' => $apartment->slug])->with('message', $apartment->title . ' aggiornato con successo.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function apartmentsCount()
    {
        $user = auth()->user();
        $apartments = $user->apartments;
        $apartmentsCount = count($apartments);
        $data = [
            'apartments' => $apartments,
            'apartmentsCount' => $apartmentsCount,
        ];
        return $data;
    }

    public function validation($data)
    {
        $validator = Validator::Make(
            $data,
            [
                'title' => 'required|min:5|max:50',
                'description' => 'nullable|min:15',
                'number_of_rooms' => 'required|integer|numeric|min:1',
                'number_of_beds' => 'required|integer|numeric|min:1',
                'number_of_bathrooms' => 'required|integer|numeric|min:1',
                'square_meters' => 'nullable|integer|numeric|min:10',
                'visibility' => 'required|boolean',
                'address' => 'required'
            ],
            [
                'title.required' => 'Questo campo è obbligatorio',
                'title.min' => 'Il titolo dev\'essere di almeno 5 caratteri',
                'title.max' => 'Il titolo dev\'essere di massimo 50 caratteri',
                'description.min' => 'La descrizione dev\'essere di almeno 15 caratteri',
                'number_of_rooms.required' => 'Questo campo è obbligatorio',
                'number_of_rooms.integer' => 'Numero di stanze dev\'essere un numero',
                'number_of_rooms.numeric' => 'Numero di stanze dev\'essere un numero',
                'number_of_rooms.min' => 'Numero di stanze dev\'essere almeno 1',
                'number_of_beds.required' => 'Questo campo è obbligatorio',
                'number_of_beds.integer' => 'Numero di letti dev\'essere un numero',
                'number_of_beds.numeric' => 'Numero di letti dev\'essere un numero',
                'number_of_beds.min' => 'Numero di letti dev\'essere almeno 1',
                'number_of_bathrooms.required' => 'Questo campo è obbligatorio',
                'number_of_bathrooms.integer' => 'Numero di bagni dev\'essere un numero',
                'number_of_bathrooms.numeric' => 'Numero di bagni dev\'essere un numero',
                'number_of_bathrooms.min' => 'Numero di bagni dev\'essere almeno 1',
                'square_meters.integer' => 'Metri quadrati dev\'essere un numero',
                'square_meters.numeric' => 'Metri quadrati dev\'essere un numero',
                'square_meters.min' => 'Metri quadrati dev\'essere almeno 10',
                'address.required' => 'Questo campo è obbligatorio',
                'visibility.required' => 'Questo campo è obbligatorio'
            ]
        )->validate();
        return $validator;
    }

    public function autocomplete(Request $request)
    {
        $query = $request->input('query');
        $apiKey = env('TOMTOM_API_KEY');
        $url = "https://api.tomtom.com/search/2/search/$query.json?key=$apiKey&countrySet=ITA";
        $response = Http::get($url);
        if ($response->successful()) {
            return response()->json($response->json());
        }
        return response()->json(['error' => 'Unable to fetch data'], 500);
    }

    public function save(Request $request)
    {
        $request->validate([
            'lat' => 'required|numeric',
            'long' => 'required|numeric',
        ]);

        try {
            $lat = $request->input('lat');
            $long = $request->input('long');

            session(['lat' => $lat, 'long' => $long]);

            return response()->json(['success' => true, 'message' => 'Dati salvati nella sessione']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Errore durante il salvataggio dei dati', 'error' => $e->getMessage()]);
        }
    }
}
