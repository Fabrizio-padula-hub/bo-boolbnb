<x-app-layout>
    <div class="grid grid-cols-1">
        <div class=" rounded-lg flex justify-center">
            <div class="max-w-sm rounded overflow-hidden shadow-lg">
                @if ($apartment->image)
                    <img class="w-full" src="{{ $apartment->image }}" alt="{{ $apartment->title }}">
                @endif
                <div class="px-6 py-4">
                    <div class="font-bold text-xl mb-2">{{ $apartment->title }}</div>
                    <div class="mb-2">
                        {{ $address = $apartment->street_name . ' ' . $apartment->street_number . ' ' . $apartment->postal_code }}
                    </div>
                    <div class="mb-2">Città: {{ $apartment->city }}</div>
                    <div class="mb-2">Numero di stanze: {{ $apartment->number_of_room }}</div>
                    <div class="mb-2">Numero di letti: {{ $apartment->number_of_beds }}</div>
                    <div class="mb-2">Numero di bagni: {{ $apartment->number_of_bathrooms }}</div>
                    <div class="mb-2">Metri quadrati:
                        {{ $apartment->square_meters ? $apartment->square_meters : 'Nullo' }}</div>
                    <div class="mb-2">Visibilità: {{ $apartment->visibility ? 'Si' : 'No' }}</div>
                    <div class="mb-2">Descrizione: {{ $apartment->description }}</div>
                </div>
                <div class="px-6 pt-4 pb-2">
                    @foreach ($apartment->service as $services)
                        <span
                            class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{ $service->name }}</span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
