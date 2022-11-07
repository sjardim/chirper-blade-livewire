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

    protected $listeners = ['editChirp', 'deleteChirp'];

    public function deleteChirp($chirp_id)
    {
        $this->chirp = Chirp::find($chirp_id);

        $this->chirp->delete();

        session()->flash('deleted_message', 'Chirp deleted!');
    }

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

        if($this->chirp->isDirty('message')) {
            session()->flash('updated_message', 'Chirp successfully updated!');
        }

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
