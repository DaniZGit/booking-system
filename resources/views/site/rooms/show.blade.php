<x-app-layout>
    <div class="w-full grid grid-cols-12 gap-4">
        <div class="col-span-8 border-r border-gray-400 pr-4 flex flex-col gap-4 ">
            <div>
                <a href="{{ route('frontend.rooms') }}" wire:navigate class="underline capitalize" >{{ __('room.rooms_slug') }}</a>
                >
                <span class="font-semibold">{{ $room->title }}</span>
            </div>

            <h1 class="text-3xl font-bold">{{ $room->title }}</h1>
    
            @if($room->hasImage('cover'))
                <img src="{{ $room->image('cover') }}" alt="{{ $room->title }}" class="rounded-md aspect-video max-h-64 w-full object-cover">
            @else
                <div class="rounded-md aspect-video bg-gray-200 flex items-center justify-center text-gray-500 max-h-64 w-full">
                    No Image
                </div>
            @endif

            <div>
                <h3 class="text-xl font-semibold">Description</h3>
                <p>{{ $room->description }}</p>
            </div>

            @if($room->blocks->isNotEmpty())
                <div>
                    <h3 class="text-xl font-semibold">Details</h3>
                    {!! $room->renderBlocks() !!}
                </div>
            @endif
        </div>
        <div class="col-span-4">
            <h3 class="text-xl font-semibold text-center mb-4">{{ __('room.book_this_room') }}</h3>
            <livewire:components.create-booking :room-id="$room->id" :price-per-night="$room->price"></livewire:components.create-booking>
        </div>
    </div>
</x-app-layout>