{{-- <div class="form-group">
    <label style="color:#000;font-size: 15px;padding-bottom: 15px" class="label">{{__('lang.name')}} </label>
    {!! Form::text('name',null,[
      'class' => 'form-control',
      'id' => 'name'
    ]) !!}
</div> --}}

<div class="mb-3 row">
  <label for="name" class="col-md-2 col-form-label">{{__('lang.name')}}</label>
  <div class="col-md-10">
      <input class="form-control" type="text" name="name" value=""
          id="name">
  </div>
</div>