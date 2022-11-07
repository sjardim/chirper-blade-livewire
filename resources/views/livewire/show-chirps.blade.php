<div>

    <div>
        @if (session()->has('updated_message'))
            <div class="bg-green-100 p-4 my-4 rounded-md">
                {{ session('updated_message') }}
            </div>
        @endif

        @if (session()->has('deleted_message'))
            <div class="bg-red-100 p-4 my-4 rounded-md">
                {{ session('deleted_message') }}
            </div>
        @endif
    </div>


    <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
        @foreach ($chirps as $chirp)

            <livewire:chirp-item :chirp="$chirp" :wire:key="time().$chirp->id">

        @endforeach

    </div>
</div>
