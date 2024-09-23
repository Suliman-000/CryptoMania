<x-app-layout>
    <div class="relative font-sans before:absolute before:w-full before:h-full before:inset-0 before:bg-black before:opacity-50 before:z-10">
        <img src="{{ asset('img/cryptomania-wallet-banner-image.jpg') }}" alt="Banner Image" class="absolute inset-0 w-full h-full object-cover" />

        <div class="min-h-[450px] relative z-50 h-full max-w-6xl mx-auto flex flex-col justify-center items-center text-center text-white p-6">
            <h2 class="sm:text-4xl text-2xl font-bold mb-6">Securely Manage Your Crypto Wallet</h2>
            <p class="sm:text-lg text-base text-center text-gray-200">Store, track, and manage all your cryptocurrencies with ease. Cryptomania’s wallet keeps your assets safe and accessible at all times.</p>

            <a href="#table"
                class="mt-12 bg-transparent text-white text-base py-3 px-6 border border-white rounded-lg hover:bg-white hover:text-black transition duration-300">
                Manage Your Wallet
            </a>
        </div>
    </div>

    <section id="table">
        @livewire('wallet-table')
    </section>

    <footer class="bg-white rounded-lg shadow dark:bg-gray-900 mt-36">
        <div class="w-full mx-auto p-4 md:py-8">
            <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700" />
            <span class="block text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2024 <a href="#" class="hover:underline">Crytomania™</a>. All Rights Reserved.</span>
        </div>
    </footer>
</x-app-layout>
