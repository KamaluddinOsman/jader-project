@extends('admin.layouts.layout')
@section('title')
    {{__('lang.color')}}
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/"><i class="fa fa-dashboard"></i> {{__('lang.master')}}
                            </a></li>
                        <li class="breadcrumb-item active"><i class="fa fa-dashboard"></i> {{__('lang.coupon')}}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <br>
    <br>

    @include('admin.layouts.flash-message')
    @include('flash::message')
    <div class="box-body">
        <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
                <div class="card-header">
                    <a href="#" class="btn btn-sm btn-warning" style="float: right" data-toggle="modal"
                       data-target="#modaldemo3">Add New</a>
                </div>

                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Coupon Code</th>
                        <th>Discount</th>
                        <th>Start</th>
                        <th>End</th>
                        <th>Count Use</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($coupons as $key=>$coupon)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$coupon->coupon}}</td>
                            <td>{{$coupon->discount}} %</td>
                            <td>{{$coupon->start_date}} </td>
                            <td>{{$coupon->end_date}} </td>
                            <td>{{$coupon->count_use}} </td>
                            <td>
                                <a href="{{\Illuminate\Support\Facades\URL::to('coupons/edit/'.$coupon->id)}}"
                                   class="btn btn-sm btn-info">Edit</a>
                                <a href="{{\Illuminate\Support\Facades\URL::to('coupons/delete/'.$coupon->id)}}"
                                   class="btn btn-sm btn-danger" id="delete">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div><!-- table-wrapper -->
        </div><!-- card -->
    </div><!-- sl-pagebody -->


    <!-- LARGE MODAL -->
    <div id="modaldemo3" class="modal fade">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content tx-size-sm">
                <div class="modal-header pd-x-20">
                    <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">coupon Add</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="post" action="{{route('store.coupon')}}">
                    @csrf
                    <div class="modal-body pd-20">
                        <div class="form-group">
                            <label for="coupon"> Coupon Code</label>
                            <input name="coupon" placeholder="coupon Code" type="text" class="form-control"
                                   id="coupon">
                        </div>
                        <div class="form-group">
                            <label for="discount">Coupon Discount (%)</label>
                            <input name="discount" placeholder="Discount" type="text" class="form-control"
                                   id="discount">
                        </div>

                        <div class="form-group">
                            <label for="discount">Coupon Start Date</label>
                            <input name="start_date" placeholder="Start Date" type="date" class="form-control"
                                   id="start">
                        </div>

                        <div class="form-group">
                            <label for="discount">Coupon End Date</label>
                            <input name="end_date" placeholder="Start Date" type="date" class="form-control"
                                   id="end">
                        </div>

                        <div class="form-group">
                            <label for="discount">Number of people available</label>
                            <input name="count_use" placeholder="Number of people available" type="number" class="form-control"
                                   id="count_use">
                        </div>
                    </div><!-- modal-body -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info pd-x-20">Save</button>
                        <button type="button" class="btn btn-secondary pd-x-20" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div><!-- modal-dialog -->
    </div><!-- modal -->


@endsection
