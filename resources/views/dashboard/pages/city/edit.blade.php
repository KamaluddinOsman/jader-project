
<div class="box-body">
    {!! Form::model(['action' => ['Dashboard\CityController@update'],'method' => 'put']) !!}
      @include('/dashboard/pages/city/form')
      <div class="form-group">
          <button class="btn btn-primary" type="submit">{{ __('city.editCity') }}</button>
      </div>
    {!! Form::close() !!}
</div>







