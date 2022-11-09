<?php

namespace App\Http\Livewire;

use App\Models\Chirp;
use Livewire\Component;

class ShowChirps extends Component
{
    public $chirps;

    protected $listeners = [
        'chirpCreated' => 'mount',
        'chirpDeleted',
        'chirpEdited',
    ];

    public function chirpEdited()
    {
        session()->flash('updated_message', 'Chirp successfully updated!');
    }

    public function chirpDeleted()
    {
        session()->flash('deleted_message', 'Chirp deleted successfully!');
    }

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
