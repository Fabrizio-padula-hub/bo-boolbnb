<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>BoolBnB</title>
    <!-- Fonts -->

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/css/generic.css', 'resources/js/app.js', 'resources/js/script.js', 'resources/js/deleteModal.js', 'resources/js/restoreModal.js', 'resources/js/apartmentsStats.js'])
</head>

<body class="h-dvh bg-black">
    <div class="antialiased w-full text-slate-300 relative h-full">
        <div class="grid grid-cols-12 mx-auto gap-2 md:gap-6 lg:gap-10 xl:gap-14 max-w-[1920px] py-10 px-2 h-full">

            {{-- Side bar --}}
            <div id="menu" class="bg-white/10 col-span-3 rounded-lg p-4 h-full relative flex flex-col">
                <h1
                    class="font-bold text-lg lg:text-3xl max-md:hidden bg-gradient-to-br from-white via-white/50 to-transparent bg-clip-text text-transparent mb-3">
                    <a href="http:\\localhost:5174">
                        {{ __('BoolBnb') }}
                    </a>
                    <span class="text-indigo-400">.</span>
                </h1>

                {{-- profilo --}}
                <x-responsive-nav-link :href="route('profile.edit')">
                    <div
                        class="flex flex-col justify-between space-y-2 md:space-y-0 md:flex-row items-center md:space-x-2 hover:bg-white/10 group transition duration-150 ease-linear rounded-lg group w-full ">
                        <div
                            class="flex items-center justify-center rounded-full h-14 w-14 {{ Arr::random(config('bg')) }}">
                            <div class="text-3xl font-semibold">{{ Str::substr(Auth::user()->name, 0, 1) }}</div>
                        </div>


                        <div class="hidden md:flex md:items-center text-white justify-center ">
                            <p class="group-hover:text-indigo-400 leading-4">{{ Auth::user()->name }}</p>
                        </div>

                    </div>
                </x-responsive-nav-link>

                <hr class="my-2 border-slate-700">
                <div id="menu" class="flex flex-col space-y-2 mt-5 grow">
                    <a href="{{ route('admin.dashboard') }}"
                        class="hover:bg-white/10 transition duration-150 ease-linear rounded-lg py-3 px-2 group">
                        <div class="flex flex-col space-y-2 md:flex-row md:space-y-0 space-x-2 items-center">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor"
                                    class="{{ Route::currentRouteName() === 'admin.dashboard' ? 'w-8 h-8 text-indigo-400' : 'w-8 h-8 group-hover:text-indigo-400' }}">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                </svg>

                            </div>
                            <div>
                                <p
                                    class="{{ Route::currentRouteName() === 'admin.dashboard' ? 'font-bold text-base lg:text-lg max-md:hidden leading-4 text-indigo-400' : 'font-bold text-base lg:text-lg max-md:hidden text-slate-200 leading-4 group-hover:text-indigo-400' }}">
                                    {{ __('Dashboard') }}
                                </p>

                            </div>

                        </div>
                    </a>
                    <a href="{{ route('admin.apartments.index') }}"
                        class="hover:bg-white/10 transition duration-150 ease-linear rounded-lg py-3 px-2 group">
                        <div class="relative flex flex-col space-y-2 md:flex-row md:space-y-0 space-x-2 items-center">
                            <div>
                                <div class="relative pt-0.5 pr-1">
                                    @if ($apartmentsCount !== 0)
                                        <div
                                            class="md:hidden flex items-center justify-center absolute top-0 right-0 rounded-full h-4 w-4 {{ Route::currentRouteName() === 'admin.apartments.index' ? 'bg-red-500' : 'bg-indigo-400 group-hover:bg-red-500' }}">
                                            <span class="text-white text-xs font-black">{{ $apartmentsCount }}</span>
                                        </div>
                                    @endif
                                    <svg class="{{ Route::currentRouteName() === 'admin.apartments.index' ? 'w-8 h-8 text-indigo-400' : 'w-8 h-8 group-hover:text-indigo-400' }}"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="8" y1="6" x2="21" y2="6" />
                                        <line x1="8" y1="12" x2="21" y2="12" />
                                        <line x1="8" y1="18" x2="21" y2="18" />
                                        <line x1="3" y1="6" x2="3.01" y2="6" />
                                        <line x1="3" y1="12" x2="3.01" y2="12" />
                                        <line x1="3" y1="18" x2="3.01" y2="18" />
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <p
                                    class="{{ Route::currentRouteName() === 'admin.apartments.index' ? 'font-bold text-base lg:text-lg max-md:hidden leading-4 text-indigo-400' : 'font-bold text-base lg:text-lg max-md:hidden text-slate-200 leading-4 group-hover:text-indigo-400' }}">
                                    {{ __('Appartamenti') }}
                                </p>
                            </div>
                            @if ($apartmentsCount !== 0)
                                @if ($apartmentsCount < 10)
                                    <div
                                        class="absolute -top-3 -right-3 md:top-0 md:right-0 max-lg:hidden px-2.5 py-1.5 rounded-full bg-indigo-800 text-xs font-mono font-bold">
                                        {{ $apartmentsCount }}
                                    </div>
                                @else
                                    <div
                                        class="absolute -top-3 -right-3 md:top-0 md:right-0 max-lg:hidden px-2 py-1.5 rounded-full bg-indigo-800 text-xs font-mono font-bold">
                                        {{ $apartmentsCount }}
                                    </div>
                                @endif
                            @endif
                        </div>
                    </a>
                    <a href="{{ route('admin.apartments.create') }}"
                        class="hover:bg-white/10 transition duration-150 ease-linear rounded-lg py-3 px-2 group">
                        <div class="relative flex flex-col space-y-2 md:flex-row md:space-y-0 space-x-2 items-center">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor"
                                    class="{{ Route::currentRouteName() === 'admin.apartments.create' ? 'w-8 h-8 text-indigo-400' : 'w-8 h-8 group-hover:text-indigo-400' }}">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                            </div>
                            <div>
                                <p
                                    class="{{ Route::currentRouteName() === 'admin.apartments.create' ? 'font-bold text-base lg:text-lg max-md:hidden leading-4 text-indigo-400' : 'font-bold text-base lg:text-lg max-md:hidden text-slate-200 leading-4 group-hover:text-indigo-400' }}">
                                    {{ __('Nuovo Appartamento') }}
                                </p>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('admin.deleted') }}"
                        class="hover:bg-white/10 transition duration-150 ease-linear rounded-lg py-3 px-2 group">
                        <div
                            class="relative flex flex-col space-y-2 md:flex-row md:space-y-0 space-x-2 items-center text-red-500 md:text-slate-300">
                            <div>
                                <div class="relative pt-0.5 pr-1">
                                    @if ($trashCount !== 0)
                                        <div
                                            class="md:hidden flex items-center justify-center absolute top-0 right-0 rounded-full h-4 w-4 {{ Route::currentRouteName() === 'admin.deleted' ? 'bg-red-500' : 'bg-indigo-400 group-hover:bg-red-500' }}">
                                            <span class="text-white text-xs font-black">{{ $trashCount }}</span>
                                        </div>
                                    @endif
                                    <svg width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="{{ Route::currentRouteName() === 'admin.deleted' ? 'w-8 h-8 text-indigo-400' : 'w-8 h-8 group-hover:text-indigo-400' }}">
                                        <path stroke="none" d="M0 0h24v24H0z" />
                                        <line x1="4" y1="7" x2="20" y2="7" />
                                        <line x1="10" y1="11" x2="10" y2="17" />
                                        <line x1="14" y1="11" x2="14" y2="17" />
                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <p
                                    class="{{ Route::currentRouteName() === 'admin.deleted' ? 'font-bold text-base lg:text-lg max-md:hidden leading-4 text-indigo-400' : 'font-bold text-base lg:text-lg max-md:hidden text-slate-200 leading-4 group-hover:text-indigo-400' }}">
                                    {{ __('Cestino') }}
                                </p>
                                @if ($trashCount !== 0)
                                    @if ($trashCount < 10)
                                        <div
                                            class="absolute -top-3 -right-3 md:top-0 md:right-0 max-lg:hidden px-2.5 py-1.5 rounded-full bg-red-800 text-xs font-mono font-bold">
                                            {{ $trashCount }}
                                        </div>
                                    @else
                                        <div
                                            class="absolute -top-3 -right-3 md:top-0 md:right-0 max-lg:hidden px-2 py-1.5 rounded-full bg-red-800 text-xs font-mono font-bold">
                                            {{ $trashCount }}
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </a>
                </div>



                {{-- Authentication Log out --}}
                <div
                    class="hover:bg-white/10 transition duration-150 ease-linear rounded-lg py-2 px-2 group mb-4 min-[320px]::mb-20 max-[600px]::mb-20">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf


                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                this.closest('form').submit();"
                            class="relative flex flex-col space-y-2 md:flex-row md:space-y-0 space-x-2 items-center">
                            <div>
                                <svg class="w-8 h-8 group-hover:text-indigo-400" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" />
                                    <path
                                        d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                                    <path d="M20 12h-13l3 -3m0 6l-3 -3" />
                                </svg>
                            </div>

                            <p
                                class="font-bold text-base lg:text-lg max-md:hidden text-slate-200 leading-4 group-hover:text-indigo-400">
                                {{ __('Log Out') }}
                            </p>
                        </x-responsive-nav-link>


                    </form>
                </div>


                {{-- Copyright --}}
                <p class="absolute inset-x-0 bottom-1 text-sm text-center text-gray-600 max-md:hidden">🚀 &copy; 2024
                    {{ __('Gruppo') }} 5</p>
            </div>

            {{-- Main dx --}}
            <div id="content"
                class="bg-white/10 overflow-y-auto col-span-9 sm:col-span-9 md:col-span-9 rounded-lg p-6 h-full">
                @yield('content')

            </div>
        </div>
    </div>
</body>

</html>
