<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Service;
use App\Models\Sponsorship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
        $formData['slug'] = Str::slug($formData['title'], '-');
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
        $apartment['slug'] = Str::slug($formData['title'], '-');
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
        return redirect()->route('admin.apartments.show', ['apartment' => $apartment->slug])->with('message', $apartment->title . ' aggiornato con successo con successo.');
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
}
