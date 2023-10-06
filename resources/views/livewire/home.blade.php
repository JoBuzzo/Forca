<div class="flex w-full mt-20 justify-evenly">
    <div class="flex flex-col w-1/6 p-4 border border-gray-300 rounded-md dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300">
        <h1 class="mb-5 text-xl font-bold">Categorias</h1>
        <ul class="ml-4 list-disc">
            @foreach ($categories as $category)
                <li>{{ $category->description }}</li>
            @endforeach
        </ul>
    </div>

    <div class="flex flex-col items-center justify-center">
        <div>
            @if ($message)
            {!! $message !!}
            @endif
            <div class="flex gap-2 mt-8">
                @foreach ($arrayWord as $w)
                    <div
                        class="flex items-center justify-center w-16 h-16 text-xl text-center uppercase border border-gray-300 rounded-md dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300">
                        @if (in_array($w, $letters))
                            {{ $w }}
                        @endif
                    </div>
                @endforeach
            </div>
        </div>



        <div class="flex flex-col items-center justify-center mt-48">
            <div class="flex items-center justify-center">
                <button wire:click="verifyLetter('1')" class="key">1</button>
                <button wire:click="verifyLetter('2')" class="key">2</button>
                <button wire:click="verifyLetter('3')" class="key">3</button>
                <button wire:click="verifyLetter('4')" class="key">4</button>
                <button wire:click="verifyLetter('5')" class="key">5</button>
                <button wire:click="verifyLetter('6')" class="key">6</button>
                <button wire:click="verifyLetter('7')" class="key">7</button>
                <button wire:click="verifyLetter('8')" class="key">8</button>
                <button wire:click="verifyLetter('9')" class="key">9</button>
                <button wire:click="verifyLetter('0')" class="key">0</button>
                <button wire:click="verifyLetter('-')" class="key">-</button>
            </div>
            <div class="flex items-center justify-center">
                <button wire:click="verifyLetter('q')" class="key">q</button>
                <button wire:click="verifyLetter('w')" class="key">w</button>
                <button wire:click="verifyLetter('e')" class="key">e</button>
                <button wire:click="verifyLetter('r')" class="key">r</button>
                <button wire:click="verifyLetter('t')" class="key">t</button>
                <button wire:click="verifyLetter('y')" class="key">y</button>
                <button wire:click="verifyLetter('u')" class="key">u</button>
                <button wire:click="verifyLetter('i')" class="key">i</button>
                <button wire:click="verifyLetter('o')" class="key">o</button>
                <button wire:click="verifyLetter('p')" class="key">p</button>
            </div>
            <div class="flex items-center justify-center">
                <button wire:click="verifyLetter('a')" class="key">a</button>
                <button wire:click="verifyLetter('s')" class="key">s</button>
                <button wire:click="verifyLetter('d')" class="key">d</button>
                <button wire:click="verifyLetter('f')" class="key">f</button>
                <button wire:click="verifyLetter('g')" class="key">g</button>
                <button wire:click="verifyLetter('h')" class="key">h</button>
                <button wire:click="verifyLetter('j')" class="key">j</button>
                <button wire:click="verifyLetter('k')" class="key">k</button>
                <button wire:click="verifyLetter('l')" class="key">l</button>
            </div>
            <div class="flex items-center justify-center">
                <button wire:click="verifyLetter('z')" class="key">z</button>
                <button wire:click="verifyLetter('x')" class="key">x</button>
                <button wire:click="verifyLetter('c')" class="key">c</button>
                <button wire:click="verifyLetter('v')" class="key">v</button>
                <button wire:click="verifyLetter('b')" class="key">b</button>
                <button wire:click="verifyLetter('n')" class="key">n</button>
                <button wire:click="verifyLetter('m')" class="key">m</button>
            </div>

        </div>

    </div>

    <div class="flex flex-col w-1/6 p-4 border border-gray-300 rounded-md dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300">
        <div class="flex items-start gap-2 mb-5">
            <span>Dica</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                <path
                    d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z">
                </path>
            </svg>
        </div>

        <ul class="ml-6 list-disc">
            @foreach ($tips as $tip)
                <li>{{ $tip->tip}}</li>
            @endforeach
        </ul>
    </div>
</div>
