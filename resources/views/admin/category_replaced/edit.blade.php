
            {!! Form::model([
              'action' => ['Admin\CategoryController@update'],
              'method' => 'put',
            ]) !!}

            @include('/admin/category/form')

            <div class="form-group">
                <button class="btn btn-primary" type="submit">Edit</button>
            </div>


            {!! Form::close() !!}








