<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            Palavra: {{ $word->word}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex items-start justify-between h-[400px] overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded drop-shadow-lg">

                <form action="{{ route('word.update', $word->id) }}" method="POST"
                    class="flex flex-col items-start justify-center gap-6 p-6 text-gray-900 dark:text-gray-100">
                    @csrf
                    @method('PUT')
                    <div class="flex gap-3">
                        <div>
                            <x-input-label for="word">Palavra</x-input-label>
                            <x-text-input name="word" id="word" placeholder="Palavra" value="{{ $word->word }}"/>
                            <x-input-error :messages="$errors->get('word')" class="mt-2" />
                        </div>
                        <div>
                            <livewire:select-categories :selecteds="$word->categories"/>
                            <x-input-error :messages="$errors->get('category')" class="mt-2" />
                        </div>
                    </div>
                    <div>
                        <x-primary-button>Cadastrar</x-primary-button>
                    <x-danger-button x-data=""
                    x-on:click.prevent="$dispatch('open-modal', 'delete')">Excluir</x-danger-button>
                    </div>
                </form>


                <x-modal name="delete" focusable>
                    <form method="post" action="{{ route('word.destroy', $word->id) }}" class="p-6">
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
