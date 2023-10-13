<div class="flex items-center justify-center mt-4 md:mt-20">

    <div class="relative gap-2 p-3 overflow-x-auto rounded-sm">
        <div class="flex items-center justify-between w-full mb-5">
            <span>Top {{ count($users) }} players</span>
            <div>
                <x-primary-button wire:click='random'>Jogar</x-primary-button>
            </div>
        </div>
        <table class="w-full text-xs text-left text-gray-400 border border-black rounded-sm md:text-base">
            <thead class="text-xs text-white uppercase bg-black md:text-base">
                <tr>
                    <th class="px-2 py-3 md:px-4">
                        Nome
                    </th>
                    <th class="px-1 py-3 md:px-4">
                        Palavras
                    </th>
                    <th class="px-1 py-3 md:px-4">
                        Pontuação
                    </th>

                </tr>
            </thead>
            <tbody>

                @foreach ($users as $user)
                    <tr
                        class="@if ($user->user_id === Auth::user()->id) bg-secondary text-white font-extrabold @else background @endif">
                        <th class="px-2 py-2 md:px-5 whitespace-nowrap">
                            <strong class="text-white">{{ $loop->index + 1 }}° </strong> {{ $user->name }}
                        </th>
                        <td class="px-1 py-2 text-center md:px-4">
                            {{ $user->word_count }}
                        </td>
                        <td class="px-1 py-2 text-center md:px-4">
                            {{ $user->total_score }}
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        <div class="flex flex-col text-xs">
            <x-score-auth />
            @if (isset($txt))
                <span class="text-sm text-red-600">{{ $txt }}</span>
            @endif
        </div>
    </div>

</div>
