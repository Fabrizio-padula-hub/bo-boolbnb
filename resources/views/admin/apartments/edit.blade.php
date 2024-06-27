@extends('layouts.admin')

@section('content')
    <div class="grid grid-cols-1">
        <div class="flex justify-center">
            <form action="{{ route('admin.apartments.update', ['apartment' => $apartment->slug]) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="space-y-12">
                    <div class="border-b border-gray-900/10 pb-12">
                        <h2 class="text-base font-semibold leading-7 text-indigo-400 py-2">Aggiungi un appartamento</h2>
                        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                            {{-- Title --}}
                            <div class="col-span-full">
                                <label for="title" class="block text-sm font-medium leading-6">Titolo</label>
                                <div class="mt-2">
                                    <div
                                        class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                        <input type="text" name="title" id="title" autocomplete="title"
                                            value="{{ old('title', $apartment->title) }}"
                                            class="block flex-1 rounded-md border-0 bg-transparent py-1.5 pl-1 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                            placeholder="Appartamento zona EUR">
                                    </div>
                                </div>
                            </div>
                            {{-- Description --}}
                            <div class="col-span-full">
                                <label for="description" class="block text-sm font-medium leading-6">Descrizione</label>
                                <div class="mt-2">
                                    <div
                                        class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                        <textarea id="description" name="description" rows="3"
                                            class="block w-full rounded-md border-0 bg-transparent py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{ old('description', $apartment) }}</textarea>
                                    </div>
                                </div>
                            </div>
                            {{-- Address --}}
                            <div class="col-span-full">
                                <label for="address" class="block text-sm font-medium leading-6">Indirizzo</label>
                                <div class="mt-2">
                                    <div
                                        class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                        <input type="text" name="address" id="address" autocomplete="address"
                                            value="{{ old('address', $apartment->address) }}"
                                            class="block flex-1 rounded-md border-0 bg-transparent py-1.5 pl-1 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                            placeholder="Appartamento zona EUR">
                                    </div>
                                </div>
                            </div>
                            {{-- image --}}
                            {{-- <div class="col-span-full">
                            <label for="photo"
                                class="block text-sm font-medium leading-6">Photo</label>
                            <div class="mt-2 flex items-center gap-x-3">
                                <svg class="h-12 w-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor"
                                    aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M18.685 19.097A9.723 9.723 0 0021.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 003.065 7.097A9.716 9.716 0 0012 21.75a9.716 9.716 0 006.685-2.653zm-12.54-1.285A7.486 7.486 0 0112 15a7.486 7.486 0 015.855 2.812A8.224 8.224 0 0112 20.25a8.224 8.224 0 01-5.855-2.438zM15.75 9a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                <button type="button"
                                    class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Change</button>
                            </div>
                            </div> --}}
                            {{-- number of rooms --}}
                            <div class="col-span-full">
                                <label for="number_of_rooms" class="block text-sm font-medium leading-6">Numero
                                    di stanze</label>
                                <div class="mt-2">
                                    <div
                                        class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                        <input type="number" name="number_of_rooms" id="number_of_rooms"
                                            autocomplete="number_of_rooms"
                                            value="{{ old('number_of_rooms', $apartment->number_of_rooms) }}"
                                            class="block flex-1 rounded-md border-0 bg-transparent py-1.5 pl-1 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                            placeholder="1">
                                    </div>
                                </div>
                            </div>
                            {{-- number of beds --}}
                            <div class="col-span-full">
                                <label for="number_of_beds" class="block text-sm font-medium leading-6">Numero
                                    di letti</label>
                                <div class="mt-2">
                                    <div
                                        class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                        <input type="number" name="number_of_beds" id="number_of_beds"
                                            autocomplete="number_of_beds"
                                            value="{{ old('number_of_beds', $apartment->number_of_beds) }}"
                                            class="block flex-1 rounded-md border-0 bg-transparent py-1.5 pl-1 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                            placeholder="1">
                                    </div>
                                </div>
                            </div>
                            {{-- number of bathrooms --}}
                            <div class="col-span-full">
                                <label for="number_of_bathrooms" class="block text-sm font-medium leading-6">Numero
                                    di bagni</label>
                                <div class="mt-2">
                                    <div
                                        class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                        <input type="number" name="number_of_bathrooms" id="number_of_bathrooms"
                                            autocomplete="number_of_bathrooms"
                                            value="{{ old('number_of_bathrooms', $apartment->number_of_bathrooms) }}"
                                            class="block flex-1 rounded-md border-0 bg-transparent py-1.5 pl-1 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                            placeholder="1">
                                    </div>
                                </div>
                            </div>
                            {{-- square meters --}}
                            <div class="col-span-full">
                                <label for="square_meters" class="block text-sm font-medium leading-6">Metri
                                    quadrati</label>
                                <div class="mt-2">
                                    <div
                                        class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                        <input type="number" name="square_meters" id="square_meters"
                                            autocomplete="square_meters"
                                            value="{{ old('square_meters', $apartment->square_meters) }}"
                                            class="block flex-1 rounded-md border-0 bg-transparent py-1.5 pl-1 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                            placeholder="13">
                                    </div>
                                </div>
                            </div>
                            {{-- service --}}
                            {{-- <div class="col-span-full">
                                <div class="block text-sm font-medium leading-6 pb-1.5">
                                    Servizi</div>
                                @foreach ($services as $service)
                                    <div class="relative flex gap-x-3">
                                        <div class="flex h-6 items-center">
                                            @if ($errors->any())
                                                <input @checked(in_array($service->id, old('services', []))) id="service-{{ $service->id }}"
                                                    name="service[]" type="checkbox" value="{{ $service->id }}"
                                                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                            @else
                                                <input @checked($apartment->services->contains($service)) id="service-{{ $service->id }}"
                                                    name="service[]" type="checkbox" value="{{ $service->id }}"
                                                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                            @endif
                                        </div>
                                        <div class="text-sm leading-6">
                                            <label for="service-{{ $service->id }}"
                                                class="font-medium">{{ $service->name }}</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div> --}}
                            {{-- visibility --}}
                            <div class="block text-sm font-medium leading-6">
                                Visibilità</div>
                            <div class="relative flex gap-x-3">
                                <div class="flex h-6 items-center">
                                    <input @checked(old('visibility', $apartment->visibility)) id="visibility-yes" name="visibility" type="radio"
                                        value="1"
                                        class="h-4 w-4 rounded-full border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                </div>
                                <div class="text-sm leading-6">
                                    <label for="visibility-yes" class="font-medium">Si</label>
                                </div>
                            </div>
                            <div class="relative flex gap-x-3">
                                <div class="flex h-6 items-center">
                                    <input @checked(old('visibility', !$apartment->visibility)) id="visibility-no" name="visibility"
                                        type="radio" value="0"
                                        class="h-4 w-4 rounded-full border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                </div>
                                <div class="text-sm leading-6">
                                    <label for="visibility-no" class="font-medium">No</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-6 flex items-center justify-end gap-x-6">
                        <button type="submit"
                            class="rounded-md bg-indigo-800 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
                    </div>
                </div>
        </div>
        </form>
    </div>
    </div>
@endsection
