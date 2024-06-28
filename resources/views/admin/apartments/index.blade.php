@extends('layouts.admin')
@section('content')
    <table class="w-full whitespace-nowrap">
        <thead class="bg-black/60">
            <th class="text-left py-3 px-2 rounded-l-lg">{{ __('Titolo') }}</th>
            <th class="text-left py-3 px-2 max-md:hidden">{{ __('Indirizzo') }}</th>
            <th class="text-left py-3 px-2 max-md:hidden">{{ __('Visibilità') }}</th>
            <th class="text-left py-3 px-2 rounded-r-lg">{{ __('Azioni') }}</th>
        </thead>
        @foreach ($apartments as $apartment)
            <tr class="border-b border-gray-700">
                <td class="py-3 px-2">{{ $apartment->title }}</td>
                <td class="py-3 px-2 max-md:hidden">{{ $apartment->city }}</td>
                <td class="py-3 px-2 max-md:hidden">{{ $apartment->visibility ? 'Si' : 'No' }}</td>
                <td class="py-3 px-2">
                    <div class="inline-flex items-center space-x-3">
                        <a href="{{ route('admin.apartments.show', $apartment->slug) }}" title="Mostra"
                            class="hover:text-white"><svg class="w-5 h-5" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                <circle cx="12" cy="12" r="3" />
                            </svg>
                        </a>
                        <a href="{{ route('admin.apartments.edit', ['apartment' => $apartment->slug]) }}" title="Modifica" class="hover:text-white"><svg xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                            </svg>
                        </a>
                        <a href="" title="Elimina" class="hover:text-white"><svg xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                            </svg>
                        </a>
                    </div>
                </td>
            </tr>
        @endforeach
        
    </table>
    
@endsection
