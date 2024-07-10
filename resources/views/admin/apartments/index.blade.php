@extends('layouts.admin')
@section('content')
    <div class="flex justify-between pb-2">
        <h2 class="text-base font-semibold leading-7 text-indigo-400 py-2">{{ __('Appartamenti') }}</h2>
        <a href="{{ route('admin.apartments.create') }}" title="Aggiungi" class="flex items-center hover:text-indigo-700">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                class="w-6 h-6 group-hover:text-indigo-400">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
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
    @if (count($apartments) !== 0)
        <table class="w-full whitespace-nowrap max-md:hidden">
            <thead class="bg-black/90 max-md:hidden">
                <th class="text-left py-3 px-2 rounded-l-lg">{{ __('Titolo') }}</th>
                <th class="text-left py-3 px-2 max-md:hidden">{{ __('Indirizzo') }}</th>
                <th class="text-left py-3 px-2 max-md:hidden">{{ __('Visibilità') }}</th>
                <th class="text-left py-3 px-2 rounded-r-lg">{{ __('Azioni') }}</th>
            </thead>
            @foreach ($apartments as $apartment)
                <tr class="border-b border-gray-700 max-md:hidden hover:bg-neutral-800">
                    <td class="py-3 px-2">{{ $apartment->title }}</td>
                    <td class="py-3 px-2 max-md:hidden">{{ $apartment->address }}</td>
                    <td class="py-3 px-2 max-md:hidden">{{ $apartment->visibility ? 'Si' : 'No' }}</td>
                    <td class="py-3 px-2">
                        {{-- icone --}}
                        <div class="inline-flex items-center space-x-3">
                            {{-- icona Sponsorizza --}}
                            <a href="{{ route('admin.sponsorships.create', ['apartment' => $apartment->slug]) }}"
                                title="Sponsorizza" class="hover:text-indigo-700"><svg xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                                    <path d="M4.5 3.75a3 3 0 0 0-3 3v.75h21v-.75a3 3 0 0 0-3-3h-15Z" />
                                    <path fill-rule="evenodd"
                                        d="M22.5 9.75h-21v7.5a3 3 0 0 0 3 3h15a3 3 0 0 0 3-3v-7.5Zm-18 3.75a.75.75 0 0 1 .75-.75h6a.75.75 0 0 1 0 1.5h-6a.75.75 0 0 1-.75-.75Zm.75 2.25a.75.75 0 0 0 0 1.5h3a.75.75 0 0 0 0-1.5h-3Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                            {{-- icona Mostra --}}
                            <a href="{{ route('admin.apartments.show', $apartment->slug) }}" title="Mostra"
                                class="hover:text-green-700"><svg class="w-5 h-5" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                    <circle cx="12" cy="12" r="3" />
                                </svg>
                            </a>
                            {{-- icona Modifica --}}
                            <a href="{{ route('admin.apartments.edit', ['apartment' => $apartment->slug]) }}"
                                title="Modifica" class="hover:text-amber-400"><svg xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                    class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                </svg>
                            </a>
                            {{-- icona Elimina --}}
                            <form action="{{ route('admin.apartments.destroy', ['apartment' => $apartment->slug]) }}"
                                method="POST" title="Elimina" class="flex items-center hover:text-red-800">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="ms-js-delete-btn"
                                    data-apartment-title="{{ $apartment->title }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </table>
        @foreach ($apartments as $apartment)
            {{-- card per responsive sotto i 700px --}}
            <div
                class="max-w-sm mb-8 rounded-lg overflow-hidden shadow-lg md:hidden border-solid border-2 border-indigo-800">
                @if ($apartment->image)
                    <img class="w-full" src="{{ asset('storage/' . $apartment->image) }}" alt="{{ $apartment->title }}">
                @endif
                <div class="px-6 py-4">
                    <div class="font-bold text-xl mb-2">{{ $apartment->title }}</div>
                    <p class="text-gray-500 text-base">
                        {{ $apartment->address }}
                    </p>
                    <p class="text-gray-500 text-base">
                        {{ $apartment->visibility ? 'Visibile' : 'Non visibile' }}
                    </p>
                </div>
                {{-- bottoni azioni --}}
                <div class="px-6 pt-4 pb-2 grid grid-cols-2 gap-1">
                    {{-- bottoni Sponsorizza --}}
                    <button type="submit"
                        class="max-[457px]:mb-3 rounded-md bg-indigo-600 px-3 py-2 text-xs font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        <a href="{{ route('admin.sponsorships.create', ['apartment' => $apartment->slug]) }}"
                            title="Sponsorizza" class="hover:text-white">{{ __('Sponsorizza') }}
                        </a>
                    </button>
                    {{-- bottoni Mostra --}}
                    <button type="submit"
                        class="max-[457px]:mb-3 rounded-md bg-green-700 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
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
                    {{-- bottone Elimina --}}
                    <form action="{{ route('admin.apartments.destroy', ['apartment' => $apartment->slug]) }}"
                        method="POST" title="Elimina" class=" inline-block hover:text-red-800">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="ms-js-delete-btn w-full rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                            data-apartment-title="{{ $apartment->title }}">
                            <a href="" title="Elimina" class="hover:text-white">
                                {{ __('Elimina') }}
                            </a>
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    @else
        <p class="text-base font-semibold leading-7 py-2">In questa pagina trovi l'elenco completo di tutti
            gli appartamenti. Se vuoi aggiungere un appartamento nel nostro sistema lo troverai qui.</p>
    @endif

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
