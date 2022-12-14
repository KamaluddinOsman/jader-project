@extends('dashboard.layouts.main')
@section('head')
    @section('page-title')
        {{ __('offer.offers') }} | {{ __('auth.bageTitle') }}             
    @endsection
    <!-- DataTables -->
    <link href="{{ asset('dashboard/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dashboard/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Sweet Alert-->
    <link href="{{ asset('dashboard/libs/sweetalert2/sweetalert.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="page-content">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">{{ __('offer.offerTable') }}</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">{{ __('dashboard.dashboard') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('offer.offerTable') }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

        @include('dashboard.layouts.flash-message')
        @include('flash::message')
        
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table id="datatable"
                            class="table table-striped table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{__('offer.imageColumn')}}</th>
                                    <th>{{__('offer.nameColumn')}}</th>
                                    <th>{{__('offer.productColumn')}}</th>
                                    <th>{{__('offer.institutionColumn')}}</th>
                                    <th>{{__('offer.discountValueColumn')}} (%)</th>
                                    <th>{{__('offer.discount')}} (????)</th>
                                    <th>{{__('offer.offerStarts')}}</th>
                                    <th>{{__('offer.offerEnds')}}</th>
                                    <th>{{__('offer.statusColumn')}}</th>
                                    <th>{{__('offer.activeColumn')}}</th>
                                    <th>{{__('offer.deleteColumn')}}</th>
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
                                                    <span class="badge badge-pill bg-danger">{{ __('offer.finished') }}</span>
                                                @elseif($record->start <= \Carbon\Carbon::now() && $record->end >= \Carbon\Carbon::now())
                                                    <span class="badge bg-success">{{ __('offer.workingNow') }}</span>
                                                @elseif($record->start > \Carbon\Carbon::now())
                                                    <span class="badge bg-warning">{{ __('offer.notStarted') }}</span>
                                                @endif
                                            </td>
        
                                            <td>
                                                @if($record->status == 1)
                                                    <input type="checkbox" id="{{$record->id}}" switch="bool" checked 
                                                    data-url="{{url('offer/active/'.$record->id)}}"
                                                    data-token="{{csrf_token()}}" class="form-label activeCheck"
                                                    name="activeCheck"/>
                                                    <label class="form-label" for="{{$record->id}}" data-on-label="{{__('offer.activeOffer')}}" data-off-label="{{__('offer.blockOffer')}}"></label>
                                                @else
                                                    <input type="checkbox" id="{{$record->id}}" switch="bool"
                                                    data-url="{{url('offer/active/'.$record->id)}}"
                                                    data-token="{{csrf_token()}}" class="form-label activeCheck"
                                                    name="activeCheck"/>
                                                    <label class="form-label" for="{{$record->id}}" data-on-label="{{__('offer.activeOffer')}}" data-off-label="{{__('offer.blockOffer')}}"></label>
                                                @endif
                                            </td>

                                            <td>
                                                <form style="display: inline-block" method="POST" action="{{route('offer.destroy', $record->id)}}">
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
@endsection
@section('scripts')
    <!-- Required datatable js -->
    <script src="{{ asset('dashboard/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dashboard/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Sweet Alerts js -->
    <script src="{{ asset('dashboard/libs/sweetalert2/sweetalert.min.js') }}"></script>

    <!-- Sweet alert init js-->
    <script src="{{ asset('dashboard/js/pages/sweet-alerts.init.js') }}"></script>

    <!-- Datatable init js -->
    <script src="{{ asset('dashboard/js/pages/datatables.init.js') }}"></script>

    <script>
        // Changing Offer Status
        $('.activeCheck').change(function () {
            var url = this.getAttribute('data-url');
            var token = this.getAttribute('data-token');
            $.ajax({
                type: 'get',
                data: {_token: token},
                url: url,
            });
            location.href = "/offer";
        });
    </script>

@endsection