@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>List of Cryptocurrencies</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Short Name</th>
                    <th>Full Name</th>
                    <th>Price</th>
                    <th>Market Cap</th>
                    <th>24h Volume</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($coins as $coin)
                    <tr>
                        <td>{{ $coin['symbol'] }}</td>
                        <td>{{ $coin['name'] }}</td>
                        <td>{{ $coin['priceUsd'] }}</td>
                        <td>{{ $coin['marketCapUsd'] }}</td>
                        <td>{{ $coin['volumeUsd24Hr'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
