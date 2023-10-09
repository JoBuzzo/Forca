<div class="flex items-center justify-center mt-20 ">

    <div class="relative gap-2 p-3 overflow-x-auto rounded-sm">
        <div class="flex items-center justify-between w-full mb-5">
         
                
                <span>Top {{ count($users) }} players</span>
          
            <div>
                <x-score-auth />
                <x-primary-button wire:click='random'>Jogar</x-primary-button>
                @if (isset($txt))
                    <span class="absolute z-50 text-sm right-2 top-12">{{ $txt }}</span>
                @endif

            </div>
        </div>
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th class="px-6 py-3">
                        Nome
                    </th>
                    <th class="px-6 py-3">
                        Palavras jogadas
                    </th>
                    <th class="px-6 py-3">
                        Pontuação
                    </th>

                </tr>
            </thead>
            <tbody>

                @foreach ($users as $user)
                    <tr class="bg-gray-800 border-b border-gray-700 @if($user->user_id === Auth::user()->id) bg-green-500 dark:text-white @endif">
                        <th class="px-6 py-4 font-medium whitespace-nowrap">
                            {{ $loop->index + 1 }} {{ $user->name }}
                        </th>
                        <td class="px-6 py-4 text-center">
                            {{ $user->word_count }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            {{ $user->total_score }}
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>

</div>
