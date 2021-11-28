<div class="bg-azure">
    heada
</div>

<div class="bg-white">
    {{ $slot }}
</div>

<div class="bg-space pt-6 pb-12 text-white text-sm flex flex-col items-center">
    <div class="space-y-1 mb-4 text-center">
        <p>&copy; {{ date('Y') }} <a target="_blank" href="https://www.winterfactory.com">Winter Factory LLC</a></p>
        <p>Made in Boulder, CO</p>
    </div>
    <p x-data="randomQuote()">
        "<span x-text="quote"></span>" - <span x-text="source"></span>
    </p>
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