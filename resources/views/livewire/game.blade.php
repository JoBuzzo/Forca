<div>
    <div
        class="flex flex-col items-center justify-center w-full gap-4 px-4 mt-4 xl:gap-24 @if ($modal) blur-3xl @endif">

        <div class="flex flex-col w-full mb-10 justify-evenly xl:gap-96 xl:flex-row">

            <div class="flex flex-col p-4 mx-4 text-white rounded-lg xl:w-1/6">
                <h1 class="text-xl font-bold xl:mb-5">Categorias</h1>
                <ul class="ml-4 list-disc">
                    @foreach ($categories as $category)
                        <li>{{ $category->description }}</li>
                    @endforeach
                </ul>
            </div>


            <div class="flex flex-col p-4 mx-4 mb-6 text-white rounded-md xl:mb-0 xl:w-1/6 h-36 ">
                <div class="flex items-center justify-start gap-2 mb-5 cursor-pointer select-none hover:underline"
                    wire:click='tip'>
                    <span>Pedir dica</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                        <path
                            d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z">
                        </path>
                    </svg>
                </div>
                <div class="mb-2">Ao pedir dica você perde duas chances</div>

                @if (!$tips->isEmpty())
                    <ul class="ml-6 list-disc">
                        @foreach ($tips as $tip)
                            <li>{{ $tip->tip }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>

        <div class="flex items-center justify-center mx-4 mt-10 mb-10 xl:mb-0">
            <div>
                <div class="flex flex-col items-center justify-center gap-1 xl:flex-row ">
                    <div class="flex items-center justify-center gap-1">
                        @foreach ($arrayWord as $w)
                            @if ($w === '-')
                    </div>
                    <div class="flex justify-center gap-1">
                        <div
                            class="items-center justify-center hidden w-8 h-8 text-xl text-center uppercase bg-black border border-gray-300 rounded-md xl:flex xl:h-16 xl:w-16 dark:border-gray-700 dark:text-gray-300">
                            @if (in_array($w, $correctLetters))
                                {{ $w }}
                            @endif
                        </div>
                    @else
                        <div
                            class="flex items-center justify-center w-8 h-8 text-xl text-center uppercase bg-black border border-gray-300 rounded-md xl:h-16 xl:w-16 dark:border-gray-700 dark:text-gray-300">
                            @if (in_array($w, $correctLetters))
                                {{ $w }}
                            @endif
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
                <div class="flex flex-col items-start justify-center ">
                    <span>Chances: {{ $chances }}</span>
                    <div class="flex flex-col h-4">
                        @if ($message)
                            {!! $message !!}
                        @endif
                        @error('key')
                            <span class="text-sm text-red-600 md:text-base">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

        </div>




        <div class="flex flex-col items-center justify-center w-full">
            <div class="justify-start hidden p-1 lg:flex">
                <input wire:keydown.enter="handleKeyDown" wire:model="key"
                    class="uppercase bg-transparent border-0 focus:border-0 focus:ring-0 ring-0" id="key"
                    placeholder='Letra' />

                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        const inputField = document.getElementById('key');

                        function maintainFocus() {
                            if (window.innerWidth > 768) {
                                inputField.focus();
                            }
                        }

                        setInterval(maintainFocus, 1);

                        inputField.addEventListener('keydown', function(event) {
                            if (event.key === 'Enter') {
                                inputField.value = '';
                            }
                        });
                    });
                </script>
            </div>
            <div class="flex items-center justify-center w-full">
                <x-keyboard value="q" :corret="$correctLetters" :error="$errorLetters" />
                <x-keyboard value="w" :corret="$correctLetters" :error="$errorLetters" />
                <x-keyboard value="e" :corret="$correctLetters" :error="$errorLetters" />
                <x-keyboard value="r" :corret="$correctLetters" :error="$errorLetters" />
                <x-keyboard value="t" :corret="$correctLetters" :error="$errorLetters" />
                <x-keyboard value="y" :corret="$correctLetters" :error="$errorLetters" />
                <x-keyboard value="u" :corret="$correctLetters" :error="$errorLetters" />
                <x-keyboard value="i" :corret="$correctLetters" :error="$errorLetters" />
                <x-keyboard value="o" :corret="$correctLetters" :error="$errorLetters" />
                <x-keyboard value="p" :corret="$correctLetters" :error="$errorLetters" />
            </div>
            <div class="flex items-center justify-center w-full">
                <x-keyboard value="a" :corret="$correctLetters" :error="$errorLetters" />
                <x-keyboard value="s" :corret="$correctLetters" :error="$errorLetters" />
                <x-keyboard value="d" :corret="$correctLetters" :error="$errorLetters" />
                <x-keyboard value="f" :corret="$correctLetters" :error="$errorLetters" />
                <x-keyboard value="g" :corret="$correctLetters" :error="$errorLetters" />
                <x-keyboard value="h" :corret="$correctLetters" :error="$errorLetters" />
                <x-keyboard value="j" :corret="$correctLetters" :error="$errorLetters" />
                <x-keyboard value="k" :corret="$correctLetters" :error="$errorLetters" />
                <x-keyboard value="l" :corret="$correctLetters" :error="$errorLetters" />
            </div>
            <div class="flex items-center justify-center w-full">
                <x-keyboard value="z" :corret="$correctLetters" :error="$errorLetters" />
                <x-keyboard value="x" :corret="$correctLetters" :error="$errorLetters" />
                <x-keyboard value="c" :corret="$correctLetters" :error="$errorLetters" />
                <x-keyboard value="v" :corret="$correctLetters" :error="$errorLetters" />
                <x-keyboard value="b" :corret="$correctLetters" :error="$errorLetters" />
                <x-keyboard value="n" :corret="$correctLetters" :error="$errorLetters" />
                <x-keyboard value="m" :corret="$correctLetters" :error="$errorLetters" />
            </div>

        </div>
    </div>
    @if ($modal)
        <div class="absolute top-0 bottom-0 left-0 right-0 flex items-center justify-center p-2">
            <div
                class="flex flex-col items-center justify-center p-10 bg-black rounded-lg md:justify-normal md:items-stretch">
                <div class="flex items-center justify-start">
                    @if ($victory)
                        <h1 class="text-2xl font-extrabold">Parabéns, você venceu!</h1>
                    @else
                        <h1 class="text-2xl font-extrabold">Não foi dessa vez, mas jamais desista!</h1>
                    @endif
                </div>


                <div class="flex flex-col mt-10">
                    <span>Pontos: {{ Auth::user()->total_score - $chances }} <strong
                            class="ml-3 @if ($victory) text-secondary @else text-red-600 @endif">+{{ $chances }}</strong></span>
                    <span>Palavras jogas: {{ Auth::user()->words_count }} <strong
                            class="ml-3 @if ($victory) text-secondary @else text-red-600 @endif">+1</strong></span>
                </div>

                <div class="flex flex-col items-center justify-start mt-10">
                    <h1 class="text-2xl">A palavra é:</h1>
                    <h1 class="text-2xl font-extrabold uppercase text-secondary">{{ $word->word }}</h1>
                </div>


                <div class="flex flex-col items-center justify-center gap-4 mt-10 md:justify-start md:items-start">
                    <p>
                        Agora você pode escolhar jogar uma nova palavra ou ir para o menu principal.
                    </p>

                    <div class="flex items-center justify-center gap-4 md:justify-start">
                        <a href="{{ route('home') }}"
                            class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out border border-transparent rounded-md cursor-pointer bg-secondary hover:bg-secondary focus:bg-secondary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800">
                            Menu
                        </a>
                        <x-primary-button wire:click='random'>Jogar</x-primary-button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
