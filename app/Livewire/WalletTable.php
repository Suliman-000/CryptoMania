<?php

namespace App\Livewire;

use App\Models\Wallet;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class WalletTable extends Component
{
    public $wallets;
    public $sellAmount;
    public $selectedCoin;
    public $isModalOpen = false;

    // Fetch the data when the component is initialized
    public function mount()
    {
        // Retrieve all records from the wallet table
        $this->wallets = Wallet::where('user_id', auth()->id())->get(); // Fetch user-specific wallet data
    }

    // Method to open the modal for selling a coin
    public function openSellModal($coinId)
    {
        $this->selectedCoin = Wallet::where('user_id', Auth::id())->where('id', $coinId)->first();

        if ($this->selectedCoin) {
            $this->sellAmount = $this->selectedCoin->amount;  // Reset sell amount
            $this->isModalOpen = true;  // Open the modal
        }
    }

    // Method to handle the sale of coins
    public function sellCoin()
    {
        // Ensure there is a selected coin
        if (!$this->selectedCoin) {
            session()->flash('error', 'No coin selected.');
            return;
        }

        // Validate the sell amount, and ensure it's not greater than what the user has
        $this->validate([
            'sellAmount' => 'required|numeric|min:0.00000001|max:' . $this->selectedCoin->amount,
        ]);

        // Find the coin in the user's wallet
        $wallet = Wallet::where('user_id', Auth::id())
                    ->where('id', $this->selectedCoin->id)
                    ->first();

        if ($wallet) {
            // Check if the user has enough coins to sell (handled in validation, but check again)
            if ($wallet->amount >= $this->sellAmount) {
                // Subtract the sell amount from the wallet
                $wallet->amount -= $this->sellAmount;

                // If the amount is 0, delete the record from the wallet
                if ($wallet->amount <= 0) {
                    $wallet->delete();
                } else {
                    // Otherwise, update the wallet record
                    $wallet->save();
                }

                // Flash a success message
                session()->flash('message', 'Coins sold successfully!');
            } else {
                // Not enough coins to sell
                session()->flash('error', 'Insufficient coins to sell.');
            }
        }

        // Close modal and reset modal data
        $this->isModalOpen = false;
        $this->reset(['sellAmount', 'selectedCoin']);

        // Refresh the wallets after selling
        $this->wallets = Wallet::where('user_id', Auth::id())->get();
    }

    // Method to close the modal
    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->reset(['sellAmount', 'selectedCoin']);
    }

    public function render()
    {
        return view('livewire.wallet-table', [
            'wallets' => $this->wallets,
        ]);
    }
}
