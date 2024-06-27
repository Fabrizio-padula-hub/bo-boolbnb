<x-app-layout>
    <div class="mx-auto max-w-7xl px-4 py-24 sm:px-6 sm:py-32 lg:px-8">
        <div class="mx-auto max-w-2xl">
            <form action="{{ route('admin.apartments.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="space-y-12">
                    <div class="border-b border-gray-900/10 pb-12">
                        <h2 class="text-base font-semibold leading-7 text-gray-900 py-2">Aggiungi un appartamento</h2>
                        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="sm:col-span-4">
                                <label for="title"
                                    class="block text-sm font-medium leading-6 text-gray-900">Titolo</label>
                                <div class="mt-2">
                                    <div
                                        class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                        <input type="text" name="title" id="title" autocomplete="title"
                                            value="{{ old('title') }}"
                                            class="block flex-1 rounded-md border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                            placeholder="Appartamento zona EUR">
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-full">
                                <label for="street_name"
                                    class="block text-sm font-medium leading-6 text-gray-900">Indirizzo</label>
                                <div class="mt-2">
                                    <input type="text" name="street_name" id="street_name" autocomplete="street_name"
                                        value="{{ old('street_name') }}"
                                        class="block flex-1 rounded-md border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                        placeholder="Via Barlotto">
                                </div>
                            </div>
                            <div class="col-span-full">
                                <label for="street_number"
                                    class="block text-sm font-medium leading-6 text-gray-900">Numero civico</label>
                                <div class="mt-2">
                                    <input type="number" name="street_number" id="street_number"
                                        autocomplete="street_number" value="{{ old('street_number') }}"
                                        class="block flex-1 rounded-md border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                        placeholder="5">
                                </div>
                            </div>
                            <div class="col-span-full">
                                <label for="city"
                                    class="block text-sm font-medium leading-6 text-gray-900">Città</label>
                                <div class="mt-2">
                                    <input type="text" name="city" id="city" autocomplete="city"
                                        value="{{ old('city') }}"
                                        class="block flex-1 rounded-md border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                        placeholder="Roma">
                                </div>
                            </div>
                            <div class="col-span-full">
                                <label for="postal_code"
                                    class="block text-sm font-medium leading-6 text-gray-900">Codice postale</label>
                                <div class="mt-2">
                                    <input type="text" name="postal_code" id="postal_code" autocomplete="postal_code"
                                        value="{{ old('postal_code') }}"
                                        class="block flex-1 rounded-md border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                        placeholder="00118">
                                </div>
                            </div>
                            {{-- <div class="col-span-full">
                                <label for="photo"
                                    class="block text-sm font-medium leading-6 text-gray-900">Photo</label>
                                <div class="mt-2 flex items-center gap-x-3">
                                    <svg class="h-12 w-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor"
                                        aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M18.685 19.097A9.723 9.723 0 0021.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 003.065 7.097A9.716 9.716 0 0012 21.75a9.716 9.716 0 006.685-2.653zm-12.54-1.285A7.486 7.486 0 0112 15a7.486 7.486 0 015.855 2.812A8.224 8.224 0 0112 20.25a8.224 8.224 0 01-5.855-2.438zM15.75 9a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <button type="button"
                                        class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Change</button>
                                </div>
                            </div> --}}
                            <div class="col-span-full">
                                <label for="number_of_room"
                                    class="block text-sm font-medium leading-6 text-gray-900">Numero di stanze</label>
                                <div class="mt-2">
                                    <input type="number" name="number_of_room" id="number_of_room"
                                        autocomplete="number_of_room" value="{{ old('number_of_room') }}"
                                        class="block flex-1 rounded-md border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                        placeholder="1">
                                </div>
                            </div>
                            <div class="col-span-full">
                                <label for="number_of_beds"
                                    class="block text-sm font-medium leading-6 text-gray-900">Numero di letti</label>
                                <div class="mt-2">
                                    <input type="number" name="number_of_beds" id="number_of_beds"
                                        autocomplete="number_of_beds" value="{{ old('number_of_beds') }}"
                                        class="block flex-1 rounded-md border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                        placeholder="1">
                                </div>
                            </div>
                            <div class="col-span-full">
                                <label for="number_of_bathrooms"
                                    class="block text-sm font-medium leading-6 text-gray-900">Numero di bagni</label>
                                <div class="mt-2">
                                    <input type="number" name="number_of_bathrooms" id="number_of_bathrooms"
                                        autocomplete="number_of_bathrooms" value="{{ old('number_of_bathrooms') }}"
                                        class="block flex-1 rounded-md border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                        placeholder="1">
                                </div>
                            </div>
                            <div class="col-span-full">
                                <label for="square_meters"
                                    class="block text-sm font-medium leading-6 text-gray-900">Metri quadrati</label>
                                <div class="mt-2">
                                    <input type="number" name="square_meters" id="square_meters"
                                        autocomplete="square_meters" value="{{ old('square_meters') }}"
                                        class="block flex-1 rounded-md border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                        placeholder="13">
                                </div>
                            </div>
                            <div class="block text-sm font-medium leading-6 text-gray-900">Visibility</div>
                            <div class="relative flex gap-x-3">
                                <div class="flex h-6 items-center">
                                    <input @checked(old('visibility')) id="visibility" name="visibility"
                                        type="checkbox" value="visibility"
                                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                </div>
                                <div class="text-sm leading-6">
                                    <label for="visibility" class="font-medium text-gray-900">Si</label>
                                </div>
                            </div>
                            <div class="relative flex gap-x-3">
                                <div class="flex h-6 items-center">
                                    <input @checked(old('visibility')) id="visibility" name="visibility"
                                        type="checkbox" value="visibility"
                                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                </div>
                                <div class="text-sm leading-6">
                                    <label for="visibility" class="font-medium text-gray-900">No</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-6 flex items-center justify-end gap-x-6">
                        <button type="submit"
                            class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
