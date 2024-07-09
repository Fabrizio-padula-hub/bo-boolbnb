@extends('layouts.admin')

@section('content')
    <div class="flex justify-between pb-3">
        <h1 class="uppercase text-indigo-400">Sponsorizza l'appartamento '{{ $apartment->title }}'</h1>
        <span id="ms-cartBtn" class="transition duration-150 ease-linear rounded-lg group cursor-pointer">
            <div class="relative pt-0.5 pr-1">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                    class="w-6 h-6 group-hover:text-indigo-400">
                    <path
                        d="M2.25 2.25a.75.75 0 0 0 0 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 0 0-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 0 0 0-1.5H5.378A2.25 2.25 0 0 1 7.5 15h11.218a.75.75 0 0 0 .674-.421 60.358 60.358 0 0 0 2.96-7.228.75.75 0 0 0-.525-.965A60.864 60.864 0 0 0 5.68 4.509l-.232-.867A1.875 1.875 0 0 0 3.636 2.25H2.25ZM3.75 20.25a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0ZM16.5 20.25a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Z" />
                </svg>
            </div>
        </span>
    </div>
    <div class="px-2 md-px-5 h-5/6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3 h-full">
            @foreach ($sponsorships as $sponsorship)
                <div class="p-8 text-center rounded-3xl shadow-xl bg-clip-border border-solid border-2 border-indigo-800">
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
                                Con il pacchetto {{ $sponsorship->name }}, avrai la possibilità di mettere in evidenza
                                il
                                tuo
                                appartamento per
                                {{ $sponsorship->duration }}h
                            </span>
                        </p>
                    </div>
                    <div class="flex justify-center">
                        <div class="flex items-center border-gray-100">
                            <span
                                class="decrement cursor-pointer rounded-l bg-white/10 py-1 px-3.5 duration-100 hover:bg-indigo-600 hover:text-blue-50">
                                - </span>
                            <span
                                class="quantity flex items-center justify-center h-8 w-8 bg-white/10 text-center text-xs outline-none">0</span>
                            <span
                                class="increment cursor-pointer bg-white/10 rounded-r py-1 px-3 duration-100 hover:bg-indigo-600 hover:text-blue-50">
                                + </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Shopping cart --}}
    <div class="ms-shoppingCart hidden h-full bg-black shadow-md md:mt-0 w-full md:w-1/3 lg:w-1/4 absolute right-0 top-0">
        <form id="payment-form" class="bg-white/10 h-full"
            action="{{ route('admin.payment.checkout', ['apartment' => $apartment->slug]) }}" method="POST"
            title="Sponsorizza">
            @csrf
            <div class="p-6">
                <div id="ms-closeCart" class="cursor-pointer mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="h-6 w-6 cursor-pointer duration-150">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
                <div id="cartContainer">
                    <!-- Qui verranno aggiunti gli elementi del carrello -->
                </div>
                <hr class="my-4" />
                <div class="flex justify-between">
                    <p class="text-lg font-bold">Totale</p>
                    <div>
                        <p id="totalPrice" class="inline-block mb-1 text-lg font-bold total">0.00</p><span>€</span>
                        <p class="text-sm text-gray-700">inclusa IVA</p>
                    </div>
                </div>
                <a id="prepaymentBtn">
                    <div
                        class="mt-6 w-full text-center rounded-md bg-indigo-700 py-1.5 font-medium text-blue-50 hover:bg-indigo-600 cursor-pointer">
                        Acquista</div>
                </a>
                <div id="dropin-container" class="hidden"></div>
                <button id="paymentBtn"
                    class="hidden mt-6 w-full rounded-md bg-indigo-700 py-1.5 font-medium text-blue-50 hover:bg-indigo-600"
                    type="submit">Acquista</button>
            </div>
            <input type="hidden" id="apartmentId" value="{{ $apartment->id }}">
            @foreach ($sponsorships as $sponsorship)
                <input type="hidden" id="sponsorshipId" name="sponsorship_ids[]" value="{{ $sponsorship->id }}">
            @endforeach
            <input type="hidden" id="apartmentSlug" value="{{ $apartment->slug }}">
        </form>
    </div>
@endsection
