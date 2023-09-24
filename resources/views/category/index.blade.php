<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            Categorias
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div
                class="flex items-start justify-between overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded drop-shadow-lg">

                <form action="{{ route('category.store') }}" method="POST" class="flex flex-col items-start justify-center gap-6 p-6 text-gray-900 dark:text-gray-100">
                    @csrf
                    <div>
                        <x-input-label for="description">Nome</x-input-label>
                        <x-text-input name="description" id="description" placeholder="Nome da categoria" />
                        <x-input-error :messages="$errors->get('description')" class="mt-2"/>
                    </div>
                    <x-primary-button>Cadastrar</x-primary-button>
                </form>

                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="relative space-y-2 overflow-x-auto">

                        @if (count($categories) > 0)
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
                                    @foreach ($categories as $category)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <th scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ $category->description }}
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ $category->created_at->diffForHumans() }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $category->updated_at->diffForHumans() }}
                                            </td>
                                            <td class="px-6 py-4">
                                                <a href="{{ route('category.edit', $category->id) }}" class="text-blue-500 hover:underline">Vizualizar</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            
                            {{ $categories->links() }}
                            
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
