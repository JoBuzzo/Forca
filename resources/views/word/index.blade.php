<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-white">
            Palavras
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex items-start justify-between h-[400px] overflow-hidden bg-black shadow-sm sm:rounded drop-shadow-lg mb-2">

                <form action="{{ route('word.store') }}" method="POST"
                    class="flex flex-col items-start justify-center gap-6 p-6 text-white">
                    @csrf
                    <div class="flex gap-3">
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

                <div class="w-1/2 p-6">

                    <div class="relative space-y-2 overflow-x-auto">

                        @if (count($words) > 0)
                            <x-table>
                                <x-slot:thead>
                                    <tr>
                                        <th class="px-2 py-3">
                                            Nome
                                        </th>
                                        <th class="px-2 py-3">
                                            Data de criação
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
</x-app-layout>
