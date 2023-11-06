<div class="flex flex-col items-center justify-center w-full mt-10">
    <div class="flex w-full my-1 md:justify-end md:items-end ">
        <div class="w-full md:w-1/3">
            <x-input-label for="pesquisa">Pesquisa</x-input-label>
            <x-text-input id="pesquisa" wire:model.live="search" placeholder="Pesquise aqui..." class="w-full"/>
        </div>
    </div>
    <div class="relative w-full overflow-x-scroll">
        <x-table>
            <x-slot:thead>
                <tr class="bg-black">
                    <th class="px-2 py-3">
                        Nome
                    </th>
                    <th class="px-2 py-3">
                        Email
                    </th>
                    <th class="px-2 py-3">
                        Portuação
                    </th>
                    <th class="px-2 py-3">
                        Palavras
                    </th>
                    <th class="px-2 py-3">
                        Cadastro
                    </th>
                </tr>
            </x-slot:thead>
            <x-slot:tbody>
                @foreach ($users as $user)
                    <tr class="even:bg-black">
                        <th class="px-2 py-4 font-medium whitespace-nowrap">{{ $user->name }}</th>
                        <th class="px-2 py-4 font-medium whitespace-nowrap">{{ $user->email }}</th>
                        <th class="px-2 py-4 font-medium whitespace-nowrap">{{ $user->total_score }}</th>
                        <th class="px-2 py-4 font-medium whitespace-nowrap">{{ $user->words_count }}</th>
                        <td class="px-2 py-4 text-white">{{ $user->created_at->diffForHumans() }}</td>
                    </tr>
                @endforeach
            </x-slot:tbody>
        </x-table>
    </div>
    <div class="w-full mt-5">
        {{ $users->onEachSide(1)->links() }}
    </div>
</div>
