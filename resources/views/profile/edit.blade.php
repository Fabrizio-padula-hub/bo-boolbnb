<x-app-layout>
    <x-slot name="header">
        <a href="{{ route('admin.dashboard') }}"
            class="hover:bg-white/10 transition duration-150 ease-linear rounded-lg py-3 px-2 group">
            <div class="flex flex-col space-y-2 md:flex-row md:space-y-0 space-x-2 items-center">
                <div>
                    <h1
                        class="font-bold text-lg lg:text-3xl max-md:hidden bg-gradient-to-br  via-white/50 to-transparent bg-clip-text mb-3">
                        BoolBnB
                        <span class="text-indigo-400">.</span>
                    </h1>

                </div>
            </div>
        </a>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
