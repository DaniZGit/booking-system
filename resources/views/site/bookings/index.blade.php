<x-app-layout>
    <div class="w-full flex flex-col">
        <h1 class="font-bold text-3xl mb-4">{{ __('bookings.all_bookings') }}</h1>

        @if (count($bookings))
            <div class="grid grid-cols-3 gap-4">
                @foreach ($bookings as $booking)
                    <div class="border border-gray-300 rounded-xl hover:shadow-md transition-shadows overflow-hidden flex flex-col group">
                        @if($booking->room->hasImage('cover'))
                            <div class="rounded-t-xl overflow-hidden">
                                <img src="{{ $booking->room->image('cover') }}" alt="{{ $booking->room->title }}" class="aspect-video h-48 w-full object-cover group-hover:scale-110 transition-all duration-500">
                            </div>
                        @else
                            <div class="rounded-md aspect-video h-48 bg-gray-200 flex items-center justify-center text-gray-500">
                              {{ __('bookings.no_image') }}
                          </div>
                        @endif

                        <div class="p-4 flex flex-col">
                            <a href="{{ route('frontend.room', $booking->room->slug) }}" wire:navigate class="underline">
                                <h3 class="text-xl font-bold mb-2">
                                    {{ $booking->room->title }}
                                </h3>
                            </a>

                            <div class="space-y-2 mb-4">
                                <div class="flex items-center text-sm text-gray-600">
                                    <span class="font-semibold w-24">{{ __('bookings.check_in') }}</span>
                                    <span>{{ \Carbon\Carbon::parse($booking->date_from)->format('d. m. Y') }}</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-600">
                                    <span class="font-semibold w-24">{{ __('bookings.check_out') }}</span>
                                    <span>{{ \Carbon\Carbon::parse($booking->date_to)->format('d. m. Y') }}</span>
                                </div>
                            </div>

                            {{-- Podatki o gostu (za kontrolo) --}}
                            <div class="text-xs text-gray-500 italic">
                                {{ __('bookings.reserved_for') }} {{ $booking->name }} ({{ $booking->email }})
                            </div>

                            {{-- Cena --}}
                            <div class="mt-auto pt-4 flex justify-between items-center">
                                <span class="text-sm text-gray-500">{{ __('bookings.total_price') }}</span>
                                <span class="text-lg  font-bold">{{ number_format($booking->total_price, 2) }} €</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
          <div class="text-center py-8">{{ __('bookings.no_bookings') }}</div>
        @endif
    </div>
</x-app-layout>