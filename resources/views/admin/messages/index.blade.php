@extends('layouts.admin')

@section('content')
    <div class="mx-auto gap-2 sm:gap-4 md:gap-6 lg:gap-10 xl:gap-14 max-w-7xl my-10 px-2">
        <div id="last-incomes">
            <h1 class="font-bold py-4 uppercase">{{ __('Messaggi') }}</h1>
            <div id="stats" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                @foreach ($messages as $message)
                    <div class="bg-black/60 to-white/5 rounded-lg flex flex-col">
                        <div class="flex flex-row items-center p-4">
                            <div class="ml-2">
                                <p class="text-xl font-bold">{{ $message->name }}</p>
                                <p class="text-zinc-50 font-medium">{{ $message->email }}</p>
                                @foreach ($apartments as $apartment)
                                    @if ($apartment->id === $message->apartment_id)
                                        <p class="text-zinc-50 font-medium">{{ $apartment->title }}</p>
                                    @endif 
                                @endforeach
                            </div>
                        </div>
                        <div class="border-t border-white/5 p-4 flex-grow">
                            <p class="text-zinc-50 text-sm mt-4 ml-2">{{ $message->text }}</p>
                        </div>
                        <div class="mt-auto ml-5">
                            <p class="text-zinc-50 text-sm ">{{ $message->created_at }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endsection
