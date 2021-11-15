<option>Select card</option>
@if(!empty($cards))
    @foreach($cards as $card)
        <option value="{{ $card->id }}">{{ $card->getTypeStr() }}</option>
    @endforeach
@endif
