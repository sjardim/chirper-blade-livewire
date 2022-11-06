<?php

namespace App\Http\Livewire;

use App\Models\Chirp;
use Livewire\Component;

class ShowChirps extends Component
{
    protected $listeners = ['chirpCreated' => 'render'];

    public function render()
    {
        return view('livewire.show-chirps', [
            'chirps' => Chirp::with('user')->latest()->get()
        ]);
    }
}
