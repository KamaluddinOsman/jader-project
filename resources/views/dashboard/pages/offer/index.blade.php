@extends('dashboard.layouts.main')
@section('head')
    @section('title')
            {{__('lang.category')}}
    @endsection
    <!-- DataTables -->
    <link href="{{ asset('dashboard/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dashboard/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{ asset('dashboard/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

@endsection
@section('content')
    <div class="page-content">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">Data Tables</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                            <li class="breadcrumb-item active">Data Tables</li>
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
                        <button type="button" style="margin-bottom: 8px" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#addCategory">
                            {{__('lang.addCategory')}}
                        </button>
                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table id="datatable-buttons"
                            class="table table-striped table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{__('lang.image')}}</th>
                                    <th>{{__('lang.name')}}</th>
                                    <th>{{__('lang.product')}}</th>
                                    <th>{{__('lang.store')}}</th>
                                    <th>{{__('lang.discount_value')}} (%)</th>
                                    <th>{{__('lang.discount')}} (رس)</th>
                                    <th>{{__('lang.start')}}</th>
                                    <th>{{__('lang.end')}}</th>
                                    <th>{{__('lang.status')}}</th>
                                    <th>{{__('lang.active')}}</th>
                                    <th>{{__('lang.delete')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($records))
        
                                    @foreach($records as $key => $record)
                                        <tr>
                                            <td>{{$key +1 }}</td>
                                            <td><img data-toggle="modal" data-target="#exampleModal" style="width: 50px; height: 50px; cursor: pointer" src="{{asset($record->image_license)}}"></td>
                                            <td>{{$record->name ?? ''}}</td>
                                            <td>{{$record->product->name  ?? ''}}</td>
                                            <td>{{$record->product->store->name  ?? ''}}</td>
                                            <td>{{$record->discount_value  ?? ''}} %</td>
                                            <td>{{$record->discount  ?? ''}}</td>
                                            <td>{{date('d-m-Y', strtotime($record->start)) ?? ''}}</td>
                                            <td>{{date('d-m-Y', strtotime($record->end)) ?? ''}}</td>
        
                                            <td>
                                                @if($record->end <= \Carbon\Carbon::now())
                                                    <span class="badge badge-danger">منتهى</span>
                                                @elseif($record->start <= \Carbon\Carbon::now() && $record->end >= \Carbon\Carbon::now())
                                                    <span class="badge badge-success">يعمل الان</span>
                                                @elseif($record->start > \Carbon\Carbon::now())
                                                    <span class="badge badge-warning">لم يبدأ</span>
                                                @endif
                                            </td>
        
                                            <td>
                                                <div class="checkbox">
                                                    <input data-url="{{url('offer/active/'.$record->id)}}"
                                                        data-token="{{csrf_token()}}" class="activeCheck" name="activeCheck"
                                                        type="checkbox" data-on="{{__('lang.active')}}"
                                                        data-off="{{__('lang.waiting')}}"
                                                        {{$record->status == 1 ? 'checked' : '' }} data-toggle="toggle"
                                                        data-onstyle="success" data-offstyle="warning">
                                                </div>
                                            </td>
                                            <td style="display: inline-block">
                                                <form style="display: inline-block" method="POST" action="{{route('offer.destroy', $record->id)}}">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
        
                                                    <div class="form-group">
                                                        <a class="btn btn-danger btn-mini deleteRecord">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                    </div>
                                                </form>
                                            </tr>
        
        
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    <div class="modal-body">
                                                        <img data-toggle="modal" data-target="#exampleModal" style="cursor: pointer" src="{{asset($record->image_license)}}">
                                                        <p style="text-align: center">{{$record->desc  ?? ''}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
        
                                @else
        
                                    <div class="alert alert-warning alert-block">
                                        <strong>{{__('lang.ThereAreNoData')}}</strong>
                                    </div>
        
                                @endif
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->

    </div>

     <!-- Edit Category Modal -->
    <div class="modal fade" id="editCategory" data-bs-backdrop="static"
        data-bs-keyboard="false" tabindex="-1" aria-labelledby="editCategoryLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCategoryLabel">
                        {{__('lang.EditCategory')}}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('category.update','category')}}" method="post" enctype="multipart/form-data">
                        {{method_field('PUT')}}
                        {{csrf_field()}}
                        <input type="hidden" name="category_id" id="category_id" value="">
                        {{-- @include('/dashboard/pages/store/form') --}}
                        {{-- <button class="btn btn-primary" type="submit"> {{__('lang.edit')}}</button> --}}
                
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">Close</button>
                            <button 
                                class="btn btn-primary" type="submit"> {{__('lang.edit')}}</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <!-- Add Category Modal-->
    <div class="modal fade" id="addCategory" data-bs-backdrop="static"
        data-bs-keyboard="false" tabindex="-1" aria-labelledby="addCategoryLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryLabel">
                        {{__('lang.Addcategory')}}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- @include('/dashboard/pages/store/create') --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">Close</button>
                    <button 
                        class="btn btn-primary" type="submit"> {{__('lang.add')}}</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
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

    <!-- Datatable init js -->
    <script src="{{ asset('dashboard/js/pages/datatables.init.js') }}"></script>

    {{-- <script src="{{ asset('dashboard/js/app.js') }}"></script> --}}

@endsection