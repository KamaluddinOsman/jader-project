
@inject('model','App\Banner')

            {!! Form::model($model,[
                    'action' => ['Admin\BannerController@store'],
                    'enctype' => 'multipart/form-data',
            ]) !!}

            @include('/admin/banner/form')

            <div class="form-group">
                <button class="btn btn-primary" type="submit">Save</button>
            </div>

            {!! Form::close() !!}
