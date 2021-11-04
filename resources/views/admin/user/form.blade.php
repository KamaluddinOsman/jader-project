@inject('role','App\Role')
<?php
  $roles = $role->pluck('display_name','id')->toArray();
?>

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
                    <div class="form-group">
                        <label style="color:#000;font-size: 15px;padding-bottom: 15px" class="label">إسم المستخدم </label>
                        {!! Form::text('name',null,[
                          'class' => 'form-control'
                        ]) !!}
                    </div>

                    <div class="form-group">
                        <label style="color:#000;font-size: 15px;padding-bottom: 15px" class="label">الايميل  </label>
                        {!! Form::text('email',null,[
                          'class' => 'form-control'
                        ]) !!}
                    </div>

                    <div class="form-group">
                        <label style="color:#000;font-size: 15px;padding-bottom: 15px" class="label">{{__('lang.password')}}  </label>
                        {!! Form::password('password',[
                          'class' => 'form-control'
                        ]) !!}
                    </div>

                    <div class="form-group">
                        <label style="color:#000;font-size: 15px;padding-bottom: 15px" class="label">رتب المستخدمين  </label>
                        {!! Form::select('roles_list[]',$roles,null,[
                          'class' => 'form-control select2',
                          'multiple' => 'multiple',
                        ]) !!}
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>

{{--    \Illuminate\Support\Facades\Auth::id() == 1 ? 'disabled' : '',--}}
