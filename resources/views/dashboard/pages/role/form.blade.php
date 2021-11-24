
@inject('perm','App\Permission')
@inject('role','App\Role')

<section class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">بيانات عامة</h3>
                </div>
                <div class="card-body">
                    {{-- <div class="form-group">
                        <label style="color:#000;font-size: 15px;padding-bottom: 15px" class="label">إسم الرتبة </label>
                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    </div> --}}
                    <div class="mb-3 row">
                        <label for="inputName" class="col-md-2 col-form-label">{{ __('role.name') }}</label>
                        <div class="col-md-8">
                            {!! Form::text('name', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    {{-- <div class="form-group">
                        <label style="color:#000;font-size: 15px;padding-bottom: 15px" class="label">الإسم المعروض </label>
                        {!! Form::text('display_name', null, ['class' => 'form-control']) !!}
                    </div> --}}
                    <div class="mb-3 row">
                        <label for="inputName" class="col-md-2 col-form-label">{{ __('role.displayName') }}</label>
                        <div class="col-md-8">
                            {!! Form::text('display_name', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    {{-- <div class="form-group">
                        <label style="color:#000;font-size: 15px;padding-bottom: 15px" class="label">الوصف </label>
                        {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
                    </div> --}}
                    <div class="mb-3 row">
                        <label for="inputName" class="col-md-2 col-form-label">{{ __('role.description') }}</label>
                        <div class="col-md-8">
                            {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>