@extends('layouts.admin')

@section('content')
    <h1 class="font-bold py-4 uppercase">Dashboard</h1>
    <div class="relative flex w-full flex-col bg-clip-border border-solid border-2 border-indigo-800 rounded-lg">
        <div class="bg-trasparent overflow-hidden shadow-sm">
            <div class="p-6 text-white">
                Benvenuto {{ Auth::user()->name }}
            </div>
        </div>
    </div>
    <div class="w-full min-h-[30rem] max-sm:-ml-3 mt-4 flex justify-center">
        <canvas id="apartmentsChart" class="w-full h-full"></canvas>
    </div>
    <div id="apartmentVisitsData" class="hidden">{{ json_encode($apartmentVisits) }}</div>
@endsection
