@extends('layouts.admin')

@section('content')
    <div class="grid grid-cols-1">
        {{-- freccia per ritornare all'index --}}
        <div>
            <a href="{{ route('admin.apartments.index') }}">
                <svg class="h-8 w-8 text-indigo-800 mb-4 hover:text-white" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
                </svg>
            </a>
        </div>
        <h2 class="text-base font-semibold leading-7 text-indigo-400 py-2">Crea Appartamento</h2>
        <form action="{{ route('admin.apartments.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Title -->
            <div>
                <x-input-label for="title" :value="__('Titolo *')" />
                <x-text-input id="title" name="title" class="block mt-1 w-full" type="text"
                    title="{{ __('Titolo') }}" :value="old('title')" autocomplete="title"
                    placeholder="Appartamento zona EUR" />
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>

            {{-- Description --}}
            <div class="mt-4">
                <x-input-label for="description" :value="__('Descrizione *')" />
                <textarea id="description" name="description" rows="3"
                    class="block mt-1 w-full border-gray-300 bg-transparent text-white focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                    placeholder="Inserisci una descrizione dell'appartamento">{{ old('description') }}</textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <!-- Address -->
            <div class="mt-4">
                <x-input-label for="address" :value="__('Indirizzo *')" />
                <x-text-input id="address" name="address" class="block mt-1 w-full" type="text"
                    title="{{ __('Indirizzo') }}" :value="old('address')" autocomplete="address"
                    placeholder="Via Roma 13, 00118, Roma" />
                <x-input-error :messages="$errors->get('address')" class="mt-2" />
            </div>

            <!-- Image -->
            <div class="mt-4">
                <x-input-label for="image" :value="__('Immagine')" />
                <x-text-input id="image" name="image" class="block mt-1 w-full" type="file"
                    title="{{ __('Immagine') }}" />
                <x-input-error :messages="$errors->get('image')" class="mt-2" />
            </div>

            <!-- Number of rooms -->
            <div class="mt-4">
                <x-input-label for="number_of_rooms" :value="__('Numero di stanze *')" />
                <x-text-input id="number_of_rooms" name="number_of_rooms" class="block mt-1 w-full" type="number"
                    title="{{ __('Numero di stanze') }}" :value="old('number_of_rooms')" autocomplete="number_of_rooms"
                    placeholder="1" />
                <x-input-error :messages="$errors->get('number_of_rooms')" class="mt-2" />
            </div>

            <!-- Number of beds -->
            <div class="mt-4">
                <x-input-label for="number_of_beds" :value="__('Numero di letti *')" />
                <x-text-input id="number_of_beds" name="number_of_beds" class="block mt-1 w-full" type="number"
                    title="{{ __('Numero di letti') }}" :value="old('number_of_beds')" autocomplete="number_of_beds" placeholder="1" />
                <x-input-error :messages="$errors->get('number_of_beds')" class="mt-2" />
            </div>

            <!-- Number of bathrooms -->
            <div class="mt-4">
                <x-input-label for="number_of_bathrooms" :value="__('Numero di bagni *')" />
                <x-text-input id="number_of_bathrooms" name="number_of_bathrooms" class="block mt-1 w-full" type="number"
                    title="{{ __('Numero di bagni') }}" :value="old('number_of_bathrooms')" autocomplete="number_of_bathrooms"
                    placeholder="1" />
                <x-input-error :messages="$errors->get('number_of_bathrooms')" class="mt-2" />
            </div>

            <!-- Square meters -->
            <div class="mt-4">
                <x-input-label for="square_meters" :value="__('Metri quadrati')" />
                <x-text-input id="square_meters" name="square_meters" class="block mt-1 w-full" type="number"
                    title="{{ __('Metri quadrati') }}" :value="old('square_meters')" autocomplete="square_meters" placeholder="13" />
                <x-input-error :messages="$errors->get('square_meters')" class="mt-2" />
            </div>

            <!-- Services -->
            <div class="mt-4">
                <label class="block font-medium text-sm text-white pb-1.5">{{ __('Servizi') }}</label>
                @foreach ($services as $service)
                    <div class="relative flex gap-x-3">
                        <div class="flex h-6 items-center">
                            <input @checked(in_array($service->id, old('services', []))) id="service-{{ $service->id }}" name="services[]"
                                type="checkbox" value="{{ $service->id }}"
                                class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                        </div>
                        <div class="text-sm leading-6">
                            <label for="service-{{ $service->id }}" class="font-medium">{{ $service->name }}</label>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Visibility -->
            <div class="mt-4">
                <label class="block font-medium text-sm text-white pb-1.5">{{ __('Visibilità *') }}</label>
                <div class="flex gap-x-3">
                    <input @checked(old('visibility')) id="visibility-yes" name="visibility" type="radio"
                        value="1" class="h-4 w-4 rounded-full border-gray-300 text-indigo-600 focus:ring-indigo-600">
                    <x-input-label for="visibility-yes" :value="__('Si')" />

                    <input @checked(!old('visibility')) id="visibility-no" name="visibility" type="radio"
                        value="0" class="h-4 w-4 rounded-full border-gray-300 text-indigo-600 focus:ring-indigo-600">
                    <x-input-label for="visibility-no" :value="__('No')" />
                </div>
                <x-input-error :messages="$errors->get('visibility')" class="mt-2" />
            </div>
            <div class="text-indigo-500 mt-3 font-medium text-sm"> I campi * sono obbligatori</div>
            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ml-4">
                    {{ __('Invia') }}
                </x-primary-button>
            </div>
        </form>
    </div>
@endsection
