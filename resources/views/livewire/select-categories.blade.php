<div class="relative w-full">
    <div>
        <span class="block text-sm font-medium text-white">Categorias</span>

        <button wire:click='x_show' type="button"
            class="flex items-center justify-between px-2 py-2 rounded-md shadow-sm w-36 md:w-64 background">

            @if (count($selecteds) > 0)
                {{ $selecteds->first()->description }}
            @else    
            <span>Escolha aqui</span>
            
            @endif
            <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 14 8">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 5.326 5.7a.909.909 0 0 0 1.348 0L13 1" />
            </svg>
        </button>
    </div>

        @if ($show)
            <div class="absolute z-50 rounded-lg shadow md:w-64 top-16 background w-36">
                <div class="p-3 border-b border-gray-900">
                    <div class="relative">
                        @forelse ($selecteds as $s)
                            {{ $s->description }}@if (!$loop->last), @endif
                        @empty
                            Nenhum escolhido
                        @endforelse
                    </div>
                </div>
                <ul class="h-48 pb-3 overflow-y-auto text-sm text-white">
                    @forelse ($categories as $category)
                        <li class="hover:bg-gray-700">
                            <div class="flex items-center p-2 rounded">
                                <input type="checkbox" name="category[]" id="{{ $category->id }}"
                                    wire:click="x_selecteds({{ $category }})" value="{{ $category->id }}"
                                    @if ( $selecteds->contains($category) ) checked @endif
                                    class="w-4 h-4 text-blue-600 border-gray-700 rounded focus:ring-blue-600 ring-offset-gray-700 focus:ring-offset-gray-700 focus:ring-2 background">
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
