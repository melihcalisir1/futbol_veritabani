<nav class="bg-white shadow-md">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-center space-x-8 py-4">
            <a href="{{ route('matches.all') }}" 
               class="@if(request()->routeIs('matches.all')) text-blue-600 font-bold @else text-gray-600 @endif hover:text-blue-600">
                All
            </a>
            <a href="{{ route('matches.odds') }}"
               class="@if(request()->routeIs('matches.odds')) text-blue-600 font-bold @else text-gray-600 @endif hover:text-blue-600">
                Odds
            </a>
            <a href="{{ route('matches.finished') }}"
               class="@if(request()->routeIs('matches.finished')) text-blue-600 font-bold @else text-gray-600 @endif hover:text-blue-600">
                Finished
            </a>
        </div>
    </div>
</nav> 