@extends('layouts.admin')

@section('content')
    <div class="grid grid-cols-1">
        <div class="flex justify-center">
            <form action="{{ route('admin.apartments.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="space-y-12">
                    <div class="border-b border-gray-900/10 pb-12">
                        <h2 class="text-base font-semibold leading-7 text-indigo-400 py-2">Modifica un appartamento</h2>
                        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="sm:col-span-4">
                                <label for="title" class="block text-sm font-medium leading-6">Titolo</label>
                                <div class="mt-2">
                                    <div
                                        class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                        <input type="text" name="title" id="title" autocomplete="title"
                                            value="{{ old('title') }}"
                                            class="block flex-1 rounded-md border-0 bg-transparent py-1.5 pl-1 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                            placeholder="Appartamento zona EUR">
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-full">
                                <label for="description" class="block text-sm font-medium leading-6">Descrizione</label>
                                <div class="mt-2">
                                    <div
                                        class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                        <textarea id="description" name="description" rows="3"
                                            class="block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{ old('description') }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-full">
                                <label for="address" class="block text-sm font-medium leading-6">Indirizzo</label>
                                <div class="mt-2">
                                    <div
                                        class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                        <input type="text" name="address" id="address" autocomplete="address"
                                            value="{{ old('address') }}"
                                            class="block flex-1 rounded-md border-0 bg-transparent py-1.5 pl-1 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                            placeholder="Via Barlotto">
                                    </div>
                                </div>
                            </div>


                            <div class="col-span-full">
                                <label for="number_of_room" class="block text-sm font-medium leading-6">Numero
                                    di stanze</label>
                                <div class="mt-2">
                                    <div
                                        class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                        <input type="number" name="number_of_rooms" id="number_of_rooms"
                                            autocomplete="number_of_rooms" value="{{ old('number_of_rooms') }}"
                                            class="block flex-1 rounded-md border-0 bg-transparent py-1.5 pl-1 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                            placeholder="1">
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-full">
                                <label for="number_of_beds" class="block text-sm font-medium leading-6">Numero
                                    di letti</label>
                                <div class="mt-2">
                                    <div
                                        class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                        <input type="number" name="number_of_beds" id="number_of_beds"
                                            autocomplete="number_of_beds" value="{{ old('number_of_beds') }}"
                                            class="block flex-1 rounded-md border-0 bg-transparent py-1.5 pl-1 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                            placeholder="1">
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-full">
                                <label for="number_of_bathrooms" class="block text-sm font-medium leading-6">Numero
                                    di bagni</label>
                                <div class="mt-2">
                                    <div
                                        class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                        <input type="number" name="number_of_bathrooms" id="number_of_bathrooms"
                                            autocomplete="number_of_bathrooms" value="{{ old('number_of_bathrooms') }}"
                                            class="block flex-1 rounded-md border-0 bg-transparent py-1.5 pl-1 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                            placeholder="1">
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-full">
                                <label for="square_meters" class="block text-sm font-medium leading-6">Metri
                                    quadrati</label>
                                <div class="mt-2">
                                    <div
                                        class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                        <input type="number" name="square_meters" id="square_meters"
                                            autocomplete="square_meters" value="{{ old('square_meters') }}"
                                            class="block flex-1 rounded-md border-0 bg-transparent py-1.5 pl-1 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                            placeholder="13">
                                    </div>
                                </div>
                            </div>
                            <div class="block text-sm font-medium leading-6">
                                Visibility</div>
                            <div class="relative flex gap-x-3">
                                <div class="flex h-6 items-center">
                                    <input @checked(old('visibility')) id="visibility" name="visibility" type="checkbox"
                                        value="1"
                                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                </div>
                                <div class="text-sm leading-6">
                                    <label for="visibility" class="font-medium">Si</label>
                                </div>
                            </div>
                            <div class="relative flex gap-x-3">
                                <div class="flex h-6 items-center">
                                    <input @checked(old('visibility')) id="visibility" name="visibility" type="checkbox"
                                        value="0"
                                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                </div>
                                <div class="text-sm leading-6">
                                    <label for="visibility" class="font-medium">No</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-6 flex items-center justify-end gap-x-6">
                        <button type="submit"
                            class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
                    </div>
                </div>
        </div>
        </form>
    </div>
    </div>
@endsection
