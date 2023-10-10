<div class="flex flex-col items-center justify-center w-full mt-4 md:mt-20">

    <div class="flex flex-col w-full gap-4 justify-evenly md:gap-96 md:flex-row">
        <div
            class="flex flex-col p-4 mx-4 border border-gray-300 rounded-md dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 md:w-1/6">
            <h1 class="text-xl font-bold md:mb-5">Categorias</h1>
            <ul class="ml-4 list-disc">
                @foreach ($categories as $category)
                    <li>{{ $category->description }}</li>
                @endforeach
            </ul>
        </div>


        <div
            class="flex flex-col p-4 mx-4 mb-6 border border-gray-300 rounded-md md:mb-0 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 md:w-1/6">
            <div class="flex items-center justify-start gap-2 mb-5 cursor-pointer hover:underline" wire:click='tip'>
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

    <div class="flex flex-col items-center justify-center mx-4">
        <div>

            <div class="flex flex-col items-center justify-center gap-1 md:flex-row ">
                <div class="flex items-center justify-center gap-1">
                    @foreach ($arrayWord as $w)
                        @if ($w === '-')
                </div>
                <div class="flex justify-center gap-1">
                    <div
                        class="items-center justify-center hidden text-xl text-center uppercase border border-gray-300 rounded-md md:flex w-9 h-9 md:h-16 md:w-16 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300">
                        @if (in_array($w, $correctLetters))
                            {{ $w }}
                        @endif
                    </div>
                @else
                    <div
                        class="flex items-center justify-center text-xl text-center uppercase border border-gray-300 rounded-md w-9 h-9 md:h-16 md:w-16 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300">
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
                @if ($message)
                    {!! $message !!}
                @endif
            </div>
        </div>

        <div class="flex flex-col items-center justify-center mt-24 mb-10">
            <div class="flex items-center justify-center">
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
            <div class="flex items-center justify-center">
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
            <div class="flex items-center justify-center">
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
</div>
