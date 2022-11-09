<?php

namespace App\Http\Livewire;

use App\Models\Chirp;
use Livewire\Component;

class ChirpItem extends Component
{
    public $chirp;

    public $message;

    public $is_editing = false;

    protected $rules = [
        'message' => 'required|string|max:255',
    ];

    public function delete($chirp_id)
    {
        Chirp::find($chirp_id)->delete();

        $this->emit('chirpDeleted');
    }

    public function isEditing($chirp_id)
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

        $this->is_editing = false;

        $this->reset('message');

        $this->emit('chirpEdited');

    }

    public function cancel()
    {
        $this->is_editing = false;
        $this->reset('message');
    }

    public function render()
    {
        return view('livewire.chirp-item');
    }
}
