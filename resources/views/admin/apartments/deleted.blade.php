@extends('layouts.admin')
@section('content')
    <div class="flex justify-between pb-2">
        <h2 class="text-base font-semibold leading-7 text-indigo-400 py-2">{{ __('Appartamenti Eliminati') }}</h2>
    </div>
    <div class="mb-4">
        @if (session()->has('message'))
            <div class="text-green-600">
                {{ session('message') }}
            </div>
        @endif
    </div>
    @if (count($softDeletedApartments) !== 0)
        <table class="w-full whitespace-nowrap">
            <thead class="bg-black/90 max-md:hidden sticky top-0">
                <th class="text-left py-3 px-2 rounded-l-lg">{{ __('Titolo') }}</th>
                <th class="text-left py-3 px-2 max-md:hidden">{{ __('Indirizzo') }}</th>
                <th class="text-left py-3 px-2 max-md:hidden">{{ __('Visibilità') }}</th>
                <th class="text-left py-3 px-2 max-md:hidden">{{ __('Immagine') }}</th>
                <th class="text-left py-3 px-2 rounded-r-lg">{{ __('Azioni') }}</th>
            </thead>
            @foreach ($softDeletedApartments as $apartment)
                <tr class="border-b border-gray-700 max-md:hidden hover:bg-neutral-800">
                    <td class="py-3 px-2">{{ $apartment->title }}</td>
                    <td class="py-3 px-2 max-md:hidden">{{ $apartment->address }}</td>
                    <td class="py-3 px-2 max-md:hidden">{{ $apartment->visibility ? 'Si' : 'No' }}</td>
                    <td class="py-3 px-2 max-md:hidden">
                        @if ($apartment->image)
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2" />
                                <circle cx="8.5" cy="8.5" r="1.5" />
                                <polyline points="21 15 16 10 5 21" />
                            </svg>
                        @else
                            <svg class="w-5 h-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        @endif
                    </td>
                    <td class="py-3 px-2">
                            {{-- icona Ripristina --}}
                            <a href="{{ route('admin.restore', ['apartment' => $apartment->slug]) }}"
                                title="Ripristina" class="hover:text-amber-400">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                </svg>
                            </a>
                    </td>
                </tr>

                {{-- card per responsive sotto i 700px --}}
                <div
                    class="max-w-sm mb-8 rounded-lg overflow-hidden shadow-lg md:hidden border-solid border-2 border-indigo-800">
                    <img class="w-full" src="https://v1.tailwindcss.com/img/card-top.jpg" alt="Sunset in the mountains">
                    <div class="px-6 py-4">
                        <div class="font-bold text-xl mb-2">{{ $apartment->title }}</div>
                        <p class="text-gray-500 text-base">
                            {{ $apartment->address }}
                        </p>
                    </div>
                    {{-- bottoni azioni --}}
                    <div class="px-6 pt-4 pb-2 max-[457px]:flex flex-col">
                        {{-- bottoni Mostra --}}
                        <button type="submit"
                            class="max-[457px]:mb-3 rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            <a href="{{ route('admin.apartments.show', $apartment->slug) }}" title="Mostra"
                                class="hover:text-white">{{ __('Mostra') }}
                            </a>
                        </button>
                        {{-- bottoni Modifica --}}
                        <button type="submit"
                            class="max-[457px]:mb-3 rounded-md bg-amber-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-amber-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            <a href="{{ route('admin.apartments.edit', ['apartment' => $apartment->slug]) }}"
                                title="Modifica" class="hover:text-white">
                                {{ __('Modifica') }}
                            </a>
                        </button>
                        {{-- bottoni Elimina --}}
                        <button type="submit"
                            class="rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            <a href="" title="Elimina" class="hover:text-white">
                                {{ __('Elimina') }}
                            </a>
                        </button>
                    </div>
                </div>
            @endforeach
        </table>
    @else
        <p class="text-base font-semibold leading-7 py-2">In questa pagina trovi l'elenco completo di tutti
            gli appartamenti che sono stati precedentemente cancellati.</p>
    @endif
@endsection
