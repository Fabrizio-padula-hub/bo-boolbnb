@extends('layouts.admin')

@section('content')
    <h1 class="font-bold py-4 uppercase">Messaggi</h1>
    <section class="relative flex flex-col justify-centeroverflow-hidden antialiased">
        <div class="w-full max-w-6xl">
            <div class="flex flex-col justify-center divide-y divide-slate-200 py-4">
                <div class="w-full max-w-3xl">
                    <!-- Vertical Timeline #3 -->
                    <div
                        class="space-y-8 relative before:absolute before:inset-0 before:ml-5 before:-translate-x-px md:before:ml-[8.75rem] md:before:translate-x-0 before:h-full before:w-0.5 before:bg-gradient-to-b before:from-transparent before:via-slate-300 before:to-transparent">
                        @foreach ($messages as $message)
                            <!-- Item #1 -->
                            <div class="relative">
                                <div class="md:flex items-center md:space-x-4 mb-3">
                                    <div class="flex items-center space-x-4 md:space-x-2 md:space-x-reverse">
                                        <!-- Icon -->
                                        <div
                                            class="flex items-center justify-center w-10 h-10 rounded-full bg-black/60 to-white/5 shadow md:order-1 md:ml-[1px]">
                                            <svg class="fill-slate-400" xmlns="http://www.w3.org/2000/svg" width="16"
                                                height="16">
                                                <path
                                                    d="M8 0a8 8 0 1 0 8 8 8.009 8.009 0 0 0-8-8Zm0 12a4 4 0 1 1 0-8 4 4 0 0 1 0 8Z" />
                                            </svg>
                                        </div>
                                        <!-- Date -->
                                        <time
                                            class="text-sm font-medium md:w-28">{{ \Carbon\Carbon::parse($message->created_at)->format('d/m/Y H:i') }}</time>
                                    </div>
                                    <!-- Title -->
                                    <div class="ml-14"><span class="text-indigo-400 font-bold">{{ $message->name }}</span>
                                        {{ $message->email }}
                                    </div>
                                </div>
                                <!-- Card -->
                                <div class="bg-black/60 to-white/5 p-4 rounded-3xl shadow ml-14 md:ml-44">
                                    {{ $message->text }}</div>
                            </div>
                        @endforeach

                    </div>
                    <!-- End: Vertical Timeline #3 -->
                </div>
            </div>
        </div>
    </section>
@endsection
