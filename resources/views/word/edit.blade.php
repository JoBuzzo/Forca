<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            Palavra: {{ $word->word }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div
                class="flex items-start justify-between h-[400px] overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded drop-shadow-lg">

                <div class="flex flex-col items-start justify-center">
                    <form action="{{ route('word.update', $word->id) }}" method="POST"
                        class="flex flex-col items-start justify-center gap-6 p-6 text-gray-900 dark:text-gray-100">
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
                            <textarea id="tip" rows="4" cols="52" name="tip" class="border-gray-300 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600"></textarea>
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
                            <table class="text-sm text-left text-gray-500 dark:text-gray-400 w-84">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Nome
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Criado em
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Editado em
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Ações
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($word->tips as $tip)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <th class="px-2 py-4 font-medium text-gray-900 truncate dark:text-white">
                                                {{ $tip->tip }}
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ $tip->created_at->diffForHumans() }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $tip->updated_at->diffForHumans() }}
                                            </td>
                                            <td class="px-6 py-4">
                                                <a href="{{ route('tip.edit', $tip->id) }}"
                                                    class="text-blue-500 hover:underline">Vizualizar</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>


                        @endif
                    </div>

                </div>


                <x-modal name="delete" focusable>
                    <form method="post" action="{{ route('word.destroy', $word->id) }}" class="p-6">
                        @csrf
                        @method('delete')

                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
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
