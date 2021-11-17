
        <div class="box-body">
            {!! Form::model([
              'action' => ['Admin\BannerController@update'],
              'method' => 'put',
            ]) !!}

            @include('/admin/banner/form')

            <div class="form-group">
                <button class="btn btn-primary" type="submit">Edit</button>
            </div>


            {!! Form::close() !!}

        </div>







