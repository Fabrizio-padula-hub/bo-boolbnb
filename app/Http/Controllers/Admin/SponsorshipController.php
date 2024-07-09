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
        $sponsorship_id = session('sponsorship_id');
        $apartment_id = session('apartment_id');
        $apartment_slug = session('apartment_slug');

        if ($sponsorship_id && $apartment_id) {
            $sponsorship = Sponsorship::find($sponsorship_id);
            if ($sponsorship) {
                $durationInHours = $sponsorship->duration;

                // Calcolo del tempo cumulativo
                $lastSponsorship = $apartment->sponsorships()
                    ->where('end_time', '>', Carbon::now())
                    ->orderBy('end_time', 'desc')
                    ->first();

                $cumulativeEndTime = $lastSponsorship ? new Carbon($lastSponsorship->pivot->end_time) : Carbon::now();

                // Crea una nuova sponsorizzazione per questo appartamento
                $start_time = $cumulativeEndTime->copy();
                $end_time = $start_time->copy()->addHours($durationInHours);

                $apartment->sponsorships()->attach($sponsorship_id, [
                    'start_time' => $start_time,
                    'end_time' => $end_time,
                ]);

                $cumulativeEndTime = $end_time;

                $apartment->update(['sponsorship_end_time' => $cumulativeEndTime]);

                return redirect()->route('admin.apartments.index')->with('message', $apartment->title . ' è in evidenza! La sponsorizzazione terminerà il ' . $cumulativeEndTime);
            }
        }

        return redirect()->route('admin.apartments.index')->with('error', 'Errore nella sponsorizzazione.');
    }
}
