<div class="flex items-center justify-center mt-4 md:mt-20">

    <div class="relative gap-2 p-3 overflow-x-auto rounded-sm">
        <div class="flex items-center justify-between w-full mb-5">
                <span>Top {{ count($users) }} players</span>
            <div>
                <x-score-auth />
                <x-primary-button wire:click='random'>Jogar</x-primary-button>
                @if (isset($txt))
                    <span class="absolute z-50 text-sm right-2 top-20">{{ $txt }}</span>
                @endif
            </div>
        </div>
        <table class="w-full text-xs text-left text-gray-400 border border-black rounded-sm shadow md:text-sm">
            <thead class="text-xs text-white uppercase bg-black ">
                <tr>
                    <th class="px-2 py-3">
                        Nome
                    </th>
                    <th class="px-1 py-3">
                        Palavras
                    </th>
                    <th class="px-1 py-3">
                        Pontuação
                    </th>

                </tr>
            </thead>
            <tbody>

                @foreach ($users as $user)
                    <tr class="@if($user->user_id === Auth::user()->id) bg-secondary text-white @else background @endif">
                        <th class="px-2 py-2 font-medium whitespace-nowrap">
                            <strong class="text-white">{{ $loop->index + 1 }}° </strong> {{ $user->name }}
                        </th>
                        <td class="px-1 py-2 text-center">
                            {{ $user->word_count }}
                        </td>
                        <td class="px-1 py-2 text-center">
                            {{ $user->total_score }}
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>

</div>
