<div class="flex flex-col items-center justify-center mt-4 space-y-10 x-4">

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
                            class="items-center justify-center hidden w-8 h-8 text-xl text-center uppercase bg-black border border-gray-300 rounded-md xl:flex xl:h-16 xl:w-16 dark:border-gray-700 dark:text-gray-300">
                            @if (in_array($w, $correctLetters))
                                {{ $w }}
                            @endif
                        </div>
                @else
                    <div class="flex items-center justify-center w-8 h-8 text-xl text-center uppercase bg-black border border-gray-300 rounded-md xl:h-16 xl:w-16 dark:border-gray-700 dark:text-gray-300">
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
            <input wire:keydown.enter="handleKeyDown" wire:model="key" class="uppercase bg-transparent border-0 focus:border-0 focus:ring-0 ring-0" id="key" placeholder='Digite uma letra' />

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
