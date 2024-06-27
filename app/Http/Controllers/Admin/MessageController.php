<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{ 
    public function index()
    {
        
        $messages = Message::all(); 
        // dd($messages);
        return view('admin.messages', compact('messages'));
    }
}
