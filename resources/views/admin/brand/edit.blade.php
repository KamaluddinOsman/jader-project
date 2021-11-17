
        <div class="box-body">
            {!! Form::model([
              'action' => ['Admin\BrandController@update'],
              'method' => 'put',
            ]) !!}

            @include('/admin/brand/form')

            <div class="form-group">
                <button class="btn btn-primary" type="submit">Edit</button>
            </div>


            {!! Form::close() !!}

        </div>







