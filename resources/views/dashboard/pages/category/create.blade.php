
@inject('model','App\Category')
    {!! Form::model($model,[
            'action' => ['Dashboard\CategoryController@store'],
            'enctype' => 'multipart/form-data',
    ]) !!}

    @include('/dashboard/pages/category/form')

    {{-- <div class="form-group">
        <button class="btn btn-primary" type="submit">Save</button>
    </div> --}}

    {!! Form::close() !!}
