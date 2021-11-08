
@inject('model','App\Category')
    {!! Form::model($model,[
            'action' => ['Admin\CategoryController@store'],
            'enctype' => 'multipart/form-data',
    ]) !!}

    @include('/admin/category/form')

    <div class="form-group">
        <button class="btn btn-primary" type="submit">Save</button>
    </div>

    {!! Form::close() !!}
