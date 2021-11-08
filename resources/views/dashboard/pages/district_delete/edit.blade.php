
        <div class="box-body">
            {!! Form::model([
              'action' => ['Admin\CityController@update'],
              'method' => 'put',
            ]) !!}

            @include('/dashboard/pages/city/form')

            <div class="form-group">
                <button class="btn btn-primary" type="submit">Edit</button>
            </div>


            {!! Form::close() !!}

        </div>







