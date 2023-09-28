<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            Palavras
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div
                class="flex items-start justify-between h-[400px] overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded drop-shadow-lg">

                <form action="{{ route('word.store') }}" method="POST"
                    class="flex flex-col items-start justify-center gap-6 p-6 text-gray-900 dark:text-gray-100">
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

                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="relative space-y-2 overflow-x-auto">

                        @if (count($words) > 0)
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
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
                                    @foreach ($words as $word)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <th scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ $word->word }}
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ $word->created_at->diffForHumans() }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $word->updated_at->diffForHumans() }}
                                            </td>
                                            <td class="px-6 py-4">
                                                <a href="{{ route('category.edit', $word->id) }}"
                                                    class="text-blue-500 hover:underline">Vizualizar</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {{ $words->links() }}

                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
