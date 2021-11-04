@inject('category','App\Category')
<?php
$category = $category->Active()->pluck('name', 'id')->toArray();
?>

<div class="form-group">
    <label for="inputDescription">الفئات</label>
    {!! Form::select('category_id',$category,null,[
      'class' => 'form-control select2',
      'id' => 'categoryid',
    ]) !!}
    </select>
</div>

<div class="form-group">
    <label style="color:#000;font-size: 15px;padding-bottom: 15px" class="label">{{__('lang.name')}} </label>
    {!! Form::text('name',null,[
      'class' => 'form-control',
      'id' => 'name'
    ]) !!}
</div>


<div class="form-group">
    {!! Form::label('color', 'Color', ['class' => 'control-label']) !!}
    {!! Form::text('code', old('color'), ['class' => 'form-control colorpicker','id' => 'mycode' ,'placeholder' => '']) !!}
    <p class="help-block"></p>
    @if($errors->has('color'))
        <p class="help-block">
            {{ $errors->first('color') }}
        </p>
    @endif
</div>


