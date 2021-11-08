
  {!! Form::model([
    'action' => ['Dashboard\CategoryController@update'],
    'method' => 'put',
  ]) !!}

  @include('/dashboard/pages/category/form')

  <div class="form-group">
      <button class="btn btn-primary" type="submit">Edit</button>
  </div>


  {!! Form::close() !!}








