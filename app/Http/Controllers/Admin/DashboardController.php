<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
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
            'messagesCount' => $messagesCount
        ];
        return view('admin.dashboard', $data);
    }
}
