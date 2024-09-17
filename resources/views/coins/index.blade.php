@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-6">List of Cryptocurrencies</h1>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">Short Name</th>
                        <th scope="col" class="px-6 py-3">Full Name</th>
                        <th scope="col" class="px-6 py-3">Price</th>
                        <th scope="col" class="px-6 py-3">Market Cap</th>
                        <th scope="col" class="px-6 py-3">24h Volume</th>
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
                                ${{ number_format($coin['marketCapUsd']) }}
                            </td>
                            <td class="px-6 py-4">
                                ${{ number_format($coin['volumeUsd24Hr']) }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination Links -->
        <div class="mt-4">
            {{ $coins->links() }}
        </div>
    </div>
@endsection
