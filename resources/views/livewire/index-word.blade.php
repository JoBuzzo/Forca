<div class="py-12">

    <div class="px-2 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div
            class="flex items-center md:items-start justify-between md:h-[450px] overflow-hidden bg-black shadow-sm rounded-md drop-shadow-lg mb-2 md:flex-row flex-col">

            <form action="{{ route('word.store') }}" method="POST"
                class="flex flex-col items-start justify-center gap-6 p-6 text-white">
                @csrf
                <div class="flex gap-1 md:gap-3">
                    <div>
                        <x-input-label for="word">Palavra</x-input-label>
                        <x-text-input name="word" id="word" placeholder="Palavra" />
                        <x-input-error :messages="$errors->get('word')" class="mt-2" />
                    </div>
                    <div>
                        <livewire:select-categories />
                        <x-input-error :messages="$errors->get('category')" class="mt-2" />
                    </div>
                </div>

                <x-primary-button>Cadastrar</x-primary-button>
            </form>

            <div class="p-6 md:w-1/2">

                <div class="relative space-y-2 overflow-x-auto">
                    <div class="w-full">
                        <x-input-label for="pesquisa">Pesquisa</x-input-label>
                        <x-text-input id="pesquisa" wire:model.live="search" placeholder="Pesquise aqui..." class="w-full" />
                    </div>
                    
                    @if (count($words) > 0)
                        <x-table>
                            <x-slot:thead>
                                <tr>
                                    <th class="px-2 py-3">
                                        Nome
                                    </th>
                                    <th class="px-2 py-3">
                                        Cadastrado
                                    </th>

                                    <th class="px-2 py-3">
                                        Ações
                                    </th>
                                </tr>
                            </x-slot:thead>
                            <x-slot:tbody>
                                @foreach ($words as $word)
                                    <tr>
                                        <th class="px-2 py-4 font-medium whitespace-nowrap">{{ $word->word }}</th>
                                        <td class="px-2 py-4 text-white">{{ $word->created_at->diffForHumans() }}</td>
                                        <td class="px-2 py-4">
                                            <a href="{{ route('word.edit', $word->id) }}" class="view">Vizualizar</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </x-slot:tbody>
                        </x-table>
                    @endif
                </div>

            </div>
        </div>
        {{ $words->onEachSide(1)->links() }}

    </div>
</div>
