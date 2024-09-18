<?php

namespace App\Livewire;

use App\Models\Wallet;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Livewire\WithPagination;

class CoinTable extends Component
{
    use WithPagination;

    public $coins;
    public $selectedCoin;
    public $amount;
    public $isModalOpen = false;

    // Fetch coins when component is initialized
    public function mount()
    {
        $this->coins = $this->fetchCoinsFromApi();
    }

    // Function to fetch the coin data from the API
    public function fetchCoinsFromApi()
    {
        $response = Http::get('https://api.coincap.io/v2/assets');
        if ($response->successful()) {
            return $response->json()['data'];
        }
        return [];
    }

    // Open the modal and set the selected coin
    public function openModal($coinId)
    {
        // Find the selected coin from the $coins property by ID
        $this->selectedCoin = collect($this->coins)->firstWhere('id', $coinId);

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
            'amount' => 'required|numeric|min:0.00000001',
        ]);

        // Save the selected coin to the wallet
        Wallet::create([
            'user_id' => Auth::id(),
            'coin_name' => $this->selectedCoin['name'],
            'coin_id' => $this->selectedCoin['id'],
            'amount' => $this->amount,
            'current_price' => $this->selectedCoin['priceUsd'],
        ]);

        // Close modal and reset form
        $this->closeModal();

        session()->flash('message', 'Coin added to wallet successfully!');
    }

    public function render()
    {
        return view('livewire.coin-table');
    }
}
