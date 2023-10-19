<div>
    @if (!$modal)
        <div
            class="flex flex-col items-center justify-center w-full gap-4 px-4 mt-4 xl:gap-24 @if ($modal) blur-3xl @endif">

            <div class="flex flex-col items-center justify-center w-full">
                <span class="text-2xl font-extrabold">Vidas: {{ $lifes }}</span>
            </div>

            <div class="flex flex-col items-center justify-center gap-1 xl:flex-row ">
                <div class="flex items-center justify-center gap-1">
                    @foreach ($wordArr as $w)
                        @if ($w === '-')
                            </div>
                            <div class="flex justify-center gap-1">
                                <div
                                    class="items-center justify-center hidden w-8 h-8 text-xl text-center text-gray-300 uppercase bg-black border border-gray-700 rounded-md xl:flex xl:h-16 xl:w-16">
                                    @if (in_array($w, $correctLetters))
                                        {{ $w }}
                                    @endif
                                </div>
                        @else
                                <div
                                    class="flex items-center justify-center w-8 h-8 text-xl text-center text-gray-300 uppercase bg-black border border-gray-700 rounded-md xl:h-16 xl:w-16">
                                    @if (in_array($w, $correctLetters))
                                        {{ $w }}
                                    @endif
                                </div>
                            @endif
                    @endforeach
                </div>
            </div>

            <div class="flex flex-col items-center justify-center w-full">
                <div class="justify-start hidden p-1 md:flex">
                    <input wire:keydown.enter="handleKeyDown" wire:model="key"
                        class="uppercase bg-transparent border-0 focus:border-0 focus:ring-0 ring-0" id="key"
                        placeholder='Digite uma letra' />

                    @if (!$modal)
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
                    @endif
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

    

    @else
        <div class="absolute bottom-0 left-0 right-0 flex items-center justify-center p-2 top-16">
            <div
                class="flex flex-col items-center justify-center p-8 bg-black rounded-lg md:justify-normal md:items-stretch">

                <div class="flex items-center justify-start">
                    @if ($win)
                        <h1 class="text-3xl font-extrabold">Parabéns, você venceu!</h1>
                    @else
                        <h1 class="text-3xl font-extrabold">Não foi dessa vez, mas jamais desista!</h1>
                    @endif
                </div>

                <div class="flex flex-col items-center justify-start mt-10 mb-5">
                    <h1 class="text-4xl">A palavra é:</h1>
                    <h1 class="text-4xl font-extrabold uppercase @if ($win) text-secondary  @else text-[#FF3C3C] @endif">
                        {{ $word }}
                    </h1>
                </div>
                
                <div class="flex flex-col items-start justify-start mt-10">
                    <h1 class="text-lg">A Letras erradas:</h1>
                    <div class="flex flex-wrap items-center justify-center">
                        @foreach ($errorLetters as $errorLetter)
                            <div
                                class="flex items-center justify-center w-8 h-8 text-xl text-center text-gray-300 uppercase bg-[#FF3C3C] border border-gray-700 rounded-md xl:h-12 xl:w-12">
                                {{ $errorLetter }}
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="flex flex-col items-start justify-start mt-10">
                    <h1 class="text-lg">A Letras erradas:</h1>
                    <div class="flex flex-wrap items-center justify-center">
                        @foreach ($correctLetters as $currectLetter)
                            <div
                                class="flex items-center justify-center w-8 h-8 text-xl text-center text-gray-300 uppercase border border-gray-700 rounded-md bg-secondary xl:h-12 xl:w-12">
                                {{ $currectLetter }}
                            </div>
                        @endforeach
                    </div>
                </div>
                
                <div class="flex flex-col items-center justify-center gap-4 mt-10 md:justify-start md:items-start">
                    <p>
                        Agora você pode escolhar jogar uma nova palavra ou ir para o menu principal.
                    </p>

                    <div class="flex items-center justify-center gap-4 md:justify-start">
                        <button type="button"
                            class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out border border-transparent rounded-md cursor-pointer bg-secondary hover:bg-secondary focus:bg-secondary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800">
                            Menu
                        </button>
                        <x-primary-button>Jogar</x-primary-button>
                    </div>
                </div>
            </div>
        </div>
    @endif

</div>
