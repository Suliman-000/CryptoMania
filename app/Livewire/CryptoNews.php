<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class CryptoNews extends Component
{
    public $articles = [];

    public function mount()
    {
        $this->fetchCryptoNews();
    }

    public function fetchCryptoNews()
    {
        $response = Http::withoutVerifying()->get('https://cryptopanic.com/api/v1/posts/', [
            'auth_token' => env('CRYPTOPANIC_API_KEY'),
            'filter' => 'news',
            'region' => 'en', 
        ]);

        // If the response is successful, assign data to $articles
        if ($response->successful()) {
            $this->articles = $response->json()['results'] ?? [];
        } else {
            session()->flash('error', 'Failed to fetch news. Please try again.');
        }
    }

    public function render()
    {
        return view('livewire.crypto-news');
    }
}
