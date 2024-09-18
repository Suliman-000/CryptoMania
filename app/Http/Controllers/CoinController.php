<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;

class CoinController extends Controller
{
    public function index(Request $request)
    {
        // Fetch coin data from CoinCap API
        $response = Http::get('https://api.coincap.io/v2/assets');
        $coins = $response->json()['data'];

        // Paginate the data
        $currentPage = $request->input('page', 1);
        $perPage = 15; // Number of items per page
        $offset = ($currentPage - 1) * $perPage;
        $total = count($coins);
        $currentCoins = array_slice($coins, $offset, $perPage);

        $paginator = new LengthAwarePaginator(
            $currentCoins,
            $total,
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('coins.index', ['coins' => $paginator]);
    }
}
