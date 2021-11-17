
    @foreach($variety as $v)
        <option value="{{ $v->id }}">{{ $v->name }}</option>
    @endforeach

{{--    <label for="inputDescription">التصنيف</label>--}}
{{--    {!! Form::select('variety_id', $variety,null,[--}}
{{--      'class' => 'form-control select2',--}}
{{--      'id'    => 'variety',--}}
{{--    ]) !!}--}}
{{--    </select>--}}
