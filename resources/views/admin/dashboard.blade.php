@extends('layouts.admin')

@section('content')
    <div class="grid grid-cols-1">
        <h2 class="text-base font-semibold leading-7 text-indigo-400 py-2">Dashboard</h2>
        <div class="relative flex w-full flex-col bg-clip-border border-solid border-2 border-indigo-800 rounded-lg">
            <div class="bg-trasparent overflow-hidden shadow-sm">
                <div class="p-6 text-white">
                    Benvenuto {{ Auth::user()->name }}
                </div>
            </div>
            <div class="p-6">
                {{-- @foreach ($apartmentVisits as $apartmentVisit)
                    <h1>{{ $apartmentVisit['apartment'] }}</h1>
                    @foreach ($apartmentVisit['visits'] as $visits)
                        <h2>{{ $visits }}</h2>
                    @endforeach
                @endforeach --}}
                <canvas id="apartmentsChart"></canvas>
                <script id="apartmentVisitsData" type="application/json">
                    @json($apartmentVisits)
                </script>
            </div>
        </div>
    </div>
@endsection
