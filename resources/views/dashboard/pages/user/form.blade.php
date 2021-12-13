@inject('role','App\Role')
<?php
  $roles = $role->pluck('display_name','id')->toArray();
?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">بيانات عامة</h3>
    </div>
    <div class="card-body">
        <div class="mb-3 row">
            <label for="inputName" class="col-md-2 col-form-label">{{ __('user.userName') }}</label>
            <div class="col-md-8">
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
            </div>
        </div>
    
        <div class="mb-3 row">
            <label for="inputName" class="col-md-2 col-form-label">{{ __('user.userEmail') }}</label>
            <div class="col-md-8">
                {!! Form::text('email', null, ['class' => 'form-control']) !!}
            </div>
        </div>
    
        <div class="mb-3 row">
            <label for="inputName" class="col-md-2 col-form-label">{{ __('user.userPassword') }}</label>
            <div class="col-md-8">
                {!! Form::password('password', ['class' => 'form-control']) !!}
            </div>
        </div>
    
        <div class="mb-3 row">
            <label for="inputProjectLeader" class="col-md-2 col-form-label">{{ __('user.userRole') }}</label>
            <div class="col-md-8">
                {!! Form::select('roles_list[]', $roles, null ,array('class' => 'form-select select2', 'multiple' => 'multiple')) !!}
            </div>
        </div>
    </div>
    <!-- /.card-body -->
</div>