<x-app-layout>
    <x-slot name="header" class="bg-black">
        <h2 class="text-xl font-semibold leading-tight text-white">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="px-2 mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="flex flex-col justify-between gap-6 p-4 bg-black rounded-lg shadow md:flex-row sm:p-8 md:gap-0">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
                <div class="flex flex-col items-start">
                    <span class="whitespace-nowrap">
                        Palavras jogadas: {{ Auth::user()->words_count }}
                    </span>
                    <span class="whitespace-nowrap">
                        Pontuanção: {{ Auth::user()->total_score }}
                    </span>
                </div>
            </div>

            <div class="p-4 px-2 bg-black rounded-lg shadow sm:p-8">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 px-2 bg-black rounded-lg shadow sm:p-8">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
