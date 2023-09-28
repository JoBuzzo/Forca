<div class="relative w-full">
    <div>
        <span class="block text-sm font-medium text-gray-700 dark:text-gray-300">Categorias</span>

        <button wire:click='x_show' type="button"
            class="flex items-center justify-between w-64 px-2 py-2 border-gray-300 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600">

            @if (count($selecteds) > 0)
                {{ $selecteds[array_key_first($selecteds)]->description }}
            @else    
            <span>Escolha aqui</span>
            
            @endif
            <svg class="w-4 h-4 text-gray-800 dark:text-gray-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 14 8">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 5.326 5.7a.909.909 0 0 0 1.348 0L13 1" />
            </svg>
        </button>
    </div>

        @if ($show)
            <div class="absolute z-50 w-64 bg-white rounded-lg shadow top-16 dark:bg-gray-700">
                <div class="p-3 border-b border-gray-200 dark:border-gray-600">
                    <div class="relative">
                        @forelse ($selecteds as $s)
                            {{ $s->description }}@if (!$loop->last), @endif
                        @empty
                            Nenhum escolhido
                        @endforelse
                    </div>
                </div>
                <ul class="h-48 px-3 pb-3 overflow-y-auto text-sm text-gray-700 dark:text-gray-200">
                    @forelse ($categories as $category)
                        <li>
                            <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                <input type="checkbox" name="category[]" id="{{ $category->id }}"
                                    wire:click="x_selecteds({{ $category }})" value="{{ $category->id }}"
                                    @if (in_array($category, $selecteds)) checked @endif
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="{{ $category->id }}"
                                    class="w-full ml-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">{{ $category->description }}</label>
                            </div>
                        </li>
                    @empty
                        <li class="w-full pl-4 mt-2">
                            <p class="text-sm font-semibold">Não encontrado</p>
                        </li>
                    @endforelse
                </ul>

            </div>

        @endif
    </div>
