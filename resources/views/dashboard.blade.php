<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-white">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="px-4 py-12">
        <div class="flex flex-col items-center justify-center w-full gap-5 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="w-full overflow-hidden bg-black rounded-lg shadow-sm">
                <div class="p-6 text-white">
                    Seja Bem vindo <strong>{{ Auth::user()->name }}</strong>!
                </div>
            </div>


            <div class="flex flex-col items-center justify-between w-full gap-5 md:flex-row">

                <div class="flex items-center justify-center w-full overflow-hidden bg-black rounded-lg shadow-sm">

                    <svg class="w-8 h-8 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4.333 6.764a3 3 0 1 1 3.141-5.023M2.5 16H1v-2a4 4 0 0 1 4-4m7.379-8.121a3 3 0 1 1 2.976 5M15 10a4 4 0 0 1 4 4v2h-1.761M13 7a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm-4 6h2a4 4 0 0 1 4 4v2H5v-2a4 4 0 0 1 4-4Z" />
                    </svg>

                    <div class="p-6 text-white">
                        {{ $countUsers }} Usuários cadastrados no sistema
                    </div>
                </div>

                <a href="{{ route('word.index') }}" class="w-full cursor-pointer">
                    <div
                        class="flex items-center justify-center w-full overflow-hidden bg-black rounded-lg shadow-sm">

                        <svg class="w-8 h-8 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 18 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 2V1h10v1M6 1v12m-2 0h4m3-6V6h6v1m-3-1v7m-1 0h2" />
                        </svg>

                        <div class="p-6 text-white">
                            {{ $countWords }} Palavras cadastradas no sistema
                        </div>

                    </div>
                </a>
                <a href="{{ route('category.index') }}" class="w-full cursor-pointer">
                    <div
                        class="flex items-center justify-center w-full overflow-hidden bg-black rounded-lg shadow-sm">
                        <svg class="w-8 h-8 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 19 19">
                            <path
                                d="M1 19h13a1 1 0 0 0 1-1V9a1 1 0 0 0-1-1H0v10a1 1 0 0 0 1 1ZM0 6h7.443l-1.2-1.6a1 1 0 0 0-.8-.4H1a1 1 0 0 0-1 1v1Z" />
                            <path
                                d="M17 4h-4.557l-2.4-3.2a2.009 2.009 0 0 0-1.6-.8H4a2 2 0 0 0-2 2h3.443a3.014 3.014 0 0 1 2.4 1.2l2.1 2.8H14a3 3 0 0 1 3 3v8a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2Z" />
                        </svg>
                        <div class="px-4 py-6 text-white">
                            {{ $countCategories }} Categorias cadastradas no sistema
                        </div>
                    </div>
                </a>
            </div>

            <div class="flex flex-col items-center justify-center w-full mt-10">
                
                <div class="relative w-full overflow-x-scroll">
                    <x-table>
                        <x-slot:thead>
                            <tr class="bg-black">
                                <th class="px-2 py-3">
                                    Nome
                                </th>
                                <th class="px-2 py-3">
                                    Email
                                </th>
                                <th class="px-2 py-3">
                                    Cadastro
                                </th>
                            </tr>
                        </x-slot:thead>
                        <x-slot:tbody>
                            @foreach ($users as $user)
                                <tr class="even:bg-black">
                                    <th class="px-2 py-4 font-medium whitespace-nowrap">{{ $user->name }}</th>
                                    <th class="px-2 py-4 font-medium whitespace-nowrap">{{ $user->email }}</th>
                                    <td class="px-2 py-4 text-white">{{ $user->created_at->diffForHumans() }}</td>
                                </tr>
                            @endforeach
                        </x-slot:tbody>
                    </x-table>
                </div>
                <div class="w-full mt-5">
                    {{ $users->onEachSide(1)->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
