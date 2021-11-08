
@inject('model','App\City')

{!! Form::model($model,[
        'action' => ['Dashboard\CityController@store']
]) !!}

@include('/dashboard/pages/city/form')

{{-- <div class="form-group">
    <button class="btn btn-primary" type="submit">Save</button>
</div> --}}

{!! Form::close() !!}
