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
            'name' => 'required|min:1',
            'email' => 'required|email',
            'text' => 'required|string',
        ]);

        $message = new Message();
        $message->name = $request->name;
        $message->email = $request->email;
        $message->text = $request->text;
        $message->save();

        return response()->json(['success' => true, 'data' => $message]);
    }
}
