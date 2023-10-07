<button 
    wire:click="verifyLetter('{{ $value }}')" 
    class="flex items-center justify-center w-16 h-16 p-4 text-xl text-center uppercase border  text-gray-300
    @if (in_array($value, $this->errorLetters))
        dark:bg-red-700 border-red-800
    @endif
    @if (in_array($value, $this->correctLetters))
        dark:bg-green-700 border-green-800
    @endif
    border-gray-700">
    {{ $value }}
</button>
