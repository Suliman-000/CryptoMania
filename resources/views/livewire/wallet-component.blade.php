<div>
    <!-- Display success message -->
    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <h3>Add a Coin to Your Wallet</h3>

    <form wire:submit.prevent="addCoin">
        <div class="form-group">
            <label for="coin">Select Coin</label>
            <select wire:model="selectedCoin" class="form-control">
                <option value="">-- Choose a coin --</option>
                @foreach ($coins as $coin)
                    <option value="{{ $coin['id'] }}">{{ $coin['name'] }} ({{ $coin['symbol'] }})</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="amount">Amount</label>
            <input type="number" step="0.00000001" wire:model="amount" class="form-control" placeholder="Enter amount">
        </div>

        <button type="submit" class="btn btn-primary">Add Coin</button>
    </form>

    <h3>Your Wallet</h3>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Coin</th>
                <th>Amount</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($walletWithDetails as $walletCoin)
                @if ($walletCoin['details']) <!-- Check if coin details are available from API -->
                    <tr>
                        <td>{{ $walletCoin['details']['name'] }} ({{ $walletCoin['details']['symbol'] }})</td>
                        <td>{{ $walletCoin['amount'] }}</td>
                        <td>
                            <button wire:click="deleteCoin({{ $walletCoin['id'] }})" class="btn btn-danger">Delete</button>
                        </td>
                    </tr>
                @else
                    <tr>
                        <td>Coin data unavailable</td>
                        <td>{{ $walletCoin['amount'] }}</td>
                        <td>
                            <button wire:click="deleteCoin({{ $walletCoin['id'] }})" class="btn btn-danger">Delete</button>
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>
