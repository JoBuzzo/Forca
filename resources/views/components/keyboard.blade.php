
@php
    $error = in_array($value, $this->errorLetters);
    $correct = in_array($value, $this->correctLetters);
@endphp

<button 
    wire:click="verifyLetter('{{ $value }}')" 
    class="flex items-center justify-center sm:w-16 sm:h-16 p-4 text-xl text-center uppercase border text-gray-300 w-[37px] h-[37px]
    @if ($error)
        dark:bg-red-700 border-red-800
    @endif
    @if ($correct)
        dark:bg-green-700 border-green-800
    @endif
    border-gray-700 disabled:cursor-not-allowed"
    @if ($error || $correct)
        disabled
    @endif
    >
    {{ $value }}
</button>
