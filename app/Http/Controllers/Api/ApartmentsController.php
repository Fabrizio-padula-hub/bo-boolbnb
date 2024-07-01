<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Apartment;

class ApartmentsController extends Controller
{
    public function index() {
        $apartments = Apartment::all();
        return response()->json([
            'success' => true,
            'results' => $apartments
        ]);
    }

}
