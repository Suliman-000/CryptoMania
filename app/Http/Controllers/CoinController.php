<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CoinController extends Controller
{
    public function index(Request $request)
    {
        return view('coins.coin-index');
    }

    public function show($id)
    {
        // Fetch coin details
        $response = Http::withoutVerifying()->get('https://api.coincap.io/v2/assets/' . $id);
        $coin = $response->json()['data'];

        // Fetch coin price history (last 30 days, daily interval)
        $historyResponse = Http::withoutVerifying()->get('https://api.coincap.io/v2/assets/' . $id . '/history', [
            'interval' => 'd1', // Daily data
            'start' => now()->subDays(30)->timestamp * 1000, // 30 days ago
            'end' => now()->timestamp * 1000,
        ]);
        $history = $historyResponse->json()['data'];

        return view('coins.show', compact('coin', 'history'));
    }
}
