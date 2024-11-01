<div class="container mx-auto p-6">
    <h1 class="text-3xl text-gray-200 font-bold my-12 text-center">Exchange List</h1>

    <ul class="space-y-6">
        @foreach($exchanges as $exchange)
            <li class="exchange-item p-6 bg-gray-900 rounded-lg shadow-lg transition-transform transform hover:scale-105">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                    <div class="md:flex-1">
                        <h2 class="text-2xl font-semibold text-white">Rank: <span class="text-blue-400">{{ $exchange['rank'] }}</span></h2>
                        <p class="text-lg text-gray-300">Name: <span class="text-white font-bold">{{ $exchange['name'] }}</span></p>
                        <p class="text-lg text-gray-300">Volume (USD): <span class="text-green-400 font-bold">${{ number_format($exchange['volumeUsd'], 2) }}</span></p>
                    </div>
                    <a href="{{ $exchange['exchangeUrl'] }}" target="_blank" class="mt-4 md:mt-0 bg-blue-600 hover:bg-blue-500 text-white font-semibold py-3 px-6 rounded-lg transition duration-300 shadow hover:shadow-md">Visit Exchange</a>
                </div>
            </li>
        @endforeach
    </ul>
</div>
