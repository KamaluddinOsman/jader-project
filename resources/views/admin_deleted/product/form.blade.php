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
$category = $category->pluck('name', 'id')->toArray();
$district = $district->pluck('name', 'id')->toArray();
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
                        <label for="inputName">{{__('lang.name')}}</label>
                        {!! Form::text('name',null,[
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
                        ]) !!}
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="inputClientCompany">{{__('lang.phone')}} </label>
                        <input type="text" name="phone1" class="form-control" data-inputmask='"mask": "(99) 99999999999"' data-mask>
{{--                        {!! Form::text('phone1',null,[--}}
{{--                          'class' => 'form-control',--}}
{{--                          'data-inputmask' => '"mask": "(999) 999-9999"',--}}
{{--                        ]) !!}--}}
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
                        <label for="inputProjectLeader">{{__('lang.about')}}</label>
                        {!! Form::textarea('about',null,[
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
                    <div class="form-group">
                        <label for="inputProjectLeader">{{__('lang.address')}}</label>
                        {!! Form::text('address',null,[
                            'class' => 'form-control',
                        ]) !!}
                    </div>
                    <div class="form-group">
                        <label style="color:#000;font-size: 15px;padding-bottom: 15px" class="label">{{__('lang.logo')}} </label>
                            @if(!empty($records->logo))
                                <img style="width: 220px;margin-top: 12px;border: 1px solid #000000" src="{{ asset($records->logo) }}">
                            @else
                                <img style="width: 220px;margin-top: 12px;border: 1px solid #000000"
                                     src="{{ asset('image/store/noImage.jpg') }}">
                            @endif

                        <label for="imgInp" class="btn btn-success col fileinput-button">
                            <i class="fas fa-plus"></i>
                            <span>Add files</span>
                        </label>


                        <input name="logo" style="display: none" type="file" id="imgInp">

                        <img id="blah" src="#" alt="your image" style="display: none" />


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
