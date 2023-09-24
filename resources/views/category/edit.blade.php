<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            Categorias: {{ $category->description }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded drop-shadow-lg">

                <form action="{{ route('category.update', $category->id) }}" method="POST"
                    class="flex flex-col items-start justify-center w-1/3 gap-6 p-6 text-gray-900 dark:text-gray-100">
                    @csrf @method('PUT')
                    <div>
                        <x-input-label for="description">Nome</x-input-label>
                        <x-text-input name="description" id="description" value="{{ $category->description }}"
                            placeholder="Nome da categoria" />
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>
                    <div>
                        <x-primary-button>Salvar</x-primary-button>
                        <x-danger-button x-data=""
                            x-on:click.prevent="$dispatch('open-modal', 'delete')">Excluir</x-danger-button>
                    </div>
                </form>


                <x-modal name="delete" focusable>
                    <form method="post" action="{{ route('category.destroy', $category->id) }}" class="p-6">
                        @csrf
                        @method('delete')

                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            Você tem certeza que deseja excluir esta categoria?
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
