<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>BoolBnB</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="antialiased bg-black w-full min-h-screen text-slate-300 relative py-4">
        <div class="grid grid-cols-12 mx-auto gap-2 sm:gap-4 md:gap-6 lg:gap-10 xl:gap-14 max-w-7xl my-10 px-2">
            <div id="menu" class="bg-white/10 col-span-3 rounded-lg p-4 ">
                <h1
                    class="font-bold text-lg lg:text-3xl bg-gradient-to-br from-white via-white/50 to-transparent bg-clip-text text-transparent">
                    Dashboard
                    <span class="text-indigo-400">.</span>
                </h1>
                <p class="text-slate-400 text-sm mb-2">Bentornato,</p>
                <div
                    class="flex flex-col justify-between space-y-2 md:space-y-0 md:flex-row items-center md:space-x-2 hover:bg-white/10 group transition duration-150 ease-linear rounded-lg group w-full ">
                    <img class="rounded-full w-10 h-10 relative object-cover"
                        src="https://img.freepik.com/free-photo/no-problem-concept-bearded-man-makes-okay-gesture-has-everything-control-all-fine-gesture-wears-spectacles-jumper-poses-against-pink-wall-says-i-got-this-guarantees-something_273609-42817.jpg?w=1800&t=st=1669749937~exp=1669750537~hmac=4c5ab249387d44d91df18065e1e33956daab805bee4638c7fdbf83c73d62f125"
                        alt="">


                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                {{-- Bottone log-out --}}
                                <button
                                    class="inline-flex items-center border border-transparent text-base leading-4 font-medium text-gray-100 hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                    <p class="group-hover:text-indigo-400 leading-4">{{ Auth::user()->name }}</p>


                                    <div class="ml-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                                {{-- Bottone log-out --}}
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>


                </div>
                <hr class="my-2 border-slate-700">
                <div id="menu" class="flex flex-col space-y-2 my-5">
                    <a href="#"
                        class="hover:bg-white/10 transition duration-150 ease-linear rounded-lg py-3 px-2 group">
                        <div class="flex flex-col space-y-2 md:flex-row md:space-y-0 space-x-2 items-center">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor"
                                    class="w-6 h-6 group-hover:text-indigo-400">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                </svg>

                            </div>
                            <div>
                                <p
                                    class="font-bold text-base lg:text-lg text-slate-200 leading-4 group-hover:text-indigo-400">
                                    Dashboard</p>
                                <p class="text-slate-400 text-sm hidden md:block">Data overview</p>
                            </div>

                        </div>
                    </a>
                    <a href="#"
                        class="hover:bg-white/10 transition duration-150 ease-linear rounded-lg py-3 px-2 group">
                        <div class="relative flex flex-col space-y-2 md:flex-row md:space-y-0 space-x-2 items-center">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor"
                                    class="w-6 h-6 group-hover:text-indigo-400">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                </svg>
                            </div>
                            <div>
                                <p
                                    class="font-bold text-base lg:text-lg text-slate-200 leading-4 group-hover:text-indigo-400">
                                    Appartamenti</p>
                                <p class="text-slate-400 text-sm hidden md:block">Manage invoices</p>
                            </div>
                            <div
                                class="absolute -top-3 -right-3 md:top-0 md:right-0 px-2 py-1.5 rounded-full bg-indigo-800 text-xs font-mono font-bold">
                                23</div>
                        </div>
                    </a>
                    <a href="#"
                        class="hover:bg-white/10 transition duration-150 ease-linear rounded-lg py-3 px-2 group">
                        <div class="flex flex-col space-y-2 md:flex-row md:space-y-0 space-x-2 items-center">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor"
                                    class="w-6 h-6 group-hover:text-indigo-400">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                                </svg>
                            </div>
                            <div>
                                <p
                                    class="font-bold text-base lg:text-lg text-slate-200 leading-4 group-hover:text-indigo-400">
                                    Users</p>
                                <p class="text-slate-400 text-sm hidden md:block">Manage users</p>
                            </div>

                        </div>
                    </a>
                    <a href="#"
                        class="hover:bg-white/10 transition duration-150 ease-linear rounded-lg py-3 px-2 group">
                        <div class="flex flex-col space-y-2 md:flex-row md:space-y-0 space-x-2 items-center">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor"
                                    class="w-6 h-6 group-hover:text-indigo-400">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>

                            </div>
                            <div>
                                <p
                                    class="font-bold text-base lg:text-lg text-slate-200 leading-4 group-hover:text-indigo-400">
                                    Settings</p>
                                <p class="text-slate-400 text-sm hidden md:block">Edit settings</p>
                            </div>

                        </div>
                    </a>
                </div>
                <p class="text-sm text-center text-gray-600">🚀 &copy; 2024 Gruppo 5</p>
            </div>
            <div id="content" class="bg-white/10 col-span-9 rounded-lg p-6">
                @yield('content')
                {{-- <div id="24h">
                    <h1 class="font-bold py-4 uppercase">Last 24h Statistics</h1>
                    <div id="stats" class="grid gird-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div class="bg-black/60 to-white/5 p-6 rounded-lg">
                            <div class="flex flex-row space-x-4 items-center">
                                <div id="stats-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-white">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-indigo-300 text-sm font-medium uppercase leading-4">Users</p>
                                    <p class="text-white font-bold text-2xl inline-flex items-center space-x-2">
                                        <span>+28</span>
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941" />
                                            </svg>

                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-black/60 p-6 rounded-lg">
                            <div class="flex flex-row space-x-4 items-center">
                                <div id="stats-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-white">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>

                                </div>
                                <div>
                                    <p class="text-teal-300 text-sm font-medium uppercase leading-4">Income</p>
                                    <p class="text-white font-bold text-2xl inline-flex items-center space-x-2">
                                        <span>$2,873.88</span>
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941" />
                                            </svg>

                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-black/60 p-6 rounded-lg">
                            <div class="flex flex-row space-x-4 items-center">
                                <div id="stats-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-white">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                    </svg>

                                </div>
                                <div>
                                    <p class="text-blue-300 text-sm font-medium uppercase leading-4">Invoices</p>
                                    <p class="text-white font-bold text-2xl inline-flex items-center space-x-2">
                                        <span>+79</span>
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941" />
                                            </svg>
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="last-incomes">
                    <h1 class="font-bold py-4 uppercase">Last 24h incomes</h1>
                    <div id="stats" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                        <div class="bg-black/60 to-white/5 rounded-lg">
                            <div class="flex flex-row items-center">
                                <div class="text-3xl p-4">💰</div>
                                <div class="p-2">
                                    <p class="text-xl font-bold">348$</p>
                                    <p class="text-gray-500 font-medium">Amber Gates</p>
                                    <p class="text-gray-500 text-sm">24 Nov 2022</p>
                                </div>
                            </div>
                            <div class="border-t border-white/5 p-4">
                                <a href="#" class="inline-flex space-x-2 items-center text-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                                    </svg>
                                    <span>Info</span>
                                </a>
                            </div>
                        </div>
                        <div class="bg-black/60 to-white/5 rounded-lg">
                            <div class="flex flex-row items-center">
                                <div class="text-3xl p-4">💰</div>
                                <div class="p-2">
                                    <p class="text-xl font-bold">68$</p>
                                    <p class="text-gray-500 font-medium">Maia Kipper</p>
                                    <p class="text-gray-500 text-sm">23 Nov 2022</p>
                                </div>
                            </div>
                            <div class="border-t border-white/5 p-4">
                                <a href="#" class="inline-flex space-x-2 items-center text-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                                    </svg>
                                    <span>Info</span>
                                </a>
                            </div>
                        </div>
                        <div class="bg-black/60 to-white/5 rounded-lg">
                            <div class="flex flex-row items-center">
                                <div class="text-3xl p-4">💰</div>
                                <div class="p-2">
                                    <p class="text-xl font-bold">12$</p>
                                    <p class="text-gray-500 font-medium">Oprah Milles</p>
                                    <p class="text-gray-500 text-sm">23 Nov 2022</p>
                                </div>
                            </div>
                            <div class="border-t border-white/5 p-4">
                                <a href="#" class="inline-flex space-x-2 items-center text-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                                    </svg>
                                    <span>Info</span>
                                </a>
                            </div>
                        </div>
                        <div class="bg-black/60 to-white/5 rounded-lg">
                            <div class="flex flex-row items-center">
                                <div class="text-3xl p-4">💰</div>
                                <div class="p-2">
                                    <p class="text-xl font-bold">105$</p>
                                    <p class="text-gray-500 font-medium">Jonny Nite</p>
                                    <p class="text-gray-500 text-sm">23 Nov 2022</p>
                                </div>
                            </div>
                            <div class="border-t border-white/5 p-4">
                                <a href="#" class="inline-flex space-x-2 items-center text-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                                    </svg>
                                    <span>Info</span>
                                </a>
                            </div>
                        </div>
                        <div class="bg-black/60 to-white/5 rounded-lg">
                            <div class="flex flex-row items-center">
                                <div class="text-3xl p-4">💰</div>
                                <div class="p-2">
                                    <p class="text-xl font-bold">52$</p>
                                    <p class="text-gray-500 font-medium">Megane Baile</p>
                                    <p class="text-gray-500 text-sm">22 Nov 2022</p>
                                </div>
                            </div>
                            <div class="border-t border-white/5 p-4">
                                <a href="#" class="inline-flex space-x-2 items-center text-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                                    </svg>
                                    <span>Info</span>
                                </a>
                            </div>
                        </div>
                        <div class="bg-black/60 to-white/5 rounded-lg">
                            <div class="flex flex-row items-center">
                                <div class="text-3xl p-4">💰</div>
                                <div class="p-2">
                                    <p class="text-xl font-bold">28$</p>
                                    <p class="text-gray-500 font-medium">Tony Ankel</p>
                                    <p class="text-gray-500 text-sm">22 Nov 2022</p>
                                </div>
                            </div>
                            <div class="border-t border-white/5 p-4">
                                <a href="#" class="inline-flex space-x-2 items-center text-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                                    </svg>
                                    <span>Info</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="last-users">
                    <h1 class="font-bold py-4 uppercase">Last 24h users</h1>
                    <div>
                        <table class="w-full whitespace-nowrap">
                            <thead class="bg-black/60">
                                <th class="text-left py-3 px-2 rounded-l-lg">Name</th>
                                <th class="text-left py-3 px-2">Email</th>
                                <th class="text-left py-3 px-2">Group</th>
                                <th class="text-left py-3 px-2">Status</th>
                                <th class="text-left py-3 px-2 rounded-r-lg">Actions</th>
                            </thead>
                            <tr class="border-b border-gray-700">
                                <td class="py-3 px-2 font-bold">
                                    <div class="inline-flex space-x-3 items-center">
                                        <span><img class="rounded-full w-8 h-8"
                                                src="https://images.generated.photos/tGiLEDiAbS6NdHAXAjCfpKoW05x2nq70NGmxjxzT5aU/rs:fit:256:256/czM6Ly9pY29uczgu/Z3Bob3Rvcy1wcm9k/LnBob3Rvcy92M18w/OTM4ODM1LmpwZw.jpg"
                                                alt=""></span>
                                        <span>Thai Mei</span>
                                    </div>
                                </td>
                                <td class="py-3 px-2">thai.mei@abc.com</td>
                                <td class="py-3 px-2">User</td>
                                <td class="py-3 px-2">Approved</td>
                                <td class="py-3 px-2">
                                    <div class="inline-flex items-center space-x-3">
                                        <a href="" title="Edit" class="hover:text-white"><svg
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                            </svg>
                                        </a>
                                        <a href="" title="Edit password" class="hover:text-white"><svg
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                                            </svg>
                                        </a>
                                        <a href="" title="Suspend user" class="hover:text-white"><svg
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>

                        </table>
                    </div>
                </div> --}}

            </div>
        </div>
    </div>
</body>

</html>
