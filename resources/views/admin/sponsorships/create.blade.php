@extends('layouts.admin')

@section('content')
    <form id="payment-form" class="h-full" action="{{ route('admin.payment.checkout', ['apartment' => $apartment->slug]) }}"
        method="POST" title="Sponsorizza">
        @csrf
        <div class="flex justify-between pb-3">
            <h1>Sponsorizza l'appartamento '{{ $apartment->title }}'</h1>
            <a id="ms-cartBtn" class="transition duration-150 ease-linear rounded-lg group">
                <div class="relative pt-0.5 pr-1">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="w-6 h-6 group-hover:text-indigo-400">
                        <path
                            d="M2.25 2.25a.75.75 0 0 0 0 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 0 0-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 0 0 0-1.5H5.378A2.25 2.25 0 0 1 7.5 15h11.218a.75.75 0 0 0 .674-.421 60.358 60.358 0 0 0 2.96-7.228.75.75 0 0 0-.525-.965A60.864 60.864 0 0 0 5.68 4.509l-.232-.867A1.875 1.875 0 0 0 3.636 2.25H2.25ZM3.75 20.25a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0ZM16.5 20.25a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Z" />
                    </svg>

                </div>
            </a>
        </div>
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
    {{-- Shopping cart --}}
    <div id="ms-shoppingCart"
        class="hidden mt-6 h-full border bg-white p-6 shadow-md md:mt-0 w-full md:w-1/3 lg:w-1/4 absolute right-0 top-0">
        <span id="ms-closeCart">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                <path fill-rule="evenodd"
                    d="M5.47 5.47a.75.75 0 0 1 1.06 0L12 10.94l5.47-5.47a.75.75 0 1 1 1.06 1.06L13.06 12l5.47 5.47a.75.75 0 1 1-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 0 1-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 0 1 0-1.06Z"
                    clip-rule="evenodd" />
            </svg>
        </span>
        <div class="mb-2 flex justify-between">
            <p class="text-gray-700">Subtotal</p>
            <p class="text-gray-700">$129.99</p>
        </div>
        <div class="flex justify-between">
            <p class="text-gray-700">Shipping</p>
            <p class="text-gray-700">$4.99</p>
        </div>
        <hr class="my-4" />
        <div class="flex justify-between">
            <p class="text-lg font-bold">Total</p>
            <div class="">
                <p class="mb-1 text-lg font-bold">$134.98 USD</p>
                <p class="text-sm text-gray-700">including VAT</p>
            </div>
        </div>
        <button class="mt-6 w-full rounded-md bg-blue-500 py-1.5 font-medium text-blue-50 hover:bg-blue-600">Check
            out</button>
    </div>
@endsection
