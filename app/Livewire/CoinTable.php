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
    public $records;

    // Fetch coins when the component is initialized
    public function mount()
    {
        $this->fetchCoinsFromApi();
    }

    // Fetch coin data from the API with pagination
    public function fetchCoinsFromApi()
    {
        $response = Http::withoutVerifying()->get('https://api.coincap.io/v2/assets')->json();

        $this->records = $response['data'];
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
        return view('livewire.coin-table', [
            'coins' => $this->records, // Pass paginated records to the view
        ]);
    }
}
