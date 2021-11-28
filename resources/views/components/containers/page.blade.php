<div class="bg-azure border-b-2 border-space">
    <div class="container py-2">
        <div class="flex justify-between items-center">
            <a class="block" href="/"><img src="/img/logo/white.png" width="130" alt="Slope Squad logo"/></a>
            @auth
                <div x-data="{ open: false }" class="flex items-center space-x-2 relative">
                    <i @click.prevent="open = !open" x-show="!open" class="fas fa-bars fa-2x text-white px-4 hover:cursor-pointer"></i>
                    <i @click.prevent="open = !open" x-show="open" x-cloak class="fas fa-times fa-2x text-white px-4 hover:cursor-pointer"></i>
                    <x-button>Add a Day</x-button>

                    <div x-show="open" x-cloak @click.away="open = false" class="absolute top-11 w-full bg-white shadow-md rounded-md px-5 py-4 space-y-4">
                        <p>Hi, {{ $loggedInUser->getName() }}</p>
                        <hr class="-mx-2"/>
                        <div class="space-y-3">
                            <a class="block" href="#">I'm a bit longer</a>
                            <a class="block" href="#">Your mountains</a>
                            <a class="block" href="#">Why hello there</a>
                        </div>
                        <hr class="-mx-2"/>
                        <form method="post" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-azure-darker hover:underline">Log out</button>
                        </form>
                    </div>
                </div>
            @else
                <div class="text-white space-x-2">
                    <a class="text-white" href="{{ route('login') }}">Log in</a>
                    <span class="font-bold inline-block">&middot;</span>
                    <a class="text-white" href="{{ route('register') }}">Sign up</a>
                </div>
            @endauth
        </div>
    </div>
</div>

<div class="bg-white">
    <div class="container">
        {{ $slot }}
    </div>
</div>

<div class="bg-space pt-10 pb-20 text-white text-sm">
    <div class="container flex flex-col items-center space-y-8">
        <p class="text-center" x-data="randomQuote()">
            "<span x-text="quote"></span>" - <span x-text="source"></span>
        </p>
        <div class="space-y-1 text-center">
            <p>&copy; {{ date('Y') }} <a class="text-white" target="_blank" href="https://www.winterfactory.com">Winter Factory LLC</a></p>
            <p>Made in Boulder, CO</p>
        </div>
    </div>

    <script>
        function randomQuote() {
            return {
                quote: '',
                source: '',
                allQuotes: [
                    ['There is no such thing as too much snow.', 'Doug Coombs'],
                    ['Climb the mountains and get their good tidings.', 'John Muir'],
                    ['I\'d rather be in the mountains thinking about God than in church thinking about the mountains.', 'John Muir'],
                    ['Remember, if you don\'t do it this year, you\'ll be one year older when you do.', 'Warren Miller'],
                    ['The best place in the world to ski is where you’re skiing that day.', 'Warren Miller'],
                    ['Winter is coming.', 'Ned Stark'],
                    ['Skiing is the best way in the world to waste time.', 'Glen Plake']
                ],

                init() {
                    let idx = Math.floor(Math.random() * this.allQuotes.length);
                    this.quote = this.allQuotes[idx][0];
                    this.source = this.allQuotes[idx][1];
                }
            }
        }
    </script>
</div>