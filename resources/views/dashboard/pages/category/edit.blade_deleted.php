{!! Form::model(['action' => ['Dashboard\CategoryController@update'],'method' => 'put','enctype' => 'multipart/form-data']) !!}
    @include('/dashboard/pages/category/form')
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button class="btn btn-primary" type="submit"> {{__('lang.edit')}}</button>
    </div>
{!! Form::close() !!}








