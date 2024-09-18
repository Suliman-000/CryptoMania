<div class="container mx-auto p-4">
    <h1 class="text-2xl text-gray-200 font-bold my-6">List of Cryptocurrencies</h1>

    <!-- Coin Table -->
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">Short Name</th>
                    <th scope="col" class="px-6 py-3">Full Name</th>
                    <th scope="col" class="px-6 py-3">Price</th>
                    <th scope="col" class="px-6 py-3">Market Cap</th>
                    <th scope="col" class="px-6 py-3">24h Volume</th>
                    <th scope="col" class="px-6 py-3 text-center">Actions</th> <!-- Align center for actions -->
                </tr>
            </thead>
            <tbody>
                @foreach ($coins as $coin)
                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
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
                            ${{ number_format($coin['marketCapUsd'], 2) }}
                        </td>
                        <td class="px-6 py-4">
                            ${{ number_format($coin['volumeUsd24Hr'], 2) }}
                        </td>
                        <td class="px-6 py-4">
                            <!-- Action buttons -->
                            <div class="flex justify-center space-x-2">
                                <!-- View Details Button -->
                                <a href="{{ route('coins.show', $coin['id']) }}" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-700">
                                    View Details
                                </a>

                                <!-- Add to Wallet Button -->
                                <button wire:click="openModal('{{ $coin['id'] }}')" class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-700">
                                    Add to Wallet
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    @if ($isModalOpen)
        <div class="fixed inset-0 bg-gray-600 bg-opacity-75 flex justify-center items-center">
            <div class="bg-white rounded-lg p-6 w-96">
                <h2 class="text-xl font-bold mb-4">Add {{ $selectedCoin['name'] }} to Wallet</h2>

                <!-- Amount input -->
                <div class="mb-4">
                    <label for="amount" class="block text-sm font-medium text-gray-700">Amount</label>
                    <input type="number" wire:model="amount" step="0.00000001" min="0" class="mt-1 block w-full" />
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

    <!-- Success Message -->
    @if (session()->has('message'))
        <div class="mt-4 text-green-600">
            {{ session('message') }}
        </div>
    @endif
</div>
