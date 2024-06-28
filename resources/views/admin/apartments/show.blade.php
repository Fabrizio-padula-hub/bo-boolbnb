@extends('layouts.admin')

@section('content')
    <div class="grid grid-cols-1">
        {{-- freccia per ritornare all'index --}}
        <div>
            <a href="{{ route('admin.apartments.index') }}">
                <svg class="h-8 w-8 text-indigo-800 mb-4 hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
                </svg>
            </a>
        </div>
        
        <div class="relative flex w-full flex-col bg-clip-border border-solid border-2 border-indigo-800 rounded-lg">
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
                    {{ $address = $apartment->address }}
                </p>
                <p class="mb-1.5 leading-snug tracking-normal antialiased">
                    Numero di stanze: {{ $apartment->number_of_rooms }}
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
