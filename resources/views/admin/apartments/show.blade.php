@extends('layouts.admin')

@section('content')
    <div class="grid grid-cols-1">
        <div class="relative flex w-full flex-col bg-clip-border">
            <div
                class="pl-6 relative m-0 rounded-none backdrop-blur-sm hover:backdrop-blur-lg bg-clip-border shadow-none max-w-lg">
                @if ($apartment->image)
                    <img class="w-full" src="{{ $apartment->image }}" alt="{{ $apartment->title }}">
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
                    {{ $address = $apartment->street_name . ' ' . $apartment->street_number . ', ' . $apartment->postal_code . ', ' . $apartment->city }}
                </p>
                <p class="mb-1.5 leading-snug tracking-normal antialiased">
                    Numero di stanze: {{ $apartment->number_of_room }}
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
                <p class="leading-snug tracking-normal antialiased">
                    {{ $apartment->visibility ? 'Visibile' : 'Non visibile' }}
                </p>
            </div>
        </div>
    </div>
@endsection
