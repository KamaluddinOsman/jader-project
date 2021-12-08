@inject('model','App\Store')
@inject('category','App\Category')
@inject('city','App\City')
@inject('client','App\Client')
<style>
    .image-upload > input {
        display: none;
    }
</style>
<?php
$ins = \App\Store::first();
$category = $category->pluck('name', 'id')->toArray();
$city = $city->pluck('name', 'id')->toArray();
$client = $client->Active()->pluck('full_name', 'id')->toArray();
?>

<input type="hidden" value="" id="latitude" name="late">
<input type="hidden" value="" id="longitude" name="lang">
<div class="row">
    <div class="col-xl-12">
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
                                <label for="inputName" class="col-md-2 col-form-label">{{__('institution.institutionName')}}</label>
                                <div class="col-md-8">
                                    {!! Form::text('name',null,['class' => 'form-control']) !!}
                                </div>
                            </div>
                            
                            <div class="mb-3 row">
                                <label for="inputName" class="col-md-2 col-form-label">{{__('institution.responsibleName')}}</label>
                                <div class="col-md-8">
                                    {!! Form::text('name_responsible',null,['class' => 'form-control']) !!}
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="inputName" class="col-md-2 col-form-label">{{__('institution.responsiblePosition')}}</label>
                                <div class="col-md-8">
                                    {!! Form::text('responsible_position',null,['class' => 'form-control']) !!}
                                </div>
                            </div>
                            
                            <div class="mb-3 row">
                                <label for="inputName" class="col-md-2 col-form-label">{{__('institution.responsibleMobile')}}</label>
                                <div class="col-md-8">
                                    {!! Form::text('responsible_mobile',null,['class' => 'form-control']) !!}
                                </div>
                            </div>
                            
                            <div class="mb-3 row">
                                <label for="inputDescription" class="col-md-2 col-form-label">{{__('institution.institutionClients')}}</label>
                                <div class="col-md-8">
                                    {{ Form::select('client_id', $client, null, array('class' => 'form-control form-select select2', 'placeholder'=>'صاحب المنشأة')) }}
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="inputDescription" class="col-md-2 col-form-label">{{__('institution.institutionCategory')}}</label>
                                <div class="col-md-8">
                                    {!! Form::select('category_id',$category,null,['class' => 'form-control form-select select2','id'    => 'category']) !!}
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="inputDescription" class="col-md-2 col-form-label">{{__('institution.specialCategory')}}</label>
                                <div class="col-md-8 select2-purple">
                                    <select id="childCategory" class="form-control form-select select2" name="childCategory[]" multiple="multiple" data-placeholder="فئات مخصصة" data-dropdown-css-class="select2-purple" style="width: 100%;">
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="inputName" class="col-md-2 col-form-label">{{__('institution.institutionPhone1')}}</label>
                                <div class="col-md-8">
                                    {!! Form::text('phone1',null,['class' => 'form-control']) !!}
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="inputName" class="col-md-2 col-form-label">{{__('institution.institutionPhone2')}}</label>
                                <div class="col-md-8">
                                    {!! Form::text('phone2',null,['class' => 'form-control']) !!}
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="inputDescription" class="col-md-2 col-form-label">{{__('institution.institutionCity')}}</label>
                                <div class="col-md-8">
                                    {{ Form::select('city_id', $city, null, array('class'=>'form-control form-select select2', 'placeholder'=>'الحى')) }}
                                </div>
                            </div>

                            <div class="mt-3 row">
                                <label class="col-md-2 col-form-label">{{__('institution.institutionAbout')}}</label>
                                <div class="col-md-8">
                                    {!! Form::textarea('about',null,['class' => 'form-control']) !!}
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="inputName" class="col-md-2 col-form-label">{{__('institution.institutionAddress')}}</label>
                                <div class="col-md-8">
                                    {!! Form::text('address',null,['class' => 'form-control','id'=> 'pac-input']) !!}
                                    <div id="map" style="height: 300px;width: 100%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="profile" role="tabpanel">
                        <div class="card-body">
                            <div class="mb-3 row">
                                <label for="inputName" class="col-md-2 col-form-label">{{__('institution.authorizedName')}}</label>
                                <div class="col-md-8">
                                    {!! Form::text('name_authorized',null,['class' => 'form-control']) !!}
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="inputName" class="col-md-2 col-form-label">{{__('institution.authorizedMobile')}}</label>
                                <div class="col-md-8">
                                    {!! Form::text('authorized_mobile',null,['class' => 'form-control']) !!}
                                </div>
                            </div>
                            
                            <div class="mb-3 row">
                                <label for="inputName" class="col-md-2 col-form-label">{{__('institution.legalName')}}</label>
                                <div class="col-md-8">
                                    {!! Form::text('legal_name',null,['class' => 'form-control']) !!}
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="inputName" class="col-md-2 col-form-label">{{__('institution.institutionEmail')}}</label>
                                <div class="col-md-8">
                                    {!! Form::text('email',null,['class' => 'form-control']) !!}
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="inputName" class="col-md-2 col-form-label">{{__('institution.minOrder')}}</label>
                                <div class="col-md-8">
                                    {!! Form::text('minimum_order',null,['class' => 'form-control']) !!}
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="inputName" class="col-md-2 col-form-label">{{__('institution.commercialRegisterNumber')}}</label>
                                <div class="col-md-8">
                                    {!! Form::text('company_register',null,['class' => 'form-control']) !!}
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="inputName" class="col-md-2 col-form-label">{{__('institution.taxRecord')}}</label>
                                <div class="col-md-8">
                                    {!! Form::text('num_tax',null,['class' => 'form-control']) !!}
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="inputName" class="col-md-2 col-form-label">{{__('institution.deliveryPrice')}}</label>
                                <div class="col-md-8">
                                    {!! Form::text('delivery_price',null,['class' => 'form-control']) !!}
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="inputName" class="col-md-2 col-form-label">{{__('institution.whatsappNumber')}}</label>
                                <div class="col-md-8">
                                    {!! Form::text('whatsapp',null,['class' => 'form-control']) !!}
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="inputName" class="col-md-2 col-form-label">{{__('institution.facebookAccount')}}</label>
                                <div class="col-md-8">
                                    {!! Form::text('facebook',null,['class' => 'form-control']) !!}
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="inputName" class="col-md-2 col-form-label">{{__('institution.institutionWebsite')}}</label>
                                <div class="col-md-8">
                                    {!! Form::text('site',null,['class' => 'form-control']) !!}
                                </div>
                            </div>

                            <div class="mb-3 row">
                                {{-- <label for="inputName" class="col-md-2 col-form-label"></label> --}}
                                <div class="col-md-12">
                                    <div class="mb-3 row">
                                        <label for="inputName" class="col-md-1 col-form-label">{{__('institution.from')}}</label>
                                        <div class="col-md-3">
                                            {!! Form::time('start_time',null,['class' => 'form-control']) !!}
                                        </div>
                                        
                                        <label for="inputName" class="col-md-1 col-form-label">{{__('institution.to')}}</label>
                                        <div class="col-md-3">
                                            {!! Form::time('end_time',null,['class' => 'form-control']) !!}
                                        </div>

                                        <label for="inputProjectLeader" class="col-md-1 col-form-label">{{__('institution.institutionPackage')}}</label>
                                        <div class="col-md-2">
                                            <select class="orm-control form-select select2" name="ratio">
                                                <option value="1">عادى</option>
                                                <option value="2">صفرى</option>
                                                <option value="3">بلاتينى</option>
                                                <option value="4">فضى</option>
                                                <option value="5">ذهبى</option>
                                                <option value="6">الماسى</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                            <div class="card-body">
                                <div class="mb-3 row">
                                    <label for="inputName" class="col-md-2 col-form-label">{{__('institution.workingDays')}}</label>
                                    <div class="col-md-8">
                                        <label style="margin-top: 8px;font-weight: bold">
                                            <input type="checkbox" id="select_all"/> {{__('institution.selectAll')}}
                                        </label>
                                        <?php
                                            if (!empty($records)) {
                                                $listDay[] = json_decode($records->day_work);
                                                foreach ($listDay[0] as $key => $value) {
                                                    $result[] = $value;
                                                }
                                            }
                                        ?>
                                        <div class="mb-3 row">
                                            <div class="checkbox col-sm-3 col-lg-3">
                                                <label>
                                                    <input
                                                        @if(!empty($records))
                                                        @if(in_array('Saturday', $result)) checked @endif
                                                        @endif
                                                        type="checkbox" name="day[]" value="Saturday"> السبت
                                                </label>
                                            </div>

                                            <div class="checkbox col-sm-3 col-lg-3">
                                                <label>
                                                    <input
                                                        @if(!empty($records))
                                                        @if(in_array('Sunday', $result)) checked @endif
                                                        @endif
                                                        type="checkbox" name="day[]"
                                                        value="Sunday"> الأحد
                                                </label>
                                            </div>

                                            <div class="checkbox col-sm-3 col-lg-3">
                                                <label>
                                                    <input
                                                        @if(!empty($records))
                                                        @if(in_array('Monday', $result)) checked @endif
                                                        @endif
                                                        type="checkbox"
                                                        name="day[]" value="Monday"> الإثنين
                                                </label>
                                            </div>

                                            <div class="checkbox col-sm-3 col-lg-3">
                                                <label>
                                                    <input
                                                        @if(!empty($records))
                                                        @if(in_array('Tuesday', $result)) checked @endif
                                                        @endif
                                                    type="checkbox"
                                                           name="day[]" value="Tuesday"> الثلاثاء
                                                </label>
                                            </div>
                
                                            <div class="checkbox col-sm-3 col-lg-3">
                                                <label>
                                                    <input
                                                        @if(!empty($records))
                                                        @if(in_array('Wednesday', $result)) checked @endif
                                                        @endif
                                                    type="checkbox"
                                                           name="day[]" value="Wednesday"> الأربعاء
                                                </label>
                                            </div>
                
                                            <div class="checkbox col-sm-3 col-lg-3">
                                                <label>
                                                    <input
                                                        @if(!empty($records))
                                                        @if(in_array('Thursday', $result)) checked @endif
                                                        @endif
                                                    type="checkbox"
                                                           name="day[]" value="Thursday"> الخميس
                                                </label>
                                            </div>
                
                                            <div class="checkbox col-sm-3 col-lg-3">
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
                            </div>

                            <div class="mb-3 row">
                                <div class="col-md-4">
                                    <div class="card card-body">
                                        <div class="card">
                                            <div class="card-body">
                                                <h3 class="card-title mt-0">{{__('institution.institutionLogo')}}</h3>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-body">
                                                <input type="file" id="logoInp" class="form-control" for="imgInp" name="logo" style="display: none"/>
                                                <img class="rounded mx-auto img-thumbnail" style="display: none; max-width: 350px;max-height: 400px;" id="logo" src="#" alt="your image" />

                                                @if(!empty($records->logo))
                                                    <img id="logo_old" class="rounded mx-auto img-thumbnail" src="{{asset($records->getOriginal('logo'))}}">
                                                @else
                                                    <img id="logoNoImage" class="rounded mx-auto img-thumbnail" src="{{ asset('img/no_image.png') }}">
                                                @endif
                                            </div>
                                        </div>                                                
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="input-group">
                                                    <label class="btn btn-success col fileinput-button" for="logoInp">
                                                        <i class="fas fa-plus"></i>
                                                        <span>{{__('institution.addFile')}}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="card card-body">
                                        <div class="card">
                                            <div class="card-body">
                                                <h3 class="card-title mt-0">{{__('institution.institutionCover')}}</h3>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-body">
                                                <input type="file" id="coverInp" class="form-control" for="imgInp" name="cover" style="display: none"/>
                                                <img class="rounded mx-auto img-thumbnail" style="display: none; max-width: 350px;max-height: 400px;" id="cover" src="#" alt="your image" />

                                                @if(!empty($records->cover))
                                                    <img id="cover_old" class="rounded mx-auto img-thumbnail" src="{{asset($records->getOriginal('cover'))}}">
                                                @else
                                                    <img id="coverNoImage" class="rounded mx-auto img-thumbnail" src="{{ asset('img/no_image.png') }}">
                                                @endif
                                            </div>
                                        </div>                                                
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="input-group">
                                                    <label class="btn btn-success col fileinput-button" for="coverInp">
                                                        <i class="fas fa-plus"></i>
                                                        <span>{{__('institution.addFile')}}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="card card-body">
                                        <div class="card">
                                            <div class="card-body">
                                                <h3 class="card-title mt-0">{{__('institution.institutionContractPic')}}</h3>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-body">
                                                <input type="file" id="contractInp" class="form-control" for="contractInp" name="picture_contract" style="display: none"/>
                                                <img class="rounded mx-auto img-thumbnail" style="display: none; max-width: 350px;max-height: 400px;" id="contract" src="#" alt="your image" />

                                                @if(!empty($records->picture_contract))
                                                    <img id="contract_old" class="rounded mx-auto img-thumbnail" src="{{ asset($records->getOriginal('picture_contract')) }}">
                                                @else
                                                    <img id="contractNoImage" class="rounded mx-auto img-thumbnail" src="{{ asset('img/no_image.png') }}">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="input-group">
                                                    <label class="btn btn-success col fileinput-button" for="contractInp">
                                                        <i class="fas fa-plus"></i>
                                                        <span>{{__('institution.addFile')}}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3 row">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="terms" class="custom-control-input check" id="exampleCheck1">
                            <label class="custom-control-label" for="exampleCheck1">
                                I agree to the 
                                <a href="#" data-bs-toggle="modal" data-bs-target="#modal-lg">
                                    terms of service.
                                </a>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>