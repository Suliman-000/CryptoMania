<x-app-layout>
    <div class="container mx-auto px-4 text-gray-300">
        <div class=" mx-auto py-10">
            <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-6">{{ $coin['name'] }} ({{ $coin['symbol'] }})</h1>

            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <h3 class="text-xl font-semibold">Current Price</h3>
                        <p>${{ number_format($coin['priceUsd'], 2) }}</p>
                    </div>

                    <div>
                        <h3 class="text-xl font-semibold">Market Cap</h3>
                        <p>${{ number_format($coin['marketCapUsd'], 2) }}</p>
                    </div>

                    <div>
                        <h3 class="text-xl font-semibold">24h Volume</h3>
                        <p>${{ number_format($coin['volumeUsd24Hr'], 2) }}</p>
                    </div>

                    <div>
                        <h3 class="text-xl font-semibold">Supply</h3>
                        <p>{{ number_format($coin['supply'], 0) }} {{ $coin['symbol'] }}</p>
                    </div>

                    <div>
                        <h3 class="text-xl font-semibold">Change (24h)</h3>
                        <p class="{{ $coin['changePercent24Hr'] >= 0 ? 'text-green-500' : 'text-red-500' }}">
                            {{ number_format($coin['changePercent24Hr'], 2) }}%
                        </p>
                    </div>

                    <div>
                        <h3 class="text-xl font-semibold">Rank</h3>
                        <p>#{{ $coin['rank'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 mt-6">
                <h2 class="text-2xl mb-4">Price History (Last 30 Days)</h2>

                <!-- Canvas element for the chart -->
                <canvas id="coinChart"></canvas>
            </div>

            <a href="{{ route('coins.index') }}" class="mt-6 inline-block bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-200">
                Back to Coins List
            </a>
        </div>
    </div>

    <script>
        // Get the historical data from the server
        let historyData = @json($history);

        // Prepare the data for the chart
        let dates = historyData.map(data => new Date(data.time).toLocaleDateString());
        let prices = historyData.map(data => parseFloat(data.priceUsd).toFixed(2));

        // Create the chart using Chart.js
        const ctx = document.getElementById('coinChart').getContext('2d');
        const coinChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: dates, // X-axis (dates)
                datasets: [{
                    label: '{{ $coin['name'] }} Price (USD)',
                    data: prices, // Y-axis (prices)
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    fill: true,
                    tension: 0.4, // Makes the line smooth
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: false,
                        title: {
                            display: true,
                            text: 'Price (USD)'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Date'
                        }
                    }
                }
            }
        });
    </script>
</x-app-layout>
