<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <div>
                <a href="{{ route('admin.apartments.index') }}">
                    <svg class="h-8 w-8 text-indigo-800 mb-4 hover:text-black" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
                    </svg>
                </a>
            </div>
            <a href="{{ route('admin.dashboard') }}"
                class="hover:bg-white/10 transition duration-150 ease-linear rounded-lg py-3 px-2 group">
                <div class="flex flex-col space-y-2 md:flex-row md:space-y-0 space-x-2 items-center">
                    <div>
                        <h1
                            class="font-bold text-lg lg:text-3xl max-md:hidden bg-gradient-to-br  via-white/50 to-transparent bg-clip-text mb-3">
                            BoolBnB
                        </h1>
                        <h2 class="font-bold text-lg lg:text-3xl md:hidden bg-gradient-to-br  via-white/50 to-transparent bg-clip-text mb-3">
                            B
                        </h2>

                    </div>
                </div>
            </a>
        </div>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
