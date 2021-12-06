
@inject('model','App\Brand')

            {!! Form::model($model,[
                    'action' => ['Admin\BrandController@store'],
                    'enctype' => 'multipart/form-data',
            ]) !!}

            @include('/admin/unit/form')

            <div class="form-group">
                <button class="btn btn-primary" type="submit">Save</button>
            </div>

            {!! Form::close() !!}
