<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $currentLocale = app()->getLocale();
        $this->redirect("/" . $currentLocale, navigate: false);
    }
}; ?>

<nav>
    <!-- Primary Navigation Menu -->
    <div class=" flex  items-center">
        <a href="{{ route('frontend.home') }}" class="mr-auto">
            <h2 class="text-2xl font-bold">Hotel System</h2>
        </a>

        @auth
        <div class="flex items-center gap-2">
            welcome
            <span class="font-bold border-r border-gray-400 pr-2">
                {{ Auth::user()->name }}
            </span>
            <button wire:click="logout" class="text-start">
                {{ __('header.logout_button') }}
            </button>
        </div>
        @else
            <a href="/login" wire:navigate>
                <button>
                    {{ __('header.login_button') }}
                </button>
            </a>
        @endguest

        <div class="flex items-center gap-2 ml-4 border border-gray-400 px-4 py-0.5 rounded-xl">
            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                <a 
                    href="/{{ $localeCode }}"
                    class="text-sm uppercase {{ app()->getLocale() == $localeCode ? 'font-bold underline pointer-events-none' : '' }}"
                >
                    {{ $localeCode }}
                </a>
            @endforeach
        </div>
    </div>
</nav>
