@extends('layouts.admin')

@section('content')
    <div class="mx-auto gap-2 sm:gap-4 md:gap-6 lg:gap-10 xl:gap-14 max-w-7xl my-10 px-2">
        <div id="last-incomes">
            <h1 class="font-bold py-4 uppercase">Sponsor</h1>
            <div id="stats" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                @foreach ($sponsorships as $sponsorship)
                    <div class="bg-black/60 to-white/5 rounded-lg flex flex-col">
                        <div class="flex flex-row items-center p-4">
                            <div class="">
                                <p class="text-xl font-bold">{{ $sponsorship->name }}</p>
                                <div class="flex items-center mt-4">
                                    <div class="text-3xl ">💰</div>
                                    <p class="text-zinc-50 font-medium">{{ $sponsorship->price }} $ </p>
                                </div>
                            </div>
                        </div>
                        <div class="border-t border-white/5 p-4 flex-grow">
                            <p class="text-zinc-50 text-sm mt-4 ml-2">Sponsorizzazione per {{ $sponsorship->duration }} H
                            </p>
                        </div>

                        <button class="ml-auto bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                            Apri Sponsor
                        </button>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
