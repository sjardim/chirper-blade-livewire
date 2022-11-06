<?php

namespace App\Http\Livewire;

use App\Models\Chirp;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ChirpForm extends Component
{
    public $message;
    public $is_editing = false;
    protected $user_id;

    public $chirp;

    protected $rules = [
        'message' => 'required|string|max:255',
    ];

    protected $listeners = ['editChirp'];

    public function editChirp($chirp_id)
    {
        $this->chirp = Chirp::find($chirp_id);

        $this->message = $this->chirp->message;

        $this->is_editing = true;
    }

    public function edit()
    {
        $this->validate();

        $this->chirp->message = $this->message;

        $this->chirp->save();

        $this->emit('chirpEdited');

        $this->reset('message');

        $this->is_editing = false;

    }

    public function save()
    {
        $this->validate();

        Chirp::create([
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
