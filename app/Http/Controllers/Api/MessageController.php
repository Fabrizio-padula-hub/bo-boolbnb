<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'text' => 'required|string',
        ]);

        $message = new Message();
        $message->apartment_id = $request->apartment_id;
        $message->name = $request->name;
        $message->email = $request->email;
        $message->text = $request->text;
        $message->save();

        return response()->json(['success' => true, 'data' => $message]);
    }
}
