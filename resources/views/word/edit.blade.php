<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-white">
            Palavra: {{ $word->word }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex items-start justify-between h-[400px] overflow-hidden bg-black shadow-sm sm:rounded drop-shadow-lg">

                <div class="flex flex-col items-start justify-center">
                    <form action="{{ route('word.update', $word->id) }}" method="POST"
                        class="flex flex-col items-start justify-center gap-6 p-6 text-white">
                        @csrf
                        @method('PUT')
                        <div class="flex gap-3">
                            <div>
                                <x-input-label for="word">Palavra</x-input-label>
                                <x-text-input name="word" id="word" placeholder="Palavra"
                                    value="{{ $word->word }}" />
                                <x-input-error :messages="$errors->get('word')" class="mt-2" />
                            </div>
                            <div>
                                <livewire:select-categories :selecteds="$word->categories" />
                                <x-input-error :messages="$errors->get('category')" class="mt-2" />
                            </div>
                        </div>
                        <div>
                            <x-primary-button>Editar</x-primary-button>
                            <x-danger-button x-data=""
                                x-on:click.prevent="$dispatch('open-modal', 'delete')">Excluir</x-danger-button>
                        </div>
                    </form>
                    
                    <form action="{{ route('tip.store') }}" method="POST" class="flex flex-col items-start justify-center gap-6 p-6 text-gray-900 dark:text-gray-100">
                        @csrf
                        <input type="hidden" name="id" value="{{ $word->id }}">
                        <div>
                            <x-input-label for="tip">Dica</x-input-label>
                            <textarea id="tip" rows="4" cols="52" name="tip" class="text-white border-gray-700 rounded-md shadow-sm background focus:border-indigo-600 focus:ring-indigo-600"></textarea>
                            <x-input-error :messages="$errors->get('tip')" class="mt-2" />
                        </div>
                        <div>
                            <x-primary-button>Cadastrar</x-primary-button>
                        </div>
                    </form>
                    
                </div>


                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="relative space-y-2 overflow-x-auto">

                        @if (count($word->tips) > 0)
                            <x-table>
                                <x-slot:thead>
                                    <tr>
                                        <th class="px-2 py-3">
                                            Dicas
                                        </th>
                                        <th class="px-2 py-3">
                                            Ações
                                        </th>
                                    </tr>
                                </x-slot:thead>
                                <x-slot:tbody>
                                    @foreach ($word->tips as $tip)
                                        <tr>
                                            <th class="max-w-md px-2 py-4 overflow-hidden font-medium text-white truncate nowrap text-ellipsis">
                                                {{ $tip->tip }}
                                            </th>
                                           
                                            <td class="px-2 py-4">
                                                <a href="{{ route('tip.edit', $tip->id) }}" class="view">Vizualizar</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </x-slot:tbody>
                            </x-table>
                        @endif
                    </div>
                </div>


                <x-modal name="delete" focusable>
                    <form method="post" action="{{ route('word.destroy', $word->id) }}" class="p-6">
                        @csrf
                        @method('delete')

                        <h2 class="text-lg font-medium text-white">
                            Você tem certeza que deseja excluir esta Palavra?
                        </h2>

                        <div class="flex justify-end mt-6">
                            <x-secondary-button x-on:click="$dispatch('close')">
                                Cancelar
                            </x-secondary-button>

                            <x-danger-button class="ml-3">
                                Excluir
                            </x-danger-button>
                        </div>
                    </form>
                </x-modal>
            </div>
        </div>
    </div>
</x-app-layout>
