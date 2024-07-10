@extends('layouts.admin')

@section('content')
    @if (!empty($activeSponsorships))
        @php
            $createdDate = \Carbon\Carbon::parse($activeSponsorships[0]['pivot']['end_time']);
            $remainingDays = \Carbon\Carbon::now()->diffInDays($createdDate);
            $remainingMinutes = \Carbon\Carbon::now()->diffInMinutes($createdDate);
            $remainingHours = floor($remainingMinutes / 60);
            $remainingMinutes = $remainingMinutes % 60;
        @endphp
    @endif
    {{-- freccia per ritornare all'index --}}
    <div>
        <a href="{{ route('admin.apartments.index') }}">
            <svg class="h-8 w-8 text-indigo-800 mb-4 hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
            </svg>
        </a>
    </div>

    <div class="mb-4">
        @if (session()->has('message'))
            <div class="bg-neutral-900 rounded text-green-900 px-4 py-3" role="alert">
                <div class="flex">
                    <div>
                        <svg class="fill-current h-6 w-6 text-green-700 mr-4" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img"
                            preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                            <path
                                d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10s10-4.5 10-10S17.5 2 12 2m0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8s8 3.59 8 8s-3.59 8-8 8m4.59-12.42L10 14.17l-2.59-2.58L6 13l4 4l8-8l-1.41-1.42z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-green-700">{{ session('message') }}</p>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <div class="relative flex w-full flex-col bg-clip-border border-solid border-2 border-indigo-800 rounded-lg">
        <div class="max-w-sm mb-8 overflow-hidden self-center rounded-t-lg">
            @if ($apartment->image)
                <img class="w-full" src="{{ asset('storage/' . $apartment->image) }}" alt="{{ $apartment->title }}">
            @endif
        </div>

        <div class="p-6">
            <h6
                class="mb-4 block font-sans text-base font-semibold uppercase leading-relaxed tracking-normal text-indigo-400 antialiased">
                {{ $apartment->title }}
            </h6>
            <p class="mb-4 block font-sans text-base font-normal leading-relaxed antialiased">
                {{ $apartment->description }}
            </p>
            <p class="mb-1.5 leading-snug tracking-normal antialiased">
                {{ $address = $apartment->address }}
            </p>
            <p class="mb-1.5 leading-snug tracking-normal antialiased">
                Numero di stanze: {{ $apartment->number_of_rooms }}
            </p>
            <p class="mb-1.5 leading-snug tracking-normal antialiased">
                Numero di letti: {{ $apartment->number_of_beds }}
            </p>
            <p class="mb-1.5 leading-snug tracking-normal antialiased">
                Numero di bagni: {{ $apartment->number_of_bathrooms }}
            </p>
            <p class="mb-1.5 leading-snug tracking-normal antialiased">
                Metri quadrati: {{ $apartment->square_meters ? $apartment->square_meters : 'Nullo' }}
            </p>
            @if (count($apartment->services) > 0)
                <p class="mb-1.5 leading-snug tracking-normal antialiased">
                    @foreach ($apartment->services as $service)
                        {{ $service->name }}@if (!$loop->last)
                            ,
                        @endif
                    @endforeach
                </p>
            @else
                <p class="mb-1.5 leading-snug tracking-normal antialiased">
                    Nessun Servizio
                </p>
            @endif
            <p class="leading-snug tracking-normal antialiased">
                {{ $apartment->visibility ? 'Visibile' : 'Non visibile' }}
            </p>
        </div>

        {{-- bottoni azioni --}}
        <div class="pt-4 pb-2 flex max-[457px]:flex-col justify-between">
            {{-- bottoni Modifica --}}
            <button type="submit"
                class="max-[457px]:mb-3 rounded-md bg-amber-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-amber-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                <a href="{{ route('admin.apartments.edit', ['apartment' => $apartment->slug]) }}" title="Modifica"
                    class="hover:text-white">
                    {{ __('Modifica') }}
                </a>
            </button>
            {{-- bottone Elimina --}}
            <form action="{{ route('admin.apartments.destroy', ['apartment' => $apartment->slug]) }}" method="POST"
                title="Elimina" class=" inline-block hover:text-red-800">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="ms-js-delete-btn rounded-md w-full bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                    data-apartment-title="{{ $apartment->title }}">
                    <a href="" title="Elimina" class="hover:text-white">
                        {{ __('Elimina') }}
                    </a>
                </button>
            </form>
        </div>
    </div>
    </div>
    <hr class="hidden md:block mt-8 border-1">
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-4 py-4">
        {{-- Messaggi --}}
        <div>
            <h1 class="font-bold py-4 uppercase">Messaggi</h1>
            @if (!empty($messages))
                <section class="relative flex flex-col justify-centeroverflow-hidden antialiased">
                    <div class="w-full max-w-6xl">
                        <div class="flex flex-col justify-center divide-y divide-slate-200 py-4">
                            <div class="w-full max-w-3xl">
                                <!-- Vertical Timeline #3 -->
                                <div
                                    class="space-y-8 relative before:absolute before:inset-0 before:ml-5 before:-translate-x-px md:before:ml-[8.75rem] md:before:translate-x-0 before:h-full before:w-0.5 before:bg-gradient-to-b before:from-transparent before:via-slate-300 before:to-transparent">
                                    @foreach ($messages as $message)
                                        <!-- Item #1 -->
                                        <div class="relative">
                                            <div class="md:flex items-center md:space-x-4 mb-3">
                                                <div class="flex items-center space-x-4 md:space-x-2 md:space-x-reverse">
                                                    <!-- Icon -->
                                                    <div
                                                        class="flex items-center justify-center w-10 h-10 rounded-full bg-black/60 to-white/5 shadow md:order-1 md:ml-[1px]">
                                                        <svg class="fill-slate-400" xmlns="http://www.w3.org/2000/svg"
                                                            width="16" height="16">
                                                            <path
                                                                d="M8 0a8 8 0 1 0 8 8 8.009 8.009 0 0 0-8-8Zm0 12a4 4 0 1 1 0-8 4 4 0 0 1 0 8Z" />
                                                        </svg>
                                                    </div>
                                                    <!-- Date -->
                                                    <time
                                                        class="text-sm font-medium md:w-28">{{ \Carbon\Carbon::parse($message->created_at)->format('d/m/Y H:i') }}</time>
                                                </div>
                                                <!-- Title -->
                                                <div class="ml-14 text-sm md:text-base"><span
                                                        class="text-indigo-400 font-bold">{{ $message->name }}</span>
                                                    {{ $message->email }}
                                                </div>
                                            </div>
                                            <!-- Card -->
                                            <div class="bg-black/60 to-white/5 p-4 rounded-3xl shadow ml-14 md:ml-44">
                                                {{ $message->text }}</div>
                                        </div>
                                    @endforeach

                                </div>
                                <!-- End: Vertical Timeline #3 -->
                            </div>
                        </div>
                    </div>
                </section>
            @else
                <p>Non ci sono messaggi.</p>
            @endif
        </div>
        {{-- Sponsorizzazioni --}}
        <div>
            <h1 class="font-bold py-4 uppercase">Sponsorizzazioni</h1>
            @if (!empty($activeSponsorships))
                <div class="flex justify-between items-center pb-4">
                    @if ($remainingDays >= 1)
                        <h1 class="text-xs md:text-base">Il tuo appartmento sarà sponsorizzato per altri
                            {{ $remainingDays }} {{ $remainingDays == 1 ? 'giorno' : 'giorni' }}
                        </h1>
                    @else
                        <h1 class="text-xs md:text-base">Il tuo appartmento sarà sponsorizzato per
                            {{ $remainingHours }}h e {{ $remainingMinutes }}m
                        </h1>
                    @endif
                    <button type="submit"
                        class="max-[457px]:mb-3 rounded-full bg-indigo-600 px-3 py-2 text-xs font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        <a href="{{ route('admin.sponsorships.create', ['apartment' => $apartment->slug]) }}"
                            title="Sponsorizza" class="hover:text-white">{{ __('Sponsorizza') }}
                        </a>
                    </button>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-4">
                    @foreach ($activeSponsorships as $sponsorship)
                        <div class="bg-black/60 to-white/5 rounded-lg">
                            <div class="flex flex-row items-center">
                                <div class="text-3xl p-4">👑</div>
                                <div class="p-2">
                                    <p class="text-xl font-bold">{{ $sponsorship['name'] }}</p>
                                    <p class="text-gray-500 font-medium">{{ $sponsorship['price'] }} €</p>
                                </div>
                            </div>
                            <div class="border-t border-white/5 p-4">
                                <p class="text-md text-indigo-400">Acquistata</p>
                                <p class="text-sm">
                                    {{ \Carbon\Carbon::parse($sponsorship['pivot']['created_at'])->format('d/m/Y \a\l\l\e H:i') }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p>Non ci sono sponsorizazioni attive.</p>
            @endif
        </div>
    </div>
    <div>
        <h1 class="font-bold py-4 uppercase">Statistiche</h1>
        <div class="w-full min-h-[30rem] max-sm:-ml-3 mt-4 flex justify-center">
            <canvas id="visitsChart" class="w-full h-full"></canvas>
        </div>
        <div id="weeklyData" class="hidden">
            {{ json_encode($weeklyData) }}
        </div>
    </div>
    {{-- Modal --}}
    <div id="ms-confirmDeleteModal"
        class="hidden bg-slate-800 bg-opacity-50 justify-center items-center absolute top-0 right-0 bottom-0 left-0 backdrop-blur-sm">
        <div class="bg-zinc-900 ms-modal px-16 py-14 rounded-lg text-center drop-shadow-2xl">
            <h1 class="ms-modal-body text-xl mb-6 font-bol">
            </h1>
            <button id="ms-modal-cancel-deletion"
                class="bg-red-600 px-4 py-2 rounded-md text-md text-white hover:bg-red-800">{{ __('Annulla') }}</button>
            <button id="ms-modal-confirm-deletion"
                class="bg-indigo-600 px-7 py-2 ml-2 rounded-md text-md text-white hover:bg-indigo-500 font-semibold">{{ __('Conferma') }}</button>
        </div>
    </div>
@endsection
