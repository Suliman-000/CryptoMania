<?php

namespace App\Livewire;

use App\Models\Wallet;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class WalletComponent extends Component
{
    public $coins; // Available coins fetched from the API
    public $walletCoins; // Coins in the user's wallet
    public $selectedCoin;
    public $amount;

    public function mount()
    {
        // Fetch the coin data from the external API
        $this->coins = $this->fetchCoinsFromApi();

        // Fetch user's wallet coins from the database
        $this->walletCoins = Wallet::where('user_id', Auth::id())->get();
    }

    // Function to fetch the coin data from the API
    public function fetchCoinsFromApi()
    {
        // Using CoinCap API (you can replace this with the API you're using)
        $response = Http::get('https://api.coincap.io/v2/assets');

        if ($response->successful()) {
            // Return the coin data from the API
            return $response->json()['data']; // Assuming the coin data is in the 'data' array
        } else {
            return []; // Return an empty array if the API call fails
        }
    }

    public function addCoin()
    {
        $this->validate([
            'selectedCoin' => 'required',
            'amount' => 'required|numeric|min:0.00000001',
        ]);

        // Store the coin in the user's wallet (in the database)
        Wallet::create([
            'user_id' => Auth::id(),
            'coin_id' => $this->selectedCoin, // Store the coin ID (from the API)
            'amount' => $this->amount,
        ]);

        // Update the user's wallet coins
        $this->walletCoins = Wallet::where('user_id', Auth::id())->get();

        session()->flash('message', 'Coin added to wallet successfully!');
    }

    public function deleteCoin($id)
    {
        // Delete the coin from the user's wallet
        Wallet::where('id', $id)->delete();

        // Update the wallet coins after deletion
        $this->walletCoins = Wallet::where('user_id', Auth::id())->get();

        session()->flash('message', 'Coin removed from wallet successfully!');
    }

    public function render()
    {
        return view('livewire.wallet-component', [
            'walletWithDetails' => $this->getWalletWithCoinDetails(),
        ]);
    }

    // Function to get wallet coins with corresponding API details
    public function getWalletWithCoinDetails()
    {
        // Create a collection of coins indexed by their coin_id for fast lookup
        $coinsMap = collect($this->coins)->keyBy('id');

        // Map each wallet coin to its corresponding API data
        return $this->walletCoins->map(function ($walletCoin) use ($coinsMap) {
            return [
                'coin_id' => $walletCoin->coin_id,
                'amount' => $walletCoin->amount,
                'details' => $coinsMap->get($walletCoin->coin_id), // Coin details from the API
            ];
        });
    }
}
