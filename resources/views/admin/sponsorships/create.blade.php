@extends('layouts.admin')

@section('content')
    <h1>Sponsorizza l'appartamento '{{ $apartment->title }}'</h1>
    <form id="payment-form" action="{{ route('admin.payment.checkout', ['apartment' => $apartment->slug]) }}" method="POST"
        title="Sponsorizza">
        @csrf
        @foreach ($sponsorships as $sponsorship)
            <label for="sponsorship_{{ $sponsorship->id }}" class="cursor-pointer">
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
                        <p class="text-zinc-50 text-sm mt-4 ml-2">Sponsorizzazione per {{ $sponsorship->duration }} H</p>
                    </div>
                </div>
            </label>
            <input type="radio" id="sponsorship_{{ $sponsorship->id }}" name="sponsorship_id"
                value="{{ $sponsorship->id }}">
        @endforeach

        <div id="dropin-container"></div>

        <button type="submit"
            class="max-[457px]:mb-3 rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
            data-apartment-title="{{ $apartment->title }}">
            Sponsorizza
        </button>
    </form>
@endsection
