
@php
    $error = in_array($value, $this->errorLetters);
    $correct = in_array($value, $this->correctLetters);
@endphp

<button 
    wire:click="verifyLetter('{{ $value }}')" wire:loading.attr="disabled"
    class="flex items-center justify-center xl:w-16 xl:h-16 p-4 text-xl text-center uppercase border text-gray-300 w-[37px] h-[37px] last:rounded-br-lg first:rounded-bl-lg select-none
    @if ($error) bg-[#FF3C3C] border-[#FF3C3C] @elseif ($correct) bg-secondary border-secondary @else bg-black @endif border-gray-700 disabled:cursor-not-allowed"
    @if ($error || $correct)
        disabled
    @endif
    >
    {{ $value }}
</button>
