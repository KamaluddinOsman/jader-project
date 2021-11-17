
        <div class="box-body">
            {!! Form::model([
              'action' => ['Admin\CityController@update'],
              'method' => 'put',
            ]) !!}

            @include('/admin/city/form')

            <div class="form-group">
                <button class="btn btn-primary" type="submit">Edit</button>
            </div>


            {!! Form::close() !!}

        </div>







