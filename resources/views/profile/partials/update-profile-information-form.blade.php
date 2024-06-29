<section>
    <header>
        <h2 class="text-lg font-medium text-indigo-400">
            {{ __('Informazioni Profilo') }}
        </h2>

    </header>


    <form class="mt-6 space-y-6">
        @csrf
        @method('patch')
        {{-- nome --}}
        <div>
            <x-input-label for="name" :value="__('Nome')" />
            <h4>{{ $user->name }}</h4>
        </div>

        {{-- email --}}
        <div class="disabled:cursor-not-allowed">
            <x-input-label for="email" :value="__('Email')" />
            <h4>{{ $user->email }}</h4>
        </div>

    </form>
</section>
