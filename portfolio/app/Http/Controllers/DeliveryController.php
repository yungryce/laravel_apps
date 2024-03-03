<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function index()
    {
        $apiKey = config('services.google.maps_api_key');
        return view('delivery.index', compact('apiKey'));
    }
}
