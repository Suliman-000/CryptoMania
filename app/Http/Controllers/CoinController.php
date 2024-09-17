<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CoinController extends Controller
{
    public function index()
    {
        // Fetch coin data from CoinCap API
        $response = Http::get('https://api.coincap.io/v2/assets');
        $coins = $response->json()['data'];

        return view('coins.index', compact('coins'));
    }
}
