@extends('dashboard.layouts.main')
@inject('model','App\Car')
@inject('category','App\Category')
@inject('brand','App\Brand')
@inject('client','App\Client')

@section('head')
    @section('page-title')
            {{__('car.addCar')}} | {{ __('auth.bageTitle') }}
    @endsection
@endsection


<?php
    $ins = \App\Store::first();
    $category = $category->pluck('name', 'id')->toArray();
    $brand = $brand->pluck('name', 'id')->toArray();
    $client = $client->pluck('full_name', 'id')->toArray();
?>

@section('content')
    <div class="page-content">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">{{ __('car.addCar') }}</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">{{ __('dashboard.dashboard') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('car.addCar') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

        @include('dashboard.layouts.flash-message')
        @include('flash::message')

        <div class="row">
            <div class="col-xl-12">
                {!! Form::model($model,['action' => 'Dashboard\CarController@store','enctype' => 'multipart/form-data']) !!}
                    <div class="card">
                        <div class="card-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#home" role="tab">
                                        <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                        <span class="d-none d-sm-block">
                                            بيانات عامة
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#profile" role="tab">
                                        <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                        <span class="d-none d-sm-block">استكمال البيانات</span>
                                    </a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content p-3 text-muted">
                                <div class="tab-pane active" id="home" role="tabpanel">
                                    <div class="card-body">
                                        
                                        <div class="mb-3 row">
                                            <label for="inputDescription" class="col-md-2 col-form-label">{{__('car.clientColumn')}}</label>
                                            <div class="col-md-8">
                                                {{ Form::select('client_id', $client, null, array('class' => 'form-control form-select select2', 'placeholder'=>'صاحب السياره')) }}
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label for="inputName" class="col-md-2 col-form-label">{{__('car.numberColumn')}}</label>
                                            <div class="col-md-8">
                                                {!! Form::text('number',null,['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                    
                                        <div class="mb-3 row">
                                            <label for="inputName" class="col-md-2 col-form-label">{{__('car.stcPayColumn')}}</label>
                                            <div class="col-md-8">
                                                {!! Form::text('stc_pay',null,['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                    
                                        <div class="mb-3 row">
                                            <label for="inputDescription" class="col-md-2 col-form-label">{{__('car.carTypeColumn')}}</label>
                                            <div class="col-md-8">
                                                <select name="Type_car" class="form-control form-select select2">
                                                    <option value="1">صغيره سيدان</option>
                                                    <option value="2">بكب صغيره</option>
                                                    <option value="3">بكب كبيره</option>
                                                    <option value="4">دينا</option>
                                                    <option value="5">سطحه</option>
                                                    <option value="6">شاحنة</option>
                                                    <option value="7">قلاب</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label for="inputProjectLeader" class="col-md-2 col-form-label">{{__('car.carBrandColumn')}}</label>
                                            <div class="col-md-8">
                                                {{ Form::select('brand_id', $brand, null, array('class'=>'form-control form-select select2', 'placeholder'=>'البراند')) }}
                                            </div>
                                        </div>
                    
                                        <div class="mb-3 row">
                                            <label for="inputEstimatedBudget" class="col-md-2 col-form-label">{{__('car.carModelColumn')}} </label>
                                            <div class="col-md-8">
                                                {!! Form::text('car_model',null,['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                    
                                        <div class="mb-3 row">
                                            <label for="inputEstimatedBudget" class="col-md-2 col-form-label">{{__('car.stcPayColumn')}} </label>
                                            <div class="col-md-8">
                                                {!! Form::text('stc_pay',null,['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                    
                                        <div class="mb-3 row">
                                            <label for="inputEstimatedBudget" class="col-md-2 col-form-label">{{__('car.charCarColumn')}} </label>
                                            <div class="col-md-8">
                                                {!! Form::text('char_car',null,['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>

                                <div class="tab-pane" id="profile" role="tabpanel">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="card card-body">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h3 class="card-title mt-0">{{__('car.driverLicense')}}</h3>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <input type="file" id="driver_licenseInp" class="form-control" for="imgInp" name="driver_license" style="display: none"/>
                                                            <img class="rounded mx-auto img-thumbnail" style="display: none; max-width: 350px;max-height: 400px;" id="driver_license" src="#" alt="your image" />
                                                            
                                                            @if(!empty($records->driver_license))
                                                                <img id="driver_license_old" class="rounded mx-auto img-thumbnail" src="{{asset($records->getOriginal('driver_license'))}}">
                                                            @else
                                                                <img id="driver_licenseNoImage" class="rounded mx-auto img-thumbnail" src="{{ asset('img/no_image.png') }}">
                                                            @endif
                                                        </div>
                                                    </div>                                                
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="input-group">
                                                                <label class="btn btn-success col fileinput-button" for="driver_licenseInp">
                                                                    <i class="fas fa-plus"></i>
                                                                    <span>{{ __('car.addFile') }}</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="card card-body">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h3 class="card-title mt-0">{{__('car.carLicense')}}</h3>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <input type="file" id="car_licenseInp" class="form-control" for="car_licenseInp" name="car_license" style="display: none"/>
                                                            <img class="rounded mx-auto img-thumbnail" style="display: none; max-width: 350px;max-height: 400px;" id="car_license" src="#" alt="your image" />

                                                            @if(!empty($records->car_license))
                                                                <img id="car_license_old" class="rounded mx-auto img-thumbnail" src="{{ asset($records->getOriginal('car_license')) }}">
                                                            @else
                                                                <img id="car_licenseNoImage" class="rounded mx-auto img-thumbnail" src="{{ asset('img/no_image.png') }}">
                                                            @endif
                                                            
                                                        </div>
                                                    </div>                                                
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="input-group">
                                                                <label class="btn btn-success col fileinput-button" for="car_licenseInp">
                                                                    <i class="fas fa-plus"></i>
                                                                    <span>{{ __('car.addFile') }}</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                    
                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="card card-body">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h3 class="card-title mt-0">{{ __('car.carBackImage') }}</h3>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <input type="file" id="image_car_backInp" class="form-control" for="image_car_backInp" name="image_car_back" style="display: none"/>
                                                            <img class="rounded mx-auto img-thumbnail" style="display: none; max-width: 350px;max-height: 400px;" id="image_car_back" src="#" alt="your image" />

                                                            @if(!empty($records->image_car_back))
                                                                <img id="image_car_back_old" class="rounded mx-auto img-thumbnail" src="{{ asset($records->getOriginal('image_car_back')) }}">
                                                            @else
                                                                <img id="image_car_backNoImage" class="rounded mx-auto img-thumbnail" src="{{ asset('img/no_image.png') }}">
                                                            @endif                                                            
                                                        </div>
                                                    </div>                                                
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="input-group">
                                                                <label class="btn btn-success col fileinput-button" for="image_car_backInp">
                                                                    <i class="fas fa-plus"></i>
                                                                    <span>{{ __('car.addFile') }}</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="card card-body">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h3 class="card-title mt-0">{{ __('car.carFrontImage') }}</h3>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <input type="file" id="image_car_frontInp" class="form-control" for="image_car_frontInp" name="image_car_front" style="display: none"/>                    
                                                            <img class="rounded mx-auto img-thumbnail" style="display: none; max-width: 350px;max-height: 400px;" id="image_car_front" src="#" alt="your image" />

                                                            @if(!empty($records->image_car_front))
                                                                <img id="image_car_front_old" class="rounded mx-auto img-thumbnail" src="{{ asset($records->getOriginal('image_car_front')) }}">
                                                            @else
                                                                <img id="image_car_frontNoImage" class="rounded mx-auto img-thumbnail" src="{{ asset('img/no_image.png') }}">
                                                            @endif
                                                        </div>
                                                    </div>                                                
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="input-group">
                                                                <label class="btn btn-success col fileinput-button" for="image_car_frontInp">
                                                                    <i class="fas fa-plus"></i>
                                                                    <span>{{ __('car.addFile') }}</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="card card-body">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h3 class="card-title mt-0">{{ __('car.personalId') }}</h3>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <input type="file" id="personal_idInp" class="form-control" for="personal_idInp" name="personal_id" style="display: none"/>                                        
                                                            <img class="rounded mx-auto img-thumbnail" style="display: none; max-width: 350px;max-height: 400px;" id="personal_id" src="#" alt="your image" />

                                                            @if(!empty($records->personal_id))
                                                                <img id="personal_id_old" class="rounded mx-auto img-thumbnail" src="{{ asset($records->getOriginal('personal_id')) }}">
                                                            @else
                                                                <img id="personal_idNoImage" class="rounded mx-auto img-thumbnail" src="{{ asset('img/no_image.png') }}">
                                                            @endif
                                                        </div>
                                                    </div>                                                
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="input-group">
                                                                <label class="btn btn-success col fileinput-button" for="personal_idInp">
                                                                    <i class="fas fa-plus"></i>
                                                                    <span>{{ __('car.addFile') }}</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                    
                                        <!-- /.card-body -->
                                    </div>
                                    <!-- /.card -->
                                    <div class="form-group mb-0">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="terms" class="custom-control-input check" id="exampleCheck1">
                                            <label class="custom-control-label" for="exampleCheck1">I agree to the <a href="#" data-bs-toggle="modal" data-bs-target="#modal-lg">terms of service</a>.</label>
                                        </div>
                                    </div>
                                    <div class="form-group text-center">
                                        <button class="btn btn-primary submit-btn" disabled type="submit">{{__('car.addCar')}}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">terms of service</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                   <p>
                       (1) مقدمة :
    
                       أهلاً بكم مع   كل شئ دوت كوم ، فيما يلي البنود والشروط التي تخص إستخدامك و دخولك لصفحات موقع "  كل شئ دوت كوم"  وكافة الصفحات و الروابط والأدوات والخواص المتفرعة عنها. إن إستخدامك لموقع   كل شئ دوت كوم هو موافقة منك على القبول ببنود وشروط هذه الإتفاقية والذي يتضمن كافة التفاصيل أدناه وهو تأكيد لإلتزامك بالاستجابة لمضمون هذه الإتفاقية الخاصة بشركة "  كل شئ دوت كوم" والمشار إليه فيما يلي بإسم "نحن" والمشار إليه إيضا بـ"  كل شئ دوت كوم"، فيما يتعلق باستخدامك للموقع، والمشار إليه فيما يلي بـ "اتفاقية الإستخدام " وتعتبر هذه الإتفاقية سارية المفعول حال قبولك بخيار الموافقة
                   </p>
                    <p>
                        (2) التأهل للعضوية :
    
                        1.تمنح عضوية الموقع فقط لمن تجازوت أعمارهم 18 عام . و لموقع   كل شئ دوت كوم الحق بإلغاءحساب أي عضو لم يبلغ الـ 18 عام مع الإلتزام بتصفية حساباته المالية فور إغلاق الحساب
                    </p>
                    <p>
                        2.لا يحق لأي شخص إستخدام الموقع إذا ألغيت عضويته من   كل شئ دوت كوم.
                    </p>
                    <p>
                        3.في حال قيام أي مستخدم بالتسجيل كمؤسسة تجارية، فإن مؤسسته التجارية تكون ملزمة بكافة والشروط الواردة في هذه الإتفاقية.
                    </p>
                    <p>
                        4.ينبغي عليك الإلتزام بكافة القوانين المعمول بها لتنظيم التجارة عبر الانترنت.
                    </p>
                    <p>
                        5.لا يحق لأي عضو أو مؤسسة أن تقوم بفتح حسابين بآن واحد لأي سبب كان، ولإدارة الموقع الحق بتجميد الحسابين أو إلغاء أحدهما مع الإلتزام بتصفية كافة العمليات المالية المتعلقة بالحساب قبل إغلاقه.
                    </p>
                    <p>
                        6.على المستخدمي أفراد و مؤسسات الإلتزام بالعقود التجارية المبرمة مع الأعضاء.
                    </p>
                    <p>
                        7.لا يحق لأي عضو بالموقع شراء معروضات ممنوعة أو مشبوهة أو مسروقة أو تخالف القوانين المعمول بها بوزارات و هيئات مؤسسات التجارة المحلية الحكومية، وفي حال ثبوت ذلك فهو يضع نفسه ضمن طائلة المسؤولية الشخصية بدون أدنى مسؤولية على   كل شئ دوت كوم
                    </p>
                </div>
    
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    
@endsection
@section('scripts')
    <script>
        $('.check').on('click', function() {
            console.log("###")
            if($('.submit-btn').attr('disabled')) {
                $('.submit-btn').removeAttr('disabled');
            }else {
                $('.submit-btn').attr('disabled', true);

            }
        })

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $(input).next('img').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        $("#logoInp").change(function() {
            $('#logoNoImage').css('display','none');
            $('#logo_old').css('display','none');
            $('#logo').css('display','block');
            readURL(this);
        });
    //--------------------------------------------------------------

        $("#coverInp").change(function() {
            $('#coverNoImage').css('display','none');
            $('#cover_old').css('display','none');
            $('#cover').css('display','block');
            readURL(this);
        });
    //--------------------------------------------------------------

        $("#contractInp").change(function() {
            $('#contractNoImage').css('display','none');
            $('#contract_old').css('display','none');
            $('#contract').css('display','block');
            readURL(this);
        });
        //--------------------------------------------------------------

        $("#driver_licenseInp").change(function() {
            $('#driver_licenseNoImage').css('display','none');
            $('#driver_license_old').css('display','none');
            $('#driver_license').css('display','block');
            readURL(this);
            console.log(readURL(this));
            console.log($("#driver_licenseInp").val())
        });

        //--------------------------------------------------------------

        $("#car_licenseInp").change(function() {
            $('#car_licenseNoImage').css('display','none');
            $('#car_license_old').css('display','none');
            $('#car_license').css('display','block');
            readURL(this);
        });

    //--------------------------------------------------------------

        $("#personal_idInp").change(function() {
            $('#personal_idNoImage').css('display','none');
            $('#personal_id_old').css('display','none');
            $('#personal_id').css('display','block');
            readURL(this);
        });

        //--------------------------------------------------------------

        $("#image_car_frontInp").change(function() {
            $('#image_car_frontNoImage').css('display','none');
            $('#image_car_front_old').css('display','none');
            $('#image_car_front').css('display','block');
            readURL(this);
        });

        //--------------------------------------------------------------

        $("#personal_idInp").change(function() {
            $('#personal_idNoImage').css('display','none');
            $('#personal_id_old').css('display','none');
            $('#personal_id').css('display','block');
            readURL(this);
        });

    //--------------------------------------------------------------

        $("#image_car_backInp").change(function() {
            $('#image_car_backNoImage').css('display','none');
            $('#image_car_back_old').css('display','none');
            $('#image_car_back').css('display','block');
            readURL(this);
        });

        //--------------------------------------------------------------

        $("#imageInp").change(function() {
            $('#imageNoImage').css('display','none');
            $('#image_old').css('display','none');
            $('#image').css('display','block');
            readURL(this);
        });
    </script>
    
@endsection