<?php

namespace App\Http\Livewire;

use App\Models\Chirp;
use Livewire\Component;

class ShowChirps extends Component
{
    protected $listeners = [
        'chirpCreated' => 'render',
        'chirpEdited' => 'render',
    ];

    public function edit($chirp_id)
    {
        $this->emit('editChirp', $chirp_id);
    }

    public function delete($chirp_id)
    {
        $this->emit('deleteChirp', $chirp_id);
    }

    public function render()
    {
        return view('livewire.show-chirps', [
            'chirps' => Chirp::with('user')->latest()->get()
        ]);
    }
}
