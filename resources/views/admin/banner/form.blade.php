<div class="form-group">
    <label style="color:#000;font-size: 15px;padding-bottom: 15px" class="label">{{__('lang.title')}} </label>
    {!! Form::text('title',null,[
      'class' => 'form-control',
      'id' => 'title'
    ]) !!}
</div>

<div class="form-group">
    <label style="color:#000;font-size: 15px;padding-bottom: 15px" class="label">{{__('lang.description')}} </label>
    {!! Form::text('description',null,[
      'class' => 'form-control',
      'id' => 'description'
    ]) !!}
</div>

<div class="form-group">
    <label style="color:#000;font-size: 15px;padding-bottom: 15px" class="label">{{__('lang.active')}} </label>
    <div class="col-md-4">
        {!! Form::checkBox('active') !!}
    </div>
</div>

<div class="form-group">
    <label style="color:#000;font-size: 15px;padding-bottom: 15px" class="label">{{__('lang.image')}} </label>
    <div class="col-md-4">
        {!! Form::file('image') !!}
    </div>
</div>

