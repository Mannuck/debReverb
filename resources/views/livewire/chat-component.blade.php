<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}


    @foreach ($convo as $convoItems)
    <ul>
        <li>{{ $convoItems['username'] }}: {{ $convoItems['message'] }}</li>
    </ul>

     @endforeach

    <form wire:submit="submitMessage">
        <input type="text" wire:model="message">
        <button type="submit" >Send</button>
    </form>
</div>
