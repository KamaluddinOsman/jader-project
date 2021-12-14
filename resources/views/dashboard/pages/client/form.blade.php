@inject('model','App\Store')
@inject('category','App\Category')
@inject('city','App\City')
@inject('client','App\Client')

<?php
    $ins = \App\Store::first();
    $category = $category->Active()->pluck('name', 'id')->toArray();
    // $district = $district->pluck('name', 'id')->toArray();
    $client = $client->pluck('full_name', 'id')->toArray();
?>

<!-- Main content -->
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">{{ __('client.generalDetails') }}</h3>
            </div>
            <div class="card-body">
                <div class="mb-3 row">
                    <label for="inputName" class="col-md-2 col-form-label">{{ __('client.firstName') }}</label>
                    <div class="col-md-8">
                        {!! Form::text('first_name', null, ['class' => 'form-control' ]) !!}
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="inputName" class="col-md-2 col-form-label">{{ __('client.lastName') }}</label>
                    <div class="col-md-8">
                        {!! Form::text('last_name', null, ['class' => 'form-control' ]) !!}
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="inputName" class="col-md-2 col-form-label">{{ __('client.fullName') }}</label>
                    <div class="col-md-8">
                        {!! Form::text('full_name', null, ['class' => 'form-control' ]) !!}
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="inputName" class="col-md-2 col-form-label">{{ __('client.phoneNumber') }}</label>
                    <div class="col-md-8">
                        {!! Form::text('phone', null, ['class' => 'form-control' ]) !!}
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="inputName" class="col-md-2 col-form-label">{{ __('client.email') }}</label>
                    <div class="col-md-8">
                        {!! Form::text('email', null, ['class' => 'form-control' ]) !!}
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="inputProjectLeader" class="col-md-2 col-form-label">{{ __('client.district') }}</label>
                    <div class="col-md-8">
                        {{ Form::select('district_id', $cities, null, array('class'=>'form-select select2', 'placeholder'=>'الحى')) }}
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-md-2 col-form-label">{{__('client.logo')}} </label>

                    <div class="col-md-8">
                        <div class="card card-body">
                            <div class="card">
                                <div class="card-body">
                                    <input type="file" id="logoInp" class="form-control" name="image" for="logo" style="display: none">
                                    <img id="logo" src="#" alt="your image" class="rounded mx-auto img-thumbnail" style="display: none; max-width: 350px;max-height: 400px;" />

                                    @if(!empty($records->image))
                                        <img id="logo_old" style="width: 220px;margin-top: 12px;border: 1px solid #000000" src="{{ asset($records->image) }}">
                                    @else
                                        <img id="logoNoImage" style="width: 220px;margin-top: 12px;border: 1px solid #000000" src="{{ asset('img/no_image.png') }}">
                                    @endif
                                </div>
                            </div>                                                
                            <div class="card">
                                <div class="card-body">
                                    <div class="input-group">
                                        <label class="btn btn-success fileinput-button" for="logoInp">
                                            <i class="fas fa-plus"></i>
                                            <span>{{ __('client.addFile') }}</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>

</div>
<!-- /.content -->

