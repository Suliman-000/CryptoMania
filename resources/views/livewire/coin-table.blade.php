<div class="container mx-auto p-4">
    <div class="flex flex-col md:flex-row items-center justify-between">
        <h1 class="text-2xl text-gray-200 font-bold my-12 mb-6">List of Cryptocurrencies</h1>

        <form class="w-full md:w-1/3 mb-4 md:mb-0">
            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>
                <input wire:model.debounce.300ms.live="search" type="search" id="default-search" class="block w-full p-2 mt-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for a coin..." required />
            </div>
        </form>
    </div>

    <!-- Success Message -->
    @if (session()->has('message'))
        <div class="my-4 text-green-600">
            {{ session('message') }}
        </div>
    @endif

    <!-- Coin Table -->
    <div class="relative overflow-auto max-h-[700px] shadow-md sm:rounded-lg coin-table">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="sticky top-0 z-10 text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">Coin</th>
                    <th scope="col" class="px-6 py-3">Short Name</th>
                    <th scope="col" class="px-6 py-3">Full Name</th>
                    <th scope="col" class="px-6 py-3">Price (USD)</th>
                    <th scope="col" class="px-6 py-3">Price (EUR)</th>
                    <th scope="col" class="px-6 py-3">Market Cap</th>
                    <th scope="col" class="px-6 py-3">24h Volume</th>
                    <th scope="col" class="px-6 py-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($coins as $coin)
                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                        <th class="px-6 py-4">
                            <img src="https://assets.coincap.io/assets/icons/{{ strtolower($coin['symbol']) }}@2x.png" alt="{{ $coin['name'] }} icon" width="32" height="32">
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $coin['symbol'] }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $coin['name'] }}
                        </td>
                        <td class="px-6 py-4">
                            ${{ number_format($coin['priceUsd'], 2) }}
                        </td>
                        <td class="px-6 py-4">
                            €{{ number_format($coin['priceEur'], 2) }}
                        </td>
                        <td class="px-6 py-4">
                            ${{ number_format($coin['marketCapUsd'], 2) }}
                        </td>
                        <td class="px-6 py-4">
                            ${{ number_format($coin['volumeUsd24Hr'], 2) }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex justify-center space-x-2">
                                <a href="{{ route('coins.show', $coin['id']) }}" class="px-4 py-2 bg-indigo-500 text-white rounded-lg hover:bg-indigo-700 transition-all ease-in-out duration-200">
                                    View Details
                                </a>
                                <button wire:click="openModal('{{ $coin['id'] }}')" class="px-4 py-2 bg-green-700 text-white rounded-lg hover:bg-green-500 transition-all ease-in-out duration-200">
                                    Add to Wallet
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                        <td colspan="7" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">
                            <div class="flex flex-col justify-center items-center h-full text-xl">
                                No results found...
                                <div>
                                    <img class="w-full h-[300px]" src="{{ asset('img/empty.png') }}" alt="Empty table">
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    @if ($isModalOpen)
        <div class="fixed inset-0 bg-gray-600 bg-opacity-75 flex justify-center items-center z-[999]">
            <div class="bg-white rounded-lg p-6 w-96">
                <h2 class="text-xl font-bold mb-4">Add {{ $selectedCoin['name'] }} to Wallet</h2>

                <!-- Amount input -->
                <div class="mb-4">
                    <label for="amount" class="block text-sm font-medium text-gray-700">Amount</label>
                    <input type="number" wire:model="amount" min="1" class="mt-1 block w-full" />
                    @error('amount') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <!-- Action buttons -->
                <div class="flex justify-end">
                    <button wire:click="closeModal" class="px-4 py-2 bg-gray-500 text-white rounded-md mr-2">
                        Cancel
                    </button>
                    <button wire:click="addToWallet" class="px-4 py-2 bg-blue-600 text-white rounded-md">
                        Add to Wallet
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
