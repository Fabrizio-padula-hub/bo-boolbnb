@extends('layouts.admin')

@section('content')
    <form id="payment-form" class="h-full" action="{{ route('admin.payment.checkout', ['apartment' => $apartment->slug]) }}"
        method="POST" title="Sponsorizza">
        @csrf
        <h1 class="pb-3">Sponsorizza l'appartamento '{{ $apartment->title }}'</h1>
        <div class="px-2 md-px-5 h-5/6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3 h-full">
                @foreach ($sponsorships as $sponsorship)
                    <div
                        class=" p-8 text-center rounded-3xl shadow-xl bg-clip-border border-solid border-2 border-indigo-800">
                        <h1 class="text-indigo-400 font-semibold text-2xl">{{ $sponsorship->name }}</h1>
                        <p class="pt-2 tracking-wide">
                            <span class="align-top">€ </span>
                            <span class="text-3xl font-semibold">{{ $sponsorship->price }}</span>
                        </p>
                        <hr class="mt-4 border-1">
                        <div class="py-8">
                            <p class="font-semibold text-gray-400 text-left flex">
                                <span class="material-icons align-middle">
                                    Durata
                                </span>
                                <span class="pl-2">
                                    {{ $sponsorship->duration }}<span class="text-indigo-400">h</span>
                                </span>
                            </p>
                            <p class="font-semibold text-gray-400 text-left pt-5">
                                <span>
                                    Con il pacchetto {{ $sponsorship->name }}, avrai la possibilità di mettere in evidenza
                                    il
                                    tuo
                                    appartamento per
                                    {{ $sponsorship->duration }}h
                                </span>
                            </p>
                        </div>
                        <button type="submit"
                            class="max-[457px]:mb-3 rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                            data-apartment-title="{{ $apartment->title }}">
                            Sponsorizza
                        </button>
                    </div>
                @endforeach
            </div>
        </div>
    </form>
    {{-- <div id="dropin-container"></div> --}}
@endsection
