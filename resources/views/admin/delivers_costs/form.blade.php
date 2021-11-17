
@inject('perm','App\Permission')
@inject('role','App\Role')

<section class="container">
    <div class="row">
        <div class="col-md-12">
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
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label style="color:#000;font-size: 15px;padding-bottom: 15px" class="label"> من الكيلومترات </label>
                                {!! Form::text('from_k',null,[
                                  'class' => 'form-control'
                                ]) !!}
                            </div>

                            <div class="form-group">
                                <label style="color:#000;font-size: 15px;padding-bottom: 15px" class="label"> من تكلفة </label>
                                {!! Form::text('from_price',null,[
                                  'class' => 'form-control'
                                ]) !!}
                            </div>

                            <div class="form-group">
                                <label style="color:#000;font-size: 15px;padding-bottom: 15px" class="label">نوع السياره </label>
                                <select name="type_car" class="form-control select2" id="exampleFormControlSelect1">
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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label style="color:#000;font-size: 15px;padding-bottom: 15px" class="label"> إلى الكيلومترات </label>
                                {!! Form::text('to_k',null,[
                                  'class' => 'form-control'
                                ]) !!}
                            </div>

                            <div class="form-group">
                                <label style="color:#000;font-size: 15px;padding-bottom: 15px" class="label"> إلى تكلفة </label>
                                {!! Form::text('to_price',null,[
                                  'class' => 'form-control'
                                ]) !!}
                            </div>
                        </div>
                    </div>

                    <br>

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
