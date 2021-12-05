@extends('dashboard.layouts.main')
@section('head')
    @section('title')
            {{__('institution.Institution')}}
    @endsection

    <!-- Responsive Table css -->    
    <link href="{{ asset('dashboard/libs/admin-resources/rwd-table/rwd-table.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Sweet Alert-->
    <link href="{{ asset('dashboard/libs/sweetalert2/sweetalert.css') }}" rel="stylesheet" type="text/css" />


@endsection
@section('content')
    <div class="page-content">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">{{ __('institution.institutionTable') }}</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">{{ __('dashboard.dashboard') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('institution.institutionTable') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-rep-plugin">
                            <div class="table-responsive mb-0" data-pattern="priority-columns">
                                <table id="tech-companies-1" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th data-priority="1">زمن التوصيل</th>
                                            <th data-priority="2">حالة الطلب</th>
                                            <th data-priority="3">طريقة الدفع</th>
                                            <th data-priority="4">القيمة الطلب</th>
                                            <th data-priority="5">جوال العميل</th>
                                            <th data-priority="6">اسم الكابتن</th>
                                            <th data-priority="7">زمن الانشاء</th>
                                            <th data-priority="8">تاريخ الطلب</th>
                                            <th data-priority="9">جوال الكابتن</th>
                                            <th data-priority="10">اسم المنشاءة</th>
                                            <th data-priority="11">رقم الطلب</th>
                                            <th data-priority="12">جوال المنشاءة</th>
                                            <th data-priority="13">اسم العميل</th>
                                        </tr>
                                    </thead>
        
                                    <tbody>
                                        @php
                                            $records=[];
                                        @endphp
                                        @if(count($records))
        
                                            @foreach($records as $record)
                                                <tr>
                                                    <td>{{$record->id}}</td>
                                                    <td>
                                                        <img style="width: 50px; height: 50px" src="{{ $record->logo ? asset($record->getOriginal('logo')) : asset('img/no_image.png') }}">
                                                    </td>
                                                    <td>{{$record->name}}</td>
                                                    <td>
                                                        <a href="{{url('store/'.$record->id)}}" class="btn btn-success">
                                                            <i class="mdi mdi-file-eye"></i>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a href="{{url('store/'.$record->id.'/edit')}}" class="btn btn-primary">
                                                            <i class="dripicons-document-edit"></i>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        @if($record->activated == 1)
                                                            <input type="checkbox" id="{{$record->id}}" switch="bool" checked 
                                                            data-url="{{url('store/active/'.$record->id)}}"
                                                            data-token="{{csrf_token()}}" class="form-label activeCheck"
                                                            name="activeCheck"/>
                                                            <label class="form-label" for="{{$record->id}}" data-on-label="{{__('institution.activeInstitution')}}" data-off-label="{{__('institution.blockInstitution')}}"></label>
                                                        @else
                                                            <input type="checkbox" id="{{$record->id}}" switch="bool" checked
                                                            data-url="{{url('store/active/'.$record->id)}}"
                                                            data-token="{{csrf_token()}}" class="form-label activeCheck"
                                                            name="activeCheck"/>
                                                            <label class="form-label" for="{{$record->id}}" data-on-label="{{__('institution.activeInstitution')}}" data-off-label="{{__('institution.blockInstitution')}}"></label>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <form method="POST" action="{{route('store.destroy', $record->id)}}">
                                                            {{ csrf_field() }}
                                                            {{ method_field('DELETE') }}
        
                                                            <div class="form-group">
                                                                <a class="btn btn-danger btn-mini deleteRecord">
                                                                    <i class="mdi mdi-delete-alert"></i>
                                                                </a>
                                                            </div>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
        
                                        @else
                                            
                                        @endif
                                    </tbody>
        
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->

    </div>

@endsection
@section('scripts')
    <!-- Required datatable js -->
    <script src="{{ asset('dashboard/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dashboard/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Buttons examples -->
    <script src="{{ asset('dashboard/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('dashboard/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('dashboard/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('dashboard/libs/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('dashboard/libs/pdfmake/build/vfs_fonts.js') }}"></script>
    <script src="{{ asset('dashboard/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('dashboard/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('dashboard/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>
    
    <!-- Responsive examples -->
    <script src="{{ asset('dashboard/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('dashboard/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

    <!-- Init js -->
    <script src="{{ asset('dashboard/js/pages/table-responsive.init.js') }}"></script>

    <!-- Datatable init js -->
    {{-- <script src="{{ asset('dashboard/js/pages/datatables.init.js') }}"></script> --}}

    <!-- Sweet Alerts js -->
    <script src="{{ asset('dashboard/libs/sweetalert2/sweetalert.min.js') }}"></script>

    <!-- Sweet alert init js-->
    <script src="{{ asset('dashboard/js/pages/sweet-alerts.init.js') }}"></script>


{{-- <script src="{{ asset('dashboard/js/custom.js') }}"></script> --}}

    <script>

        $(function () {
            $("#datatable").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#datatable_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "language": {
                    "sProcessing": "جارٍ التحميل...",
                    "sLengthMenu": "أظهر _MENU_ مدخلات",
                    "sZeroRecords": "لم يعثر على أية سجلات",
                    "sInfo": "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
                    "sInfoEmpty": "يعرض 0 إلى 0 من أصل 0 سجل",
                    "sInfoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",
                    "sInfoPostFix": "",
                    "sSearch": "ابحث:",
                    "sUrl": "",
                    "oPaginate": {
                        "sFirst": "الأول",
                        "sPrevious": "السابق",
                        "sNext": "التالي",
                        "sLast": "الأخير"
                    }
                }
            });
        });

        // Changing Category Status
        $('.activeCheck').change(function () {
            var url = this.getAttribute('data-url');
            var token = this.getAttribute('data-token');
            $.ajax({
                type: 'get',
                data: {_token: token},
                url: url,
            });
            location.href = "/store";
        });

    </script>

@endsection