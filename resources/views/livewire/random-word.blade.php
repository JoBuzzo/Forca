<div class="flex items-center justify-center mt-20 ">

    <div class="relative gap-2 p-3 overflow-x-auto rounded-sm">
        <div class="flex items-center justify-between w-full mb-5">
            <span>Top {{ count($users) }} players</span>
            <div>
                <x-primary-button wire:click='random'>Jogar</x-primary-button>
                @if(isset($txt))
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
                        Pontuação
                    </th>
                    <th class="px-6 py-3">
                        Palavras jogadas
                    </th>
                   
                </tr>
            </thead>
            <tbody>

                @foreach ($users as $user)
                    <tr class="bg-gray-800 border-b border-gray-700">
                        <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $user->name }}
                        </th>
                        <td class="px-6 py-4 text-center">
                            {{ $user->total_score }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            {{ $user->word_count }}
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>

</div>
