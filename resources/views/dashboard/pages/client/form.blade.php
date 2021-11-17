@inject('model','App\Store')
@inject('category','App\Category')
@inject('district','App\District')
@inject('client','App\Client')
<style>
    .image-upload>input {
        display: none;
    }
</style>
<?php
$ins = \App\Store::first();
$category = $category->Active()->pluck('name', 'id')->toArray();
$district = $district->pluck('name', 'id')->toArray();
$client = $client->pluck('full_name', 'id')->toArray();

?>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-9">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">بيانات عامة</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="inputName">{{__('lang.firstName')}}</label>
                        {!! Form::text('first_name',null,[
                      'class' => 'form-control',
                    ]) !!}
                    </div>

                    <div class="form-group">
                        <label for="inputName">{{__('lang.lastName')}}</label>
                        {!! Form::text('last_name',null,[
                      'class' => 'form-control',
                    ]) !!}
                    </div>

                    <div class="form-group">
                        <label for="inputName">{{__('lang.fullName')}}</label>
                        {!! Form::text('full_name',null,[
                      'class' => 'form-control',
                    ]) !!}
                    </div>

                    <div class="form-group">
                        <label for="inputName">{{__('lang.phone')}}</label>
                        {!! Form::text('phone',null,[
                      'class' => 'form-control',
                    ]) !!}
                    </div>

                    <div class="form-group">
                        <label for="inputName">{{__('lang.email')}}</label>
                        {!! Form::text('email',null,[
                      'class' => 'form-control',
                    ]) !!}
                    </div>

                    <div class="form-group">
                        <label for="inputProjectLeader">{{__('lang.district')}}</label>
                        {{ Form::select('district_id', $district, null, array('class'=>'form-control select2', 'placeholder'=>'الحى')) }}
                    </div>


                    <div class="form-group">
                        <label style="color:#000;font-size: 15px;padding-bottom: 15px" class="label">{{__('lang.logo')}} </label>
                        @if(!empty($records->logo))
                            <img style="width: 220px;margin-top: 12px;border: 1px solid #000000" src="{{ asset($records->image) }}">
                        @else
                            <img style="width: 220px;margin-top: 12px;border: 1px solid #000000"
                                 src="{{ asset('image/client/noImage.jpg') }}">
                        @endif

                        <label for="imgInp" class="btn btn-success col fileinput-button">
                            <i class="fas fa-plus"></i>
                            <span>Add files</span>
                        </label>


                        <input name="image" style="display: none" type="file" id="imgInp">

                        <img id="blah" src="#" alt="your image" style="display: none" />


                    </div>

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>

    </div>
</section>
<!-- /.content -->

