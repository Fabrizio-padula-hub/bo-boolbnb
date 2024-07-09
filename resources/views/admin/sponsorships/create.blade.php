@extends('layouts.admin')

@section('content')
    <h1 class="pb-3 uppercase text-indigo-400">Sponsorizza l'appartamento '{{ $apartment->title }}'</h1>
    <div class="px-2 md-px-5 h-5/6 flex justify-center">
        <form id="payment-form" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3 h-full w-3/4"
            action="{{ route('admin.payment.checkout', ['apartment' => $apartment->slug]) }}" method="POST"
            title="Sponsorizza">
            @csrf
            @csrf
            @foreach ($sponsorships as $sponsorship)
                <label class="sponsorship" for="{sponsorship_{{ $sponsorship->id }}" data-card="{{ $sponsorship }}">
                    <div
                        class="p-8 text-center rounded-3xl shadow-xl bg-clip-border border-solid border-2 border-indigo-800 h-2/3">
                        <h1 class="text-indigo-400 font-semibold text-2xl">{{ $sponsorship->name }}</h1>
                        <p class="pt-2 tracking-wide">
                            <span class="align-top">€ </span>
                            <span class="text-3xl font-semibold price">{{ $sponsorship->price }}</span>
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
                                <span class="hidden md:inline">
                                    Con il pacchetto {{ $sponsorship->name }}, avrai la possibilità di mettere in
                                    evidenza
                                    il
                                    tuo
                                    appartamento per
                                    {{ $sponsorship->duration }}h
                                </span>
                            </p>
                        </div>
                    </div>
                </label>
                <input type="radio" id="{sponsorship_{{ $sponsorship->id }}" class="hidden" name="sponsorship_ids[]"
                    value="{{ $sponsorship->id }}">
            @endforeach
        </form>
    </div>

    {{-- Offcanvas payment --}}
    <div
        class="payment-form-container hidden h-full bg-black shadow-md md:mt-0 w-full md:w-1/3 lg:w-1/4 absolute left-0 top-0">
        <form id="payment-form" class="bg-white/10 h-full"
            action="{{ route('admin.payment.checkout', ['apartment' => $apartment->slug]) }}" method="POST"
            title="Sponsorizza">
            @csrf
            <div class="p-6">
                <div id="cartContainer">
                    <!-- Qui verranno aggiunti gli elementi del carrello -->
                </div>
                <div id="dropin-container" class="hidden"></div>
                <button id="paymentBtn"
                    class="mt-6 w-full rounded-md bg-indigo-700 py-1.5 font-medium text-blue-50 hover:bg-indigo-600"
                    type="submit">
                    Acquista
                </button>
            </div>
            <input type="hidden" id="apartmentId" value="{{ $apartment->id }}">
            <input type="hidden" id="apartmentSlug" value="{{ $apartment->slug }}">
        </form>
    </div>
@endsection
