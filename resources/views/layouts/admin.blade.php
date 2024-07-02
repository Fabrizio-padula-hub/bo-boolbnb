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
    @vite(['resources/css/app.css', 'resources/css/generic.css', 'resources/js/app.js', 'resources/js/script.js'])
</head>

<body class="h-dvh bg-black">
    <div class="antialiased w-full text-slate-300 relative h-full">
        <div class="grid grid-cols-12 mx-auto gap-2 md:gap-6 lg:gap-10 xl:gap-14 max-w-[1920px] py-10 px-2 h-full">

            {{-- Side bar --}}
            <div id="menu" class="bg-white/10 col-span-3 rounded-lg p-4 h-full relative flex flex-col">
                <h1
                    class="font-bold text-lg lg:text-3xl max-md:hidden bg-gradient-to-br from-white via-white/50 to-transparent bg-clip-text text-transparent mb-3">
                    {{ __('BoolBnb') }}
                    <span class="text-indigo-400">.</span>
                </h1>

                {{-- profilo --}}
                <x-responsive-nav-link :href="route('profile.edit')">
                    <div
                        class="flex flex-col justify-between space-y-2 md:space-y-0 md:flex-row items-center md:space-x-2 hover:bg-white/10 group transition duration-150 ease-linear rounded-lg group w-full ">
                        <img class="rounded-full w-10 h-10 relative object-cover"
                            src="https://img.freepik.com/free-photo/no-problem-concept-bearded-man-makes-okay-gesture-has-everything-control-all-fine-gesture-wears-spectacles-jumper-poses-against-pink-wall-says-i-got-this-guarantees-something_273609-42817.jpg?w=1800&t=st=1669749937~exp=1669750537~hmac=4c5ab249387d44d91df18065e1e33956daab805bee4638c7fdbf83c73d62f125"
                            alt="foto profilo">


                        <div class="sm:flex sm:items-center text-white justify-center ">
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
                                    class="{{ Route::currentRouteName() === 'admin.dashboard' ? 'w-6 h-6 text-indigo-400' : 'w-6 h-6 group-hover:text-indigo-400' }}">
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
                                <svg class="{{ Route::currentRouteName() === 'admin.apartments.index' ? 'w-6 h-6 text-indigo-400' : 'w-6 h-6 group-hover:text-indigo-400' }}"
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
                                    class="{{ Route::currentRouteName() === 'admin.apartments.create' ? 'w-6 h-6 text-indigo-400' : 'w-6 h-6 group-hover:text-indigo-400' }}">
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
                    <div class="relative flex flex-col space-y-2 md:flex-row md:space-y-0 space-x-2 items-center">
                        <div>
                            <svg class="{{ Route::currentRouteName() === 'admin.deleted' ? 'w-6 h-6 text-indigo-400' : 'w-6 h-6 group-hover:text-indigo-400' }}"
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
                        <div>
                            <p
                                class="{{ Route::currentRouteName() === 'admin.deleted' ? 'font-bold text-base lg:text-lg max-md:hidden leading-4 text-indigo-400' : 'font-bold text-base lg:text-lg max-md:hidden text-slate-200 leading-4 group-hover:text-indigo-400' }}">
                                {{ __('Appartamenti Eliminati') }}
                            </p>
                        </div>
                        {{-- @if (count($softDeletedApartments) !== 0)
                                @if (count($softDeletedApartments) < 10)
                                    <div
                                        class="absolute -top-3 -right-3 md:top-0 md:right-0 max-lg:hidden px-2.5 py-1.5 rounded-full bg-indigo-800 text-xs font-mono font-bold">
                                        {{ count($softDeletedApartments) }}
                                    </div>
                                @else
                                    <div
                                        class="absolute -top-3 -right-3 md:top-0 md:right-0 max-lg:hidden px-2 py-1.5 rounded-full bg-indigo-800 text-xs font-mono font-bold">
                                        {{ count($softDeletedApartments) }}
                                    </div>
                                @endif
                            @endif --}}
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
                                <svg class="w-6 h-6 group-hover:text-indigo-400" width="24" height="24"
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
