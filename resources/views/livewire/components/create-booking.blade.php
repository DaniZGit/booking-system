<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Computed;
use Illuminate\Support\Carbon;
use App\Models\Booking;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

new class extends Component {
    public $pricePerNight = 0;
    public $room_id = null;

    public $dateFrom = null;
    public $dateTo = null;

    public $name = '';
    public $email = '';

    public $currentStep = 1;
 
    public function mount(int $roomId, float $pricePerNight)
    {
        $this->room_id = $roomId;
        $this->pricePerNight = $pricePerNight;

        $this->dateFrom = Carbon::now()->toDateString();
    }

    #[Computed]
    public function totalPrice()
    {
        if (!$this->dateFrom || !$this->dateTo) return 0;
    
        $start = Carbon::parse($this->dateFrom);
        $end = Carbon::parse($this->dateTo);
        $days = $start->diffInDays($end);
        
        return $days * $this->pricePerNight;
    }

    public function nextStep()
    {
        $this->currentStep++;
    }

    public function prevStep()
    {
        $this->currentStep--;
    }

    public function submit()
    {
        $validated = $this->validate([ 
            'dateFrom' => ['required', Rule::date()->afterOrEqual(today()), Rule::date()->before('dateTo')],
            'dateTo' => ['required', Rule::date()->after('dateFrom')],
            'name' => 'required|min:3',
            'email' => 'required|email:rfc',
        ]);

        DB::transaction(function () use($validated) {
            $isBooked = Booking::where('room_id', $this->room_id)
                ->where(function ($query) use ($validated) {
                    $query->whereBetween('date_from', [$validated['dateFrom'], $validated['dateTo']])
                          ->orWhereBetween('date_to', [$validated['dateFrom'], $validated['dateTo']])
                          ->orWhere(function ($q) use ($validated) {
                              $q->where('date_from', '<=', $validated['dateFrom'])
                                ->where('date_to', '>=', $validated['dateTo']);
                          });
                })
                ->lockForUpdate()
                ->exists();
            
            if ($isBooked) {
                throw ValidationException::withMessages([
                    'booked' => 'The selected room is already booked for the chosen dates.'
                ]);
            }

            Booking::create([
                'user_id'     => auth()->id(),
                'room_id'     => $this->room_id,
                'date_from'   => $validated['dateFrom'],
                'date_to'     => $validated['dateTo'],
                'name'        => $validated['name'],
                'email'       => $validated['email'],
                'total_price' => $this->totalPrice,
            ]);
        });

        session()->flash('status', __('create_booking.success_message'));
    }
}; ?>

<div>
    @if (!session()->has('status'))
        <form wire:submit="submit">
            <!-- Step 1 -->
            <div class="flex flex-col gap-4" @if($this->currentStep != 1) style="display: none;" @endif>
                <div class="flex flex-col">
                    <x-input-label value="Select from date" />
                    <input type="date" wire:model.live="dateFrom" min="{{ Carbon::now()->toDateString() }}" >
                    <small class="text-red-500">@error('dateFrom'){{ $message }}@enderror</small>
                </div>
            
                <div class="flex flex-col">
                    <x-input-label value="Select to date" />
                    <input type="date" wire:model.live="dateTo" min="{{ $this->dateFrom ? Carbon::create($this->dateFrom)->addDay()->toDateString() : Carbon::now()->toDateString() }}" >
                    <small class="text-red-500">@error('dateTo'){{ $message }}@enderror</small>
                </div>
            
                <div>
                    <div class="font-bold">
                        {{-- Do Computed property dostopaš preko $this --}}
                        {{ __('create_booking.total_price') }}: {{ $this->totalPrice() ?: '/' }} € 
                        <span class="text-sm font-normal">({{ $this->pricePerNight }} € / {{ __('create_booking.night') }})</span>
                    </div>
                </div>
            
                <x-primary-button type="button" wire:click="nextStep" class="justify-center" :disabled="!$this->dateFrom || !$this->dateTo">
                    {{ __('create_booking.next_step') }}
                </x-primary-button>
            </div>

            <!-- Step 2 -->
            <div class="flex flex-col gap-4" @if($this->currentStep != 2) style="display: none;" @endif>
                <div class="flex flex-col">
                    <x-input-label value="Name" />
                    <input type="text" wire:model.live="name" />
                    <small class="text-red-500">@error('name'){{ $message }}@enderror</small>
                </div>
            
                <div class="flex flex-col">
                    <x-input-label value="Email" />
                    <input type="email" wire:model.live="email" />
                    <small class="text-red-500">@error('email'){{ $message }}@enderror</small>
                </div>
            
                <div>
                    <div class="font-bold">
                        {{-- Do Computed property dostopaš preko $this --}}
                        {{ __('create_booking.total_price') }}: {{ $this->totalPrice() ?: '/' }} € 
                        <span class="text-sm font-normal">({{ $this->pricePerNight }} € / {{ __('create_booking.night') }})</span>
                    </div>
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <x-secondary-button type="button" wire:click="prevStep" class="justify-center">
                        {{ __('create_booking.prev_step') }}
                    </x-secondary-button>
                    <x-primary-button type="submit" class="justify-center" :disabled="!$this->name || !$this->email">
                        {{ __('create_booking.submit_button') }}
                    </x-primary-button>
                </div>
            </div>
        </form>

        <small class="text-red-500 text-center w-full inline-block">@error('booked'){{ $message }}@enderror</small>
    @else
        <div class="text-lg font-medium italic text-center py-8 underline">
            {{ session('status') }}
        </div>
    @endif
</div>