@extends('layouts.admin')

@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div
                class="bg-trasparent overflow-hidden shadow-sm rounded-lg bg-clip-border border-solid border-2 border-indigo-800">
                <div class="p-6 text-white">
                    Benvenuto {{ Auth::user()->name }}
                </div>
            </div>
        </div>
    </div>
@endsection
