
        <div class="box-body">
            {!! Form::model([
              'action' => ['Admin\ColorController@update'],
              'method' => 'put',
            ]) !!}

            @include('/admin/color/form')

            <div class="form-group">
                <button class="btn btn-primary" type="submit">Edit</button>
            </div>


            {!! Form::close() !!}

        </div>







