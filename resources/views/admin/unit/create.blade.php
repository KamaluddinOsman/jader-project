
@inject('model','App\UnitColor')

            {!! Form::model($model,[
                    'action' => ['Admin\UnitController@store'],
                    'enctype' => 'multipart/form-data',
            ]) !!}

            @include('/admin/unit/form')

            <div class="form-group">
                <button class="btn btn-primary" type="submit">Save</button>
            </div>

            {!! Form::close() !!}
