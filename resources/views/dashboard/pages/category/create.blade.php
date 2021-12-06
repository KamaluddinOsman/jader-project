
@inject('model','App\Category')
{!! Form::model($model,['action' => ['Dashboard\CategoryController@store'], 'enctype' => 'multipart/form-data']) !!}
    @include('/dashboard/pages/category/form')
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('category.close') }}</button>
        <button class="btn btn-primary" type="submit"> {{ __('category.addCategory') }}</button>
    </div>
{!! Form::close() !!}