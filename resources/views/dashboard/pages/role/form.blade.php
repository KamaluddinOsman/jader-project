
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
                    <div class="form-group">
                        <label style="color:#000;font-size: 15px;padding-bottom: 15px" class="label">إسم الرتبة </label>
                        {!! Form::text('name',null,[
                          'class' => 'form-control'
                        ]) !!}
                    </div>
                    <br>
                    <div class="form-group">
                        <label style="color:#000;font-size: 15px;padding-bottom: 15px" class="label">الإسم المعروض </label>
                        {!! Form::text('display_name',null,[
                          'class' => 'form-control'
                        ]) !!}
                    </div>
                    <br>
                    <div class="form-group">
                        <label style="color:#000;font-size: 15px;padding-bottom: 15px" class="label">الوصف </label>
                        {!! Form::textarea('description',null,[
                          'class' => 'form-control'
                        ]) !!}
                    </div>
                    <br>

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>


@push('script')

<script>
    // Select all
    $('#select_all').click(function () {
        $('input[type=checkbox]').prop('checked',$(this).prop('checked'));
    });
</script>

@endpush
