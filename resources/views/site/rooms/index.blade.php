<x-app-layout>
    <div>
        <h1 class="font-bold text-3xl mb-4">{{ __('rooms.all_rooms') }}</h1>

        <div class="grid grid-cols-3 gap-4">
            @foreach ($rooms as $room)
                <div class="rounded-xl border border-gray-300 p-4 hover:shadow-md transition-shadow flex flex-col gap-2">
                    <span class="font-bold text-xl capitalize line-clamp-2">{{ $room->title }}</span>
                    
                    @if($room->hasImage('cover'))
                        <img src="{{ $room->image('cover') }}" alt="{{ $room->title }}" class="rounded-xl aspect-video">
                    @else
                        <div class="rounded-xl aspect-video bg-gray-200 flex items-center justify-center text-gray-500">
                            No Image
                        </div>
                    @endif

                    <p class="line-clamp-3">
                        {{ $room->description }}
                    </p>

                    <div class="flex justify-between items-center gap-2 mt-auto">
                        <a href="{{ route('frontend.room', $room->slug) }}" wire:navigate>
                            <x-secondary-button class="justify-center grow">{{ __('rooms.view_details_button') }}</x-secondary-button>
                        </a>

                        <span class="font-semibold shrink-0">{{ $room->price }} € / noč</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>