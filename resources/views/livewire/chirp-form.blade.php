<div>
    <form wire:submit.prevent="{{ $is_editing ? 'edit' : 'save' }}">
        @csrf
        <textarea
            wire:model="message"
            name="message"
            placeholder="{{ __('What\'s on your mind?') }}"
            class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
        >{{ old('message') }}</textarea>
        <x-input-error :messages="$errors->get('message')" class="mt-2" />
        @if($is_editing)
        <x-primary-button class="mt-4 bg-indigo-500">{{ __('Edit Chirp') }}</x-primary-button>
        @else
        <x-primary-button class="mt-4">{{ __('Chirp') }}</x-primary-button>
        @endif
    </form>
</div>
