@inject('model','App\Car')
@inject('category','App\Category')
@inject('brand','App\Brand')
@inject('client','App\Client')
<style>
    .image-upload>input {
        display: none;
    }
</style>
<?php
$ins = \App\Store::first();
$category = $category->pluck('name', 'id')->toArray();
$brand = $brand->pluck('name', 'id')->toArray();
$client = $client->pluck('full_name', 'id')->toArray();

?>

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
                        <label for="inputDescription">{{__('lang.client')}}</label>
                        {{ Form::select('client_id', $client, null, array('class' => 'form-control select2', 'placeholder'=>'صاحب السياره')) }}
                    </div>

                    <div class="form-group">
                        <label for="inputName">{{__('lang.number')}}</label>
                        {!! Form::text('number',null,[
                      'class' => 'form-control',
                    ]) !!}
                    </div>

                    <div class="form-group">
                        <label for="inputName">{{__('lang.stc_pay')}}</label>
                        {!! Form::text('stc_pay',null,[
                      'class' => 'form-control',
                    ]) !!}
                    </div>

                    <div class="form-group">
                        <label for="inputDescription">{{__('lang.Type_car')}}</label>
                        <select name="Type_car" class="form-control select2">
                            <option value="1">صغيره سيدان</option>
                            <option value="2">بكب صغيره</option>
                            <option value="3">بكب كبيره</option>
                            <option value="4">دينا</option>
                            <option value="5">سطحه</option>
                            <option value="6">شاحنة</option>
                            <option value="7">قلاب</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="inputProjectLeader">{{__('lang.brand_car')}}</label>
                        {{ Form::select('brand_id', $brand, null, array('class'=>'form-control select2', 'placeholder'=>'البراند')) }}
                    </div>

                    <div class="form-group">
                        <label for="inputEstimatedBudget">{{__('lang.car_model')}} </label>
                        {!! Form::text('car_model',null,[
                          'class' => 'form-control',
                        ]) !!}
                    </div>

                    <div class="form-group">
                        <label for="inputEstimatedBudget">{{__('lang.stc_pay')}} </label>
                        {!! Form::text('stc_pay',null,[
                          'class' => 'form-control',
                        ]) !!}
                    </div>

                    <div class="form-group">
                        <label for="inputEstimatedBudget">{{__('lang.char_car')}} </label>
                        {!! Form::text('char_car',null,[
                          'class' => 'form-control',
                        ]) !!}
                    </div>

                    <div class="form-group mb-0">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="terms" class="custom-control-input check" id="exampleCheck1">
                            <label class="custom-control-label" for="exampleCheck1">I agree to the <a href="#" data-toggle="modal" data-target="#modal-lg">terms of service</a>.</label>
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

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label style="color:#000;font-size: 15px;padding-bottom: 15px" class="label">{{__('lang.driver_license')}} </label>

                                <label for="driver_licenseInp" class="btn btn-success col fileinput-button">
                                    <i class="fas fa-plus"></i>
                                    <span>Add files</span>
                                </label>

                                <input for="imgInp"  style="display: none" name="driver_license" type='file' id="driver_licenseInp" />
                                <img style="width: 220px; height:220px; margin-top: 12px;border: 1px solid #000000; display: none" id="driver_license" src="#" alt="your image" />

                                @if(!empty($records->driver_license))
                                    <img id="driver_license_old" style="width: 220px;height:220px; margin-top: 12px;border: 1px solid #000000" src="{{asset($records->getOriginal('driver_license'))}}">
                                @else
                                    <img id="driver_licenseNoImage" style="width: 220px;margin-top: 12px;border: 1px solid #000000"
                                         src="{{ asset('public/storage/images/no_image.png') }}">
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label style="color:#000;font-size: 15px;padding-bottom: 15px" class="label">{{__('lang.car_license')}} </label>
                                <label for="car_licenseInp" class="btn btn-success col fileinput-button">
                                    <i class="fas fa-plus"></i>
                                    <span>Add files</span>
                                </label>

                                <input for="car_licenseInp"  style="display: none" name="car_license" type='file' id="car_licenseInp" />
                                <img style="width: 220px;height:220px;margin-top: 12px;border: 1px solid #000000; display: none" id="car_license" src="#" alt="your image" />


                                @if(!empty($records->car_license))
                                    <img id="contract_old" style="width: 220px; height:220px;margin-top: 12px;border: 1px solid #000000" src="{{ asset($records->getOriginal('car_license')) }}">
                                @else
                                    <img id="car_licenseNoImage" style="width: 220px;margin-top: 12px;border: 1px solid #000000"
                                         src="{{ asset('public/storage/images/no_image.png') }}">
                                @endif

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label style="color:#000;font-size: 15px;padding-bottom: 15px" class="label">{{__('lang.image_car_back')}} </label>

                                <label for="image_car_backInp" class="btn btn-success col fileinput-button">
                                    <i class="fas fa-plus"></i>
                                    <span>Add files</span>
                                </label>

                                <input for="image_car_backInp"  style="display: none" name="image_car_back" type='file' id="image_car_backInp" />
                                <img style="width: 220px; height:220px; margin-top: 12px;border: 1px solid #000000; display: none" id="image_car_back" src="#" alt="your image" />

                                @if(!empty($records->image_car_back))
                                    <img id="image_car_back_old" style="width: 220px;height:220px; margin-top: 12px;border: 1px solid #000000" src="{{asset($records->getOriginal('image_car_back'))}}">
                                @else
                                    <img id="image_car_backNoImage" style="width: 220px;margin-top: 12px;border: 1px solid #000000"
                                         src="{{ asset('public/storage/images/no_image.png') }}">
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label style="color:#000;font-size: 15px;padding-bottom: 15px" class="label">{{__('lang.image_car_front')}} </label>
                                <label for="image_car_frontInp" class="btn btn-success col fileinput-button">
                                    <i class="fas fa-plus"></i>
                                    <span>Add files</span>
                                </label>

                                <input for="image_car_frontInp"  style="display: none" name="image_car_front" type='file' id="image_car_frontInp" />
                                <img style="width: 220px;height:220px;margin-top: 12px;border: 1px solid #000000; display: none" id="image_car_front" src="#" alt="your image" />


                                @if(!empty($records->image_car_front))
                                    <img id="image_car_front_old" style="width: 220px; height:220px;margin-top: 12px;border: 1px solid #000000" src="{{ asset($records->getOriginal('image_car_front')) }}">
                                @else
                                    <img id="image_car_frontNoImage" style="width: 220px;margin-top: 12px;border: 1px solid #000000"
                                         src="{{ asset('public/storage/images/no_image.png') }}">
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label style="color:#000;font-size: 15px;padding-bottom: 15px" class="label">{{__('lang.personal_id')}} </label>
                                <label for="personal_idInp" class="btn btn-success col fileinput-button">
                                    <i class="fas fa-plus"></i>
                                    <span>Add files</span>
                                </label>

                                <input for="personal_idInp"  style="display: none" name="personal_id" type='file' id="personal_idInp" />
                                <img style="width: 220px;height:220px;margin-top: 12px;border: 1px solid #000000; display: none" id="personal_id" src="#" alt="your image" />


                                @if(!empty($records->personal_id))
                                    <img id="personal_id_old" style="width: 220px; height:220px;margin-top: 12px;border: 1px solid #000000" src="{{ asset($records->getOriginal('personal_id')) }}">
                                @else
                                    <img id="personal_idNoImage" style="width: 220px;margin-top: 12px;border: 1px solid #000000"
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
    </div>
</section>
<!-- /.content -->

<!-- /.modal -->

<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">terms of service</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
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
