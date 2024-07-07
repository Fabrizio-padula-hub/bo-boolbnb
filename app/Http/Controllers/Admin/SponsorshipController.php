<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sponsorship;
use App\Models\Apartment;

class SponsorshipController extends Controller
{
    public function index()
    {
        
        $sponsorships = Sponsorship::all(); 
        
        $user = auth()->user();
        $apartments = $user->apartments;
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
            'messagesCount' => $messagesCount,
            'messages' => $messages,
            'sponsorships' => $sponsorships
        ];
        
        return view('admin.sponsorships.index', $data);
    }

    public function create(Apartment $apartment)
    {
        
        $user = auth()->user();
        
        $apartments = $user->apartments;
        
        $messages = [];
        foreach ($apartments as $singleApartment) {
            foreach ($singleApartment->messages as $message) {
                $messages[] = $message;
            }
        }
        $sponsorships = Sponsorship::all();
        $apartmentsDeleted = $user->apartments()->onlyTrashed()->get();
        $apartmentsCount = count($apartments);
        $trashCount = count($apartmentsDeleted);
        $messagesCount = count($messages);
        $data = [
            'user' => $user,
            'apartments' => $apartments,
            'apartmentsCount' => $apartmentsCount,
            'trashCount' => $trashCount,
            'messagesCount' => $messagesCount,
            'messages' => $messages,
            'sponsorships' => $sponsorships,
            'apartment' => $apartment
        ];
        return view('admin.sponsorships.create', $data);
    }

    public function store(Request $request, Apartment $apartment)
    {
        $request->validate([
            'sponsorship_ids' => 'required|array',
            'sponsorship_ids.*' => 'exists:sponsorships,id',
        ]);
    
        $sponsorshipIds = $request->sponsorship_ids;
    
        foreach ($sponsorshipIds as $sponsorshipId) {
            $sponsorship = Sponsorship::findOrFail($sponsorshipId);
    
            $created_at = now();
            $expired_at = $created_at->clone()->addHours($sponsorship->duration);
    
            // Verifica se la sponsorizzazione esiste già per questo appartamento
            $existingSponsorship = $apartment->sponsorships()->where('sponsorship_id', $sponsorshipId)->first();
            if (!$existingSponsorship) {
                // Aggiungi la sponsorizzazione all'appartamento
                $apartment->sponsorships()->attach($sponsorshipId, [
                    'created_at' => $created_at,
                    'expired_at' => $expired_at
                ]);
            }
        }
    
        return redirect()->route('admin.apartments.index')->with('success', 'Sponsorizzazioni create con successo!');
    }
}
