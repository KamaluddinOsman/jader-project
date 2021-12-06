
@inject('model','App\City')

            {!! Form::model($model,[
                    'action' => ['Admin\CityController@store']
            ]) !!}

            @include('/admin/city/form')

            <div class="form-group">
                <button class="btn btn-primary" type="submit">Save</button>
            </div>

            {!! Form::close() !!}
