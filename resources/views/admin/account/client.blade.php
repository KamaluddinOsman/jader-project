
    @foreach($client as $c)
        @if($type == 'client')
            <option data-type="{{$type}}" value="{{ $c->id }}">{{ $c->full_name }}</option>
        @elseif($type == 'stores')
            <option data-type="{{$type}}" value="{{ $c->id }}">{{ $c->full_name }}({{$c->$type->name}})</option>
        @else
            <option data-type="{{$type}}" value="{{ $c->id }}">{{ $c->full_name }}({{$c->$type->number}})</option>
        @endif
    @endforeach
