<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-white">
            Categorias
        </h2>
    </x-slot>

    <div class="py-12">
        
        <div class="px-2 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex items-start justify-between md:h-[400px] overflow-hidden bg-black shadow-sm rounded-md drop-shadow-lg mb-2 md:flex-row flex-col">

                <form action="{{ route('category.store') }}" method="POST" class="flex flex-col items-start justify-center gap-6 p-6 text-gray-900 dark:text-gray-100">
                    @csrf
                    <div>
                        <x-input-label for="description">Nome</x-input-label>
                        <x-text-input name="description" id="description" placeholder="Nome da categoria" />
                        <x-input-error :messages="$errors->get('description')" class="mt-2"/>
                    </div>
                    <x-primary-button>Cadastrar</x-primary-button>
                </form>

                <div class="p-6 md:w-2/3">

                    <div class="relative space-y-2 overflow-x-auto">

                        @if (count($categories) > 0)
                            <x-table>
                                <x-slot:thead >
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
                                    @foreach ($categories as $category)
                                        <tr>
                                            <th class="px-2 py-4 font-medium whitespace-nowrap">
                                                {{ $category->description }}
                                            </th>
                                            <td class="px-2 py-4">
                                                {{ $category->created_at->diffForHumans() }}
                                            </td>
                                            <td class="px-2 py-4">
                                                <a href="{{ route('category.edit', $category->id) }}" class="view">Vizualizar</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </x-slot:tbody>
                            </x-table>
                            
                            
                            @endif
                        </div>
                        
                    </div>
                </div>
                {{ $categories->links() }}
        </div>
    </div>
</x-app-layout>
