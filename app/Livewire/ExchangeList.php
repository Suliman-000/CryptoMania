<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class ExchangeList extends Component
{
    public $exchanges = [];

    public function mount()
    {
        $response = Http::withoutVerifying()->get('https://api.coincap.io/v2/exchanges');
        $this->exchanges = $response->json()['data'] ?? [];
    }

    public function render()
    {
        return view('livewire.exchange-list');
    }
}
