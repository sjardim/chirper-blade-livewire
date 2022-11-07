<?php

namespace App\Http\Livewire;

use App\Models\Chirp;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ChirpForm extends Component
{
    public $message;
    protected $user_id;

    protected $rules = [
        'message' => 'required|string|max:255',
    ];

    public function save()
    {
        $this->validate();

        $chirp = Chirp::create([
            'message' => $this->message,
            'user_id' => Auth::user()->id,
        ]);

        $this->emit('chirpCreated');

        $this->reset('message');

    }

    public function render()
    {
        return view('livewire.chirp-form');
    }
}
