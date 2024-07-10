<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $apartments = $user->apartments;

        // Collezioniamo tutti i messaggi in una singola query ordinata per data di creazione decrescente
        $messages = collect();
        foreach ($apartments as $apartment) {
            $messages = $messages->merge($apartment->messages()->orderBy('created_at', 'desc')->get());
        }

        // Ordiniamo i messaggi in base alla data di creazione decrescente
        $messages = $messages->sortByDesc('created_at');

        $apartmentsDeleted = $user->apartments()->onlyTrashed()->get();
        $apartmentsCount = $apartments->count();
        $trashCount = $apartmentsDeleted->count();
        $messagesCount = $messages->count();

        $data = [
            'user' => $user,
            'apartments' => $apartments,
            'apartmentsCount' => $apartmentsCount,
            'trashCount' => $trashCount,
            'messagesCount' => $messagesCount,
            'messages' => $messages
        ];

        return view('admin.messages.index', $data);
    }
}
