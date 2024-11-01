<div class="container mx-auto p-4">
    <h1 class="text-2xl text-gray-200 font-bold my-12 mb-6">Latest Crypto News</h1>

    @if(session()->has('error'))
        <p class="text-red-500">{{ session('error') }}</p>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($articles as $article)
            <div class="news-item p-6 bg-gradient-to-r from-gray-800 via-gray-700 to-gray-800 rounded-lg shadow-lg transition-transform transform hover:-translate-y-1 hover:shadow-xl">
                <div class="flex items-start">
                    <!-- Icon -->
                    <div class="flex-shrink-0 p-2 rounded-full bg-blue-500">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16h6m-7 4h8m2 0a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v11a2 2 0 002 2z" />
                        </svg>
                    </div>

                    <!-- Content -->
                    <div class="ml-4 w-full">
                        <h2 class="text-xl font-semibold text-white mb-2 leading-tight">
                            {{ \Illuminate\Support\Str::limit($article['title'], 80) }}
                        </h2>
                        <p class="text-gray-400 text-sm mb-4">{{ \Carbon\Carbon::parse($article['published_at'])->format('F j, Y, g:i a') }}</p>
                        <p class="text-gray-300 mb-4">{{ $article['summary'] ?? 'No summary available.' }}</p>
                        <a href="{{ $article['url'] }}" target="_blank" class="inline-block text-sm font-medium text-blue-400 hover:text-blue-500 underline transition-colors duration-200">Read more →</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
