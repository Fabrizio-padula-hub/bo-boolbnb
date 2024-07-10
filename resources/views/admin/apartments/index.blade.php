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
            <div class="text-green-600">
                {{ session('message') }}
            </div>
        @endif
    </div>
    @if (count($apartments) !== 0)
        <table class="w-full whitespace-nowrap max-lg:hidden">
            <thead class="bg-black/90 max-md:hidden">
                <th class="text-left py-3 px-2 rounded-l-lg">{{ __('Titolo') }}</th>
                <th class="text-left py-3 px-2 max-md:hidden">{{ __('Indirizzo') }}</th>
                <th class="text-left py-3 px-2 max-md:hidden">{{ __('Visibilità') }}</th>
                <th class="text-left py-3 px-2 rounded-r-lg">{{ __('Azioni') }}</th>
            </thead>
            @foreach ($apartments as $apartment)
                <tr class="border-b border-gray-700 max-lg:hidden hover:bg-neutral-800">
                    <td class="py-3 px-2">{{ $apartment->title }}</td>
                    <td class="py-3 px-2 max-md:hidden">{{ $apartment->address }}</td>
                    <td class="py-3 px-2 max-md:hidden">{{ $apartment->visibility ? 'Si' : 'No' }}</td>
                    <td class="py-3 px-2">
                        {{-- icone --}}
                        <div class="inline-flex items-center space-x-3">
                            {{-- icona Sponsorizza --}}
                            <a href="{{ route('admin.sponsorships.create', ['apartment' => $apartment->slug]) }}"
                                title="Sponsorizza" class="hover:text-indigo-700"><i class="fa-solid fa-crown"></i>
                            </a>
                            {{-- icona Mostra --}}
                            <a href="{{ route('admin.apartments.show', $apartment->slug) }}" title="Mostra"
                                class="hover:text-green-700"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    fill="currentColor" class="w-5 h-5">
                                    <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                    <path fill-rule="evenodd"
                                        d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z"
                                        clip-rule="evenodd" />
                                </svg>

                            </a>
                            {{-- icona Modifica --}}
                            <a href="{{ route('admin.apartments.edit', ['apartment' => $apartment->slug]) }}"
                                title="Modifica" class="hover:text-amber-400"><svg xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                                    <path
                                        d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                                    <path
                                        d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
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
        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
            @foreach ($apartments as $apartment)
                {{-- card per responsive sotto i 700px --}}
                <div
                    class="w-full flex flex-col justify-between rounded-lg overflow-hidden shadow-lg lg:hidden border-solid border-2 border-indigo-800">
                    @if ($apartment->image)
                        <img class="w-full" src="{{ asset('storage/' . $apartment->image) }}"
                            alt="{{ $apartment->title }}">
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
        </div>
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
