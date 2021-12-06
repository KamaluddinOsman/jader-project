@inject('category','App\Category')
<?php
 $category = $category->pluck('name','id')->toArray();

?>
<div class="col-md-8">

    <div class="form-group">
        <label style="color:#000;font-size: 15px;margin-bottom: 30px" class="label">{{__('lang.name')}} </label>
        <br>
        <br>
        {!! Form::text('name',null,[
          'class' => 'form-control',
        ]) !!}
    <br>
        <label style="color:#000;font-size: 15px;padding-bottom: 15px" class="label">{{__('lang.email')}} </label>
        <br>
        <br>
        {!! Form::text('email',null,[
          'class' => 'form-control',
        ]) !!}
    <br>

        <label style="color:#000;font-size: 15px;padding-bottom: 15px" class="label">{{__('lang.phone')}} </label>
        <br>
        <br>
        {!! Form::text('phone',null,[
          'class' => 'form-control',
        ]) !!}
    <br>

        <label style="color:#000;font-size: 15px;padding-bottom: 15px" class="label">{{__('lang.district')}} </label>
        <br>
        <br>
        {{ Form::select('district_id', $district, null, array('class'=>'form-control', 'placeholder'=>'الحى')) }}


        <br>

    </div>




</div>


<div class="col-md-4">
    @if(!empty($records->image))
        <img style="width: 220px;margin-top: 12px;border: 1px solid #000000" src="{{ asset('image/client/'.$records->image) }}">
    @else
        <img style="width: 220px;margin-top: 12px;border: 1px solid #000000" src="{{ asset('image/client/noImage.jpg') }}">
    @endif

    {!! Form::file('image',[

        ]) !!}

</div>


