<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Sponsorship;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
            'sponsorships' => $sponsorships,
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
            'apartment' => $apartment,
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
        $cumulativeEndTime = Carbon::now();

        foreach ($sponsorshipIds as $sponsorshipId) {
            $sponsorship = Sponsorship::findOrFail($sponsorshipId);
            $durationInHours = $sponsorship->duration;

            // Verifica l'ultima sponsorizzazione attiva
            $lastSponsorship = $apartment->sponsorships()
                ->where('end_time', '>', Carbon::now())
                ->orderBy('end_time', 'desc')
                ->first();

            if ($lastSponsorship) {
                $cumulativeEndTime = new Carbon($lastSponsorship->pivot->end_time);
            }

            // Crea una nuova sponsorizzazione per questo appartamento
            $start_time = $cumulativeEndTime->copy(); // inizia dopo l'ultima sponsorizzazione cumulativa
            $end_time = $start_time->copy()->addHours($durationInHours);

            $apartment->sponsorships()->attach($sponsorshipId, [
                'start_time' => $start_time,
                'end_time' => $end_time,
            ]);

            // Aggiorna il tempo cumulativo
            $cumulativeEndTime = $end_time;
        }

        // Aggiorna la data di fine cumulativa per tutte le sponsorizzazioni
        $apartment->update(['sponsorship_end_time' => $cumulativeEndTime]);

        return redirect()->route('admin.apartments.index')->with('message', $apartment->title . ' è in evidenza! La sponsorizzazione terminerà il ' . $cumulativeEndTime);
    }
}
