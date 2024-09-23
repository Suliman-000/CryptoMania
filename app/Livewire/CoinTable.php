<?php

namespace App\Livewire;

use App\Models\Wallet;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class CoinTable extends Component
{
    use WithPagination;

    public $selectedCoin;
    public $amount;
    public $isModalOpen = false;
    public $search = '';
    public $records;

    // Fetch coins when the component is initialized
    public function mount()
    {
        $this->fetchCoinsFromApi();
    }

    // Fetch coin data from the API with pagination
    public function fetchCoinsFromApi()
    {
        // Fetch all coins from the API
        $response = Http::withoutVerifying()->get('https://api.coincap.io/v2/assets')->json();
        $coins = $response['data'];

        // Filter coins based on the search input
        if ($this->search) {
            $coins = collect($coins)->filter(function ($coin) {
                return stripos($coin['name'], $this->search) !== false || stripos($coin['symbol'], $this->search) !== false;
            })->values()->all();
        }

        $this->records = $coins;
    }

    // Open the modal and set the selected coin
    public function openModal($coinId)
    {
        // Find the selected coin from the $records property by ID
        $this->selectedCoin = collect($this->records)->firstWhere('id', $coinId);

        if ($this->selectedCoin) {
            $this->isModalOpen = true;
        }
    }

    // Close the modal
    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->reset(['selectedCoin', 'amount']);
    }

    // Save the selected coin and amount to the wallet
    public function addToWallet()
    {
        $this->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        // Check if the coin already exists in the user's wallet
        $wallet = Wallet::where('user_id', Auth::id())
                    ->where('coin_id', $this->selectedCoin['id'])
                    ->first();

        if ($wallet) {
            // Coin exists in the wallet, update the amount
            $wallet->amount += $this->amount;
            $wallet->save();
        } else {
            // Coin does not exist, create a new entry
            Wallet::create([
                'user_id' => Auth::id(),
                'coin_name' => $this->selectedCoin['name'],
                'coin_id' => $this->selectedCoin['id'],
                'amount' => $this->amount,
                'current_price' => $this->selectedCoin['priceUsd'],
            ]);
        }

        // Close modal and reset form
        $this->closeModal();

        session()->flash('message', 'Coin added to wallet successfully!');
    }

    public function render()
    {
        // Fetch the coins again if search input changes
        $this->fetchCoinsFromApi();

        return view('livewire.coin-table', [
            'coins' => $this->records, // Pass paginated records to the view
        ]);
    }
}
