
        <div class="box-body">
            {!! Form::model([
              'action' => ['Admin\UnitController@update'],
              'method' => 'put',
            ]) !!}

            @include('/admin/unit/form')

            <div class="form-group">
                <button class="btn btn-primary" type="submit">Edit</button>
            </div>


            {!! Form::close() !!}

        </div>







