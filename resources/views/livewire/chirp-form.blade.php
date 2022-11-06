<div>
    <div>
        @if (session()->has('updated_message'))
            <div class="bg-green-100 p-4 mb-4 rounded-md">
                {{ session('updated_message') }}
            </div>
        @endif
    </div>

    @if($is_editing)
    <form wire:submit.prevent="edit">
        @csrf
        <textarea
            wire:model.lazy="message"
            name="message"
            class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
        >{{ old('message') }}</textarea>
        <x-input-error :messages="$errors->get('message')" class="mt-2" />

        <x-primary-button class="mt-4 bg-indigo-500">{{ __('Edit Chirp') }}</x-primary-button>
        <x-primary-button class="mt-4" type='reset' wire:click="cancel()">{{ __('Cancel') }}</x-primary-button>
    </form>
    @else
    <form wire:submit.prevent="save">
        @csrf
        <textarea
            wire:model.lazy="message"
            name="message"
            placeholder="{{ __('What\'s on your mind?') }}"
            class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
        >{{ old('message') }}</textarea>
        <x-input-error :messages="$errors->get('message')" class="mt-2" />
        <x-primary-button class="mt-4">{{ __('Chirp') }}</x-primary-button>
    </form>
    @endif
</div>
