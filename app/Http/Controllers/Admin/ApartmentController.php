<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Service;
use App\Models\Sponsorship;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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
        $formData = $request->all();
        $this->validation($formData);

        $formData['slug'] = Str::slug($formData['title'], '-');
        $slug = $formData['slug'];
        $counter = 1;
        while (Apartment::where('slug', $slug)->exists()) {
            $slug = $formData['slug'] . '-' . $counter;
            $counter++;
        }
        $formData['slug'] = $slug;

        $newApartment = new Apartment();
        $newApartment->fill($formData);
        $newApartment->save();
        return redirect()->route('admin.apartments.show', ['apartment' => $newApartment->slug])->with('message', $newApartment->title . 'Appartamento creato con successo.');
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
        $apartments = Apartment::all();
        $apartmentsCount = Apartment::count();
        $data = [
            'apartments' => $apartments,
            'apartmentsCount' => $apartmentsCount,
        ];
        return $data;
    }

    public function validation($data) {
        $validator = Validator::Make(
            $data,
            [
                'title' => 'required|min:5|max:50',
                'description' => 'required',
                'number_of_rooms' => 'required|integer|numeric|min:1',
                'number_of_beds' => 'required|integer|numeric|min:1',
                'number_of_bathrooms' => 'required|integer|numeric|min:1',
                'square_meters' => 'integer|numeric|min:10',
                'address' => 'required',
                'visibility' => 'required|boolean'
            ],
            [
                'title.required' => 'Il titolo è richiesto'
            ]
        )->validate();
        return $validator;
    }
}
