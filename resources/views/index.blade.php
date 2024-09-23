<x-app-layout>

    <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700" />

    <div class="container mx-auto flex flex-col text-white my-8">
        <div class="my-auto mb-8 mt-12 w-full grid-cols-1 justify-center md:flex md:gap-5 lg:grid lg:grid-cols-2">
            <div class="col-span-1 flex flex-col justify-center text-center md:w-3/5 lg:w-full lg:justify-center lg:text-left">
                <div class="mb-4 flex items-center justify-center lg:justify-start">
                    <h4 class="text-sm uppercase font-bold tracking-widest text-primary">
                        Real-Time Crypto Pulse
                    </h4>
                </div>
                <h1 class="mb-8 text-4xl font-extrabold leading-tight text-dark-grey-900 lg:text-5xl xl:w-11/12 xl:text-6xl">
                    Discover the Future of Digital Currency
                </h1>
                <p class="mb-10 text-base font-medium leading-7 text-dark-grey-600 xl:w-3/4">
                    Explore real-time market data and insights on top cryptocurrencies. Stay ahead in the evolving world of blockchain with detailed stats, prices, and trends, all in one place.
                </p>
                <div class="flex flex-col items-center lg:flex-row">
                    <a href="{{ route('coins.index') }}" class="flex items-center rounded-xl bg-indigo-500 px-5 py-4 text-sm font-medium text-white transition hover:bg-indigo-600 focus:bg-indigo-700">
                        Get started now
                    </a>
                </div>
            </div>
            <div class="col-span-1 hidden items-center justify-end lg:flex">
                <img
                    class="w-4/5 rounded-2xl"
                    src="{{ asset('img/cryptomania-home-hero-image.jpg') }}"
                    alt="header image"
                />
            </div>
        </div>
    </div>

    <div class="relative font-sans before:absolute before:w-full before:h-full before:inset-0 before:bg-black before:opacity-50 before:z-10">
        <img src="{{ asset('img/crytomania-home-banner-image.jpg') }}" alt="Banner Image" class="absolute inset-0 w-full h-full object-cover" />

        <div class="min-h-[350px] relative z-50 h-full max-w-6xl mx-auto flex flex-col justify-center items-center text-center text-white p-6">
            <h2 class="sm:text-4xl text-2xl font-bold mb-6">Explore the World of Cryptocurrencies</h2>
            <p class="sm:text-lg text-base text-center text-gray-200">Stay updated with real-time market data, track your favorite coins, and make informed investment decisions—all in one place.</p>

            <a href="#table"
                class="mt-12 bg-transparent text-white text-base py-3 px-6 border border-white rounded-lg hover:bg-white hover:text-black transition duration-300">
                Buy Now
            </a>
        </div>
    </div>

    <section class="bg-white dark:bg-gray-900">
        <div class="gap-16 items-center py-8 px-4 mx-auto max-w-screen-2xl lg:grid lg:grid-cols-2 lg:py-16 lg:px-6">
            <div class="font-light text-gray-500 sm:text-lg dark:text-gray-400">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Unlock the World of Crypto</h2>
                <p class="mb-4">At Cryptomania, we’re more than just a platform. We’re innovators in the crypto space, delivering real-time data, market trends, and investment tools to help you make smarter financial decisions in the fast-moving world of digital assets.</p>
                <p>Whether you're new to crypto or a seasoned investor, Cryptomania provides the insights and features you need to stay ahead of the market.</p>
            </div>
            <div class="grid grid-cols-2 gap-4 mt-8">
                <img class="mt-4 w-full lg:mt-10 rounded-lg" src="{{ asset('img/cryptomania-home-content-image-2.jpg') }}" alt="crypto portfolio tracking">
                <img class="w-full rounded-lg" src="{{ asset('img/cryptomania-home-content-image-1.jpg') }}" alt="cryptocurrency chart">
            </div>
        </div>
    </section>

    <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700" />

    <div class="text-white">
        <div class="relative isolate px-6 pt-14 lg:px-8">
            <div class="mx-auto max-w-2xl py-12 sm:py-12 lg:py-12">
                <div class="hidden sm:mb-8 sm:flex sm:justify-center">
                    <div class="relative rounded-full px-3 py-1 text-sm leading-6 ring-1 ring-gray-900/10 hover:ring-gray-900/20">
                        Stay Ahead with Cryptomania. <a href="#" class="font-semibold text-indigo-600"></a>
                    </div>
                </div>
                <div class="text-center">
                    <h1 class="text-4xl font-bold tracking-tight sm:text-6xl">Cryptomania: Your Digital Asset Hub</h1>
                    <p class="mt-6 text-lg leading-8">Track, Trade, and Thrive in the World of Real-Time Crypto.</p>
                    <div class="mt-10 flex items-center justify-center gap-x-6">
                    <a href="{{ route('coins.index') }}" class="rounded-md w-full bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Get started</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-white rounded-lg shadow dark:bg-gray-900 mt-24">
        <div class="w-full mx-auto p-4 md:py-8">
            <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700" />
            <span class="block text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2024 <a href="#" class="hover:underline">Crytomania™</a>. All Rights Reserved.</span>
        </div>
    </footer>
</x-app-layout>
