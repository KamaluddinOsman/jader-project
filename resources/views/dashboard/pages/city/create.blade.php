@inject('model','App\City')
{!! Form::model($model,['action' => ['Dashboard\CityController@store'], 'enctype' => 'multipart/form-data',]) !!}

    @include('/dashboard/pages/city/form')

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('city.close') }}</button>
        <button class="btn btn-primary" type="submit"> {{ __('city.addCity') }}</button>
    </div>

{!! Form::close() !!}
