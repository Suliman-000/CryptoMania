<div class="container mx-auto p-4">
    <h1 class="text-2xl text-gray-200 font-bold my-12 mb-6">Your Wallet</h1>

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
                    <th scope="col" class="px-6 py-3">Coin Name</th>
                    <th scope="col" class="px-6 py-3">Amount</th>
                    <th scope="col" class="px-6 py-3">Current Price</th>
                    <th scope="col" class="px-6 py-3">Total Value</th>
                    <th scope="col" class="px-6 py-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($wallets as $wallet)
                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                        <td class="px-6 py-4">{{ $wallet->coin_name }}</td>
                        <td class="px-6 py-4">{{ $wallet->amount }}</td>
                        <td class="px-6 py-4">${{ number_format($wallet->current_price, 2) }}</td>
                        <td class="px-6 py-4">${{ number_format($wallet->amount * $wallet->current_price, 2) }}</td>
                        <td class="px-6 py-4 flex justify-center items-center">
                            <button wire:click="openSellModal('{{ $wallet->id }}')" class="w-full md:w-1/3 h-[30px] py-4 bg-red-700 flex justify-center items-center rounded-md text-gray-200 hover:bg-red-600 transition-all duration-150">
                                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                        <td colspan="6" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">
                            <div class="flex flex-col justify-center items-center h-full text-xl">
                                Your wallet is empty...
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

    <!-- Modal for selling a coin -->
    @if ($isModalOpen)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white w-1/3 p-6 rounded-md shadow-lg">
            <h2 class="text-xl font-bold mb-4">Sell Coin: {{ $selectedCoin->coin_name ?? '' }}</h2>

            <!-- Form for selling coin -->
            <form wire:submit.prevent="sellCoin">
                <div class="mb-4">
                    <label for="sellAmount" class="block text-gray-700">Amount to Sell</label>
                    <input type="number"
                        wire:model="sellAmount"
                        id="sellAmount"
                        class="w-full p-2 border border-gray-300 rounded-md"
                        max="{{ $selectedCoin->amount ?? 0 }}"
                        min="1"
                        value="{{ $selectedCoin->amount ?? 0 }}"> <!-- Prefill input -->
                    @error('sellAmount') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>

                <!-- Sell Button -->
                <div class="flex justify-end">
                    <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-700 transition-all ease-in-out duration-200">Sell</button>
                    <button type="button" wire:click="closeModal" class="ml-2 px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">Cancel</button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>
