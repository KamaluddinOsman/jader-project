
@inject('model','App\City')

{!! Form::model($model,[
        'action' => ['Dashbpard\CityController@store']
]) !!}

@include('/dashboard/pages/city/form')

<div class="form-group">
    <button class="btn btn-primary" type="submit">Save</button>
</div>

{!! Form::close() !!}
