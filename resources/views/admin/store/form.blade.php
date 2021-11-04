@inject('model','App\Store')
@inject('category','App\Category')
@inject('district','App\District')
@inject('client','App\Client')
<style>
    .image-upload > input {
        display: none;
    }
</style>
<?php
$ins = \App\Store::first();
$category = $category->pluck('name', 'id')->toArray();
$district = $district->pluck('name', 'id')->toArray();
$client = $client->Active()->pluck('full_name', 'id')->toArray();
?>

<input type="hidden" value="" id="latitude" name="late">
<input type="hidden" value="" id="longitude" name="lang">

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-6">
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
                        <label for="inputName">{{__('lang.name')}}</label>
                        {!! Form::text('name',null,[
                      'class' => 'form-control',
                    ]) !!}
                    </div>
                    <div class="form-group">
                        <label for="inputName">{{__('lang.name_responsible')}}</label>
                        {!! Form::text('name_responsible',null,[
                      'class' => 'form-control',
                    ]) !!}
                    </div>
                    <div class="form-group">
                        <label for="inputName">{{__('lang.responsible_position')}}</label>
                        {!! Form::text('responsible_position',null,[
                      'class' => 'form-control',
                    ]) !!}
                    </div>
                    <div class="form-group">
                        <label for="inputName">{{__('lang.responsible_mobile')}}</label>
                        {!! Form::text('responsible_mobile',null,[
                      'class' => 'form-control',
                    ]) !!}
                    </div>
                    <div class="form-group">
                        <label for="inputDescription">{{__('lang.client')}}</label>
                        {{ Form::select('client_id', $client, null, array('class' => 'form-control select2', 'placeholder'=>'صاحب المنشأة')) }}
                    </div>
                    <div class="form-group">
                        <label for="inputDescription">الفئات</label>
                        {!! Form::select('category_id',$category,null,[
                          'class' => 'form-control select2',
                          'id'    => 'category'
                        ]) !!}
                    </div>
                    <div class="form-group">
                        <label for="inputDescription">فئات مخصصة</label>
                        <div class="select2-purple">
                            <select id="childCategory" class="select2" name="childCategory[]" multiple="multiple"
                                    data-placeholder="فئات مخصصة"
                                    data-dropdown-css-class="select2-purple" style="width: 100%;">
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputProjectLeader">{{__('lang.phone')}}</label>
                        {!! Form::text('phone1',null,[
                          'class' => 'form-control',
                        ]) !!}
                    </div>
                    <div class="form-group">
                        <label for="inputProjectLeader">{{__('lang.phone2')}}</label>
                        {!! Form::text('phone2',null,[
                          'class' => 'form-control',
                        ]) !!}
                    </div>
                    <div class="form-group">
                        <label for="inputProjectLeader">{{__('lang.district')}}</label>
                        {{ Form::select('district_id', $district, null, array('class'=>'form-control select2', 'placeholder'=>'الحى')) }}
                    </div>
                    <div class="form-group">
                        <label for="about">{{__('lang.about')}}</label>
                        {!! Form::textarea('about',null,[
                          'class' => 'form-control',
                    ]) !!}
                    </div>

                    <div class="form-group">
                        <label for="address">{{__('lang.address')}}</label>
                        {!! Form::text('address',null,[
                          'class' => 'form-control',
                          'id'    => 'pac-input',
                        ]) !!}
                    </div>

                    <div id="map" style="height: 500px;width: 690px;"></div>

                    <div class="form-group mb-0">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="terms" class="custom-control-input check" id="exampleCheck1">
                            <label class="custom-control-label" for="exampleCheck1">I agree to the <a href="#"
                                                                                                      data-toggle="modal"
                                                                                                      data-target="#modal-lg">terms
                                    of service</a>.</label>
                        </div>
                    </div>

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <div class="col-md-6">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">استكمال البيانات</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="inputEstimatedBudget">{{__('lang.name_authorized')}} </label>
                        {!! Form::text('name_authorized',null,[
                          'class' => 'form-control',
                        ]) !!}
                    </div>
                    <div class="form-group">
                        <label for="inputEstimatedBudget">{{__('lang.authorized_mobile')}} </label>
                        {!! Form::text('authorized_mobile',null,[
                          'class' => 'form-control',
                        ]) !!}
                    </div>
                    <div class="form-group">
                        <label for="inputEstimatedBudget">{{__('lang.legal_name')}} </label>
                        {!! Form::text('legal_name',null,[
                          'class' => 'form-control',
                        ]) !!}
                    </div>
                    <div class="form-group">
                        <label for="inputEstimatedBudget">{{__('lang.email')}} </label>
                        {!! Form::text('email',null,[
                          'class' => 'form-control',
                        ]) !!}
                    </div>
                    <div class="form-group">
                        <label for="inputEstimatedBudget">{{__('lang.minimum_order')}} </label>
                        {!! Form::text('minimum_order',null,[
                          'class' => 'form-control',
                        ]) !!}
                    </div>
                    <div class="form-group">
                        <label for="inputSpentBudget">{{__('lang.company_register')}}</label>
                        {!! Form::text('company_register',null,[
                          'class' => 'form-control',
                        ]) !!}
                    </div>
                    <div class="form-group">
                        <label for="inputSpentBudget">{{__('lang.num_tax')}}</label>
                        {!! Form::text('num_tax',null,[
                          'class' => 'form-control',
                        ]) !!}
                    </div>
                    <div class="form-group">
                        <label for="inputSpentBudget">{{__('lang.delivery')}}</label>
                        {!! Form::text('delivery_price',null,[
                         'class' => 'form-control',
                        ]) !!}
                    </div>

                    <div class="form-group">
                        <label for="inputSpentBudget">{{__('lang.phoneWhats')}}</label>
                        {!! Form::text('whatsapp',null,[
                          'class' => 'form-control',
                        ]) !!}
                    </div>

                    <div class="form-group">
                        <label for="inputSpentBudget">{{__('lang.facebook')}}</label>
                        {!! Form::text('facebook',null,[
                           'class' => 'form-control',
                        ]) !!}
                    </div>

                    <div class="form-group">
                        <label for="inputProjectLeader">{{__('lang.site')}}</label>
                        {!! Form::text('site',null,[
                            'class' => 'form-control',
                        ]) !!}
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label>From</label>
                                {!! Form::time('start_time',null,[
                                    'class' => 'form-control',
                                ]) !!}
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label>To</label>
                                {!! Form::time('end_time',null,[
                                    'class' => 'form-control',
                                ]) !!}
                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="inputProjectLeader">{{__('lang.ratio')}}</label>
                            <select class="form-control select2" name="ratio">
                                <option value="1">عادى</option>
                                <option value="2">صفرى</option>
                                <option value="3">بلاتينى</option>
                                <option value="4">فضى</option>
                                <option value="5">ذهبى</option>
                                <option value="6">الماسى</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label style="color:#000;font-size: 15px; display:block" class="label"> Day Of Work </label>
                        <label style="margin-top: 8px;font-weight: bold"><input type="checkbox" id="select_all"/> اختيار
                            الكل</label>

                        <?php
                        if (!empty($records)) {
                            $listDay[] = json_decode($records->day_work);
                            foreach ($listDay[0] as $key => $value) {
                                $result[] = $value;
                            }
                        }
                        ?>

                        <div class="row">
                            <div class="col-sm-3 col-lg-2">
                                <div class="checkbox">
                                    <label>
                                        <input
                                            @if(!empty($records))
                                            @if(in_array('Saturday', $result)) checked @endif
                                            @endif
                                            type="checkbox" name="day[]" value="Saturday"> السبت
                                    </label>
                                </div>
                            </div>

                            <div class="col-sm-3 col-lg-2">
                                <div class="checkbox">
                                    <label>
                                        <input
                                            @if(!empty($records))
                                            @if(in_array('Sunday', $result)) checked @endif
                                            @endif
                                            type="checkbox" name="day[]"
                                            value="Sunday"> الأحد
                                    </label>
                                </div>
                            </div>

                            <div class="col-sm-3 col-lg-2">
                                <div class="checkbox">
                                    <label>
                                        <input
                                            @if(!empty($records))
                                            @if(in_array('Monday', $result)) checked @endif
                                            @endif
                                            type="checkbox"
                                            name="day[]" value="Monday"> الإثنين
                                    </label>
                                </div>
                            </div>

                            <div class="col-sm-3 col-lg-2">
                                <div class="checkbox">
                                    <label>
                                        <input
                                            @if(!empty($records))
                                            @if(in_array('Tuesday', $result)) checked @endif
                                            @endif
                                        type="checkbox"
                                               name="day[]" value="Tuesday"> الثلاثاء
                                    </label>
                                </div>
                            </div>

                            <div class="col-sm-3 col-lg-2">
                                <div class="checkbox">
                                    <label>
                                        <input
                                            @if(!empty($records))
                                            @if(in_array('Wednesday', $result)) checked @endif
                                            @endif
                                        type="checkbox"
                                               name="day[]" value="Wednesday"> الأربعاء
                                    </label>
                                </div>
                            </div>

                            <div class="col-sm-3 col-lg-2">
                                <div class="checkbox">
                                    <label>
                                        <input
                                            @if(!empty($records))
                                            @if(in_array('Thursday', $result)) checked @endif
                                            @endif
                                        type="checkbox"
                                               name="day[]" value="Thursday"> الخميس
                                    </label>
                                </div>
                            </div>

                            <div class="col-sm-3 col-lg-2">
                                <div class="checkbox">
                                    <label>
                                        <input
                                            @if(!empty($records))
                                            @if(in_array('Friday', $result)) checked @endif
                                            @endif
                                        type="checkbox"
                                               name="day[]" value="Friday"> الجمعه
                                    </label>
                                </div>
                            </div>
                        </div>


                    </div>


                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label style="color:#000;font-size: 15px;padding-bottom: 15px"
                                       class="label">{{__('lang.logo')}} </label>

                                <label for="logoInp" class="btn btn-success col fileinput-button">
                                    <i class="fas fa-plus"></i>
                                    <span>Add files</span>
                                </label>

                                <input for="imgInp" style="display: none" name="logo" type='file' id="logoInp"/>
                                <img
                                    style="width: 220px; height:220px; margin-top: 12px;border: 1px solid #000000; display: none"
                                    id="logo" src="#" alt="your image"/>

                                @if(!empty($records->logo))
                                    <img id="logo_old"
                                         style="width: 220px;height:220px; margin-top: 12px;border: 1px solid #000000"
                                         src="{{asset($records->getOriginal('logo'))}}">
                                @else
                                    <img id="logoNoImage"
                                         style="width: 220px;margin-top: 12px;border: 1px solid #000000"
                                         src="{{ asset('public/storage/images/no_image.png') }}">
                                @endif
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label style="color:#000;font-size: 15px;padding-bottom: 15px"
                                       class="label">{{__('lang.cover')}} </label>

                                <label for="coverInp" class="btn btn-success col fileinput-button">
                                    <i class="fas fa-plus"></i>
                                    <span>Add files</span>
                                </label>

                                <input for="imgInp" style="display: none" name="cover" type='file' id="coverInp"/>
                                <img
                                    style="width: 220px; height:220px; margin-top: 12px;border: 1px solid #000000; display: none"
                                    id="cover" src="#" alt="your image"/>

                                @if(!empty($records->cover))
                                    <img id="cover_old"
                                         style="width: 220px;height:220px; margin-top: 12px;border: 1px solid #000000"
                                         src="{{asset($records->getOriginal('cover'))}}">
                                @else
                                    <img id="coverNoImage"
                                         style="width: 220px;margin-top: 12px;border: 1px solid #000000"
                                         src="{{ asset('public/storage/images/no_image.png') }}">
                                @endif
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label style="color:#000;font-size: 15px;padding-bottom: 15px"
                                       class="label">{{__('lang.picture_contract')}} </label>
                                <label for="contractInp" class="btn btn-success col fileinput-button">
                                    <i class="fas fa-plus"></i>
                                    <span>Add files</span>
                                </label>

                                <input for="contractInp" style="display: none" name="picture_contract" type='file'
                                       id="contractInp"/>
                                <img
                                    style="width: 220px;height:220px;margin-top: 12px;border: 1px solid #000000; display: none"
                                    id="contract" src="#" alt="your image"/>


                                @if(!empty($records->picture_contract))
                                    <img id="contract_old"
                                         style="width: 220px; height:220px;margin-top: 12px;border: 1px solid #000000"
                                         src="{{ asset($records->getOriginal('picture_contract')) }}">
                                @else
                                    <img id="contractNoImage"
                                         style="width: 220px;margin-top: 12px;border: 1px solid #000000"
                                         src="{{ asset('public/storage/images/no_image.png') }}">
                                @endif

                            </div>
                        </div>
                    </div>

                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <div class="col-md-12">

        </div>

    </div>
</section>
<!-- /.content -->

<!-- /.modal -->

<!-- /.modal -->
@push('script')

    <script>
        // Select all
        $('#select_all').click(function () {
            $('input[type=checkbox]').prop('checked', $(this).prop('checked'));
        });
    </script>

@endpush
