@extends('layouts.admin')
@section('content')
    <div class="flex justify-between pb-2">
        <h1 class="font-bold py-4 uppercase">{{ __('Appartamenti Eliminati') }}</h1>
    </div>
    <div class="mb-4">
        @if (session()->has('message'))
            <div class="text-green-600">
                {{ session('message') }}
            </div>
        @endif
    </div>
    @if (count($softDeletedApartments) !== 0)
        <table class="w-full whitespace-nowrap  max-lg:hidden">
            <thead class="bg-black/90 max-md:hidden sticky top-0">
                <th class="text-left py-3 px-2 rounded-l-lg">{{ __('Titolo') }}</th>
                <th class="text-left py-3 px-2 max-md:hidden">{{ __('Indirizzo') }}</th>
                <th class="text-left py-3 px-2 max-md:hidden">{{ __('Visibilità') }}</th>
                <th class="text-left py-3 px-2 rounded-r-lg">{{ __('Azioni') }}</th>
            </thead>
            @foreach ($softDeletedApartments as $apartment)
                <tr class="border-b border-gray-700 max-lg:hidden hover:bg-neutral-800">
                    <td class="py-3 px-2">{{ $apartment->title }}</td>
                    <td class="py-3 px-2 max-md:hidden">{{ $apartment->address }}</td>
                    <td class="py-3 px-2 max-md:hidden">{{ $apartment->visibility ? 'Si' : 'No' }}</td>
                    <td class="py-3 px-2">
                        {{-- icona Ripristina --}}
                        <a href="" title="Ripristina" class="ms-js-restore-btn hover:text-amber-400"
                            data-apartment-title="{{ $apartment->title }}" data-apartment-slug="{{ $apartment->slug }}">
                            <svg class="w-5 h-5" width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" />
                                <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
                                <polyline points="7 9 12 4 17 9" />
                                <line x1="12" y1="4" x2="12" y2="16" />
                            </svg>

                        </a>
                    </td>
                </tr>
            @endforeach
        </table>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
            @foreach ($softDeletedApartments as $apartment)
                {{-- card per responsive sotto i 700px --}}
                <div
                    class="max-w-sm flex flex-col justify-between rounded-lg overflow-hidden shadow-lg lg:hidden border-solid border-2 border-indigo-800">
                    @if ($apartment->image)
                        <img class="w-full" src="{{ asset('storage/' . $apartment->image) }}"
                            alt="{{ $apartment->title }}">
                    @endif
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
                            class="ms-js-restore-btn max-[457px]:mb-3 rounded-md bg-amber-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-amber-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-600"
                            data-apartment-title="{{ $apartment->title }}" data-apartment-slug="{{ $apartment->slug }}">
                            <a href="" title="Ripristina" class="hover:text-white">{{ __('Ripristina') }}
                            </a>
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-base font-semibold leading-7 py-2">In questa pagina trovi l'elenco completo di tutti
            gli appartamenti che sono stati precedentemente cancellati.</p>
    @endif
    {{-- Modal --}}

    @isset($apartment)
        <div id="ms-confirmRestoreModal"
            class="hidden bg-slate-800 bg-opacity-50 justify-center items-center absolute top-0 right-0 bottom-0 left-0 backdrop-blur-sm">
            <div class="bg-zinc-900 ms-modal px-16 py-14 rounded-lg text-center drop-shadow-2xl">
                <h1 class="ms-modal-body text-xl mb-6 font-bol">
                </h1>
                <button id="ms-modal-cancel-restoration"
                    class="bg-red-600 px-4 py-2 rounded-md text-md text-white hover:bg-red-800">{{ __('Annulla') }}</button>
                <button class="bg-amber-600 px-7 py-2 ml-2 rounded-md text-md text-white hover:bg-amber-400 font-semibold">
                    <a id="ms-modal-confirm-restoration" title="Ripristina" class="hover:text-white">{{ __('Conferma') }}
                    </a>
                </button>
            </div>
        </div>
    @endisset
@endsection
