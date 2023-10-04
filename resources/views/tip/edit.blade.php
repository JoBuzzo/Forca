<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            Dica da palavra {{ $tip->word->word }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div
                class="flex items-start justify-between h-[400px] overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded drop-shadow-lg">

                <div class="flex flex-col items-start justify-center">
                   
                    
                    <form action="{{ route('tip.update', $tip->id) }}" method="POST" class="flex flex-col items-start justify-center gap-6 p-6 text-gray-900 dark:text-gray-100">
                        @csrf
                        @method('PUT')
                        <div>
                            <x-input-label for="tip">Dica</x-input-label>
                            <textarea id="tip" rows="4" cols="52" name="tip" class="border-gray-300 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600">{{ $tip->tip }}</textarea>
                            <x-input-error :messages="$errors->get('tip')" class="mt-2" />
                        </div>
                        <div>
                            <x-primary-button>Editar</x-primary-button>
                            <x-danger-button x-data=""
                                x-on:click.prevent="$dispatch('open-modal', 'delete')">Excluir</x-danger-button>
                        </div>
                    </form>
                    
                </div>


                


                <x-modal name="delete" focusable>
                    <form method="post" action="{{ route('tip.destroy', $tip->id) }}" class="p-6">
                        @csrf
                        @method('delete')

                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            Você tem certeza que deseja excluir esta dica?
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
