
    @foreach($records as $p)
        <option value="{{ $p->id }}">{{ $p->name }}</option>
    @endforeach

