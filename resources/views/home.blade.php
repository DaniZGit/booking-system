
<x-app-layout>
    <div class="flex flex-col justify-center items-center gap-4 grow">
        <h1 class="text-4xl font-semibold">
            {{ __('home.title') }}
        </h1>

        @auth
            <a href="{{ route('frontend.rooms') }}" wire:navigate>
                <x-secondary-button class="rounded-full text-lg border border-gray-400 px-4 py-2 transition-all hover:bg-gray-100">{{ __('home.button_rooms_title') }}</x-secondary-button>
            </a>

            <a href="{{ route('frontend.bookings') }}" wire:navigate>
                <x-secondary-button class="rounded-full text-lg border border-gray-400 px-4 py-2 transition-all hover:bg-gray-100">{{ __('home.button_bookings_title') }}</x-secondary-button>
            </a>
        @else
            <a href="{{ route('login') }}" wire:navigate>
                <x-secondary-button class="rounded-full text-lg border border-gray-400 px-4 py-2 transition-all hover:bg-gray-100">{{ __('home.button_login_title') }}</x-secondary-button>
            </a>
        @endauth
    </div>
</x-app-layout>
