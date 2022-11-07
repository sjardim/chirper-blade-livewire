<?php

namespace App\Http\Livewire;

use App\Models\Chirp;
use Livewire\Component;

class ShowChirps extends Component
{
    public $chirps;

    protected $listeners = [
        'chirpCreated' => 'mount',
        'chirpEdited' => 'render',
        'chirpDeleted' => 'mount'
    ];

    public function mount()
    {
        $this->chirps = Chirp::with('user')->latest()->get();
    }

    public function render()
    {
        return view('livewire.show-chirps', [
            'chirps' => $this->chirps
        ]);
    }
}
