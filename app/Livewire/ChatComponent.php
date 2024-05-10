<?php

namespace App\Livewire;

use App\Events\MessageEvent;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;


class ChatComponent extends Component
{

    public $message;
    public $convo = [];

    public function mount()
    {
        $messages = Message::all();

        foreach ($messages as $message) {
            $this->convo[] = [
                'username' => $message->user->name,
                'message' => $message->message,
            ];
        }
    }
    public function render()
    {

        $messages = Message::all();
        return view('livewire.chat-component',['messages' => $messages]);
    }

    public function submitMessage()
    {
        MessageEvent::dispatch(Auth::user()->id, $this->message);
        $this->message = '';
    }
    // no agregar espacios, de lo contrario no funcionara
    #[On('echo:our-channel,MessageEvent')]
    public function listenForMessage($data)
    {
        $this->convo[] =  [
            'username' => $data['username'],
            'message' => $data['message'],
        ];
    }
}
