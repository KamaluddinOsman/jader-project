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

        <form action="{{url('coupons/'.$coupon->id)}}" method="get">
            @csrf
            @method('put')

            <div class="modal-body pd-20">
                <div class="form-group">
                    <label for="coupon"> Coupon Code</label>
                    <input name="coupon" value="{{$coupon->coupon}}" placeholder="Coupon Code" type="text"
                           class="form-control"
                           id="coupon">
                </div>

                <div class="form-group">
                    <label for="discount"> Discount </label>
                    <input name="discount" value="{{$coupon->discount}}" placeholder="Coupon Discount" type="text"
                           class="form-control"
                           id="discount">
                </div>

                <div class="form-group">
                    <label for="discount">Coupon Start Date</label>
                    <input name="start_date" value="{{$coupon->start_date}}" placeholder="Start Date" type="date" class="form-control"
                           id="start">
                </div>

                <div class="form-group">
                    <label for="discount">Coupon End Date</label>
                    <input name="end_date" value="{{$coupon->end_date}}" placeholder="Start Date" type="date" class="form-control"
                           id="end">
                </div>

                <div class="form-group">
                    <label for="discount">Number of people available</label>
                    <input name="count_use" value="{{$coupon->count_use}}" placeholder="Number of people available" type="number" class="form-control"
                           id="count_use">
                </div>

            </div><!-- modal-body -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-info pd-x-20">Update</button>
            </div>
        </form>

    </div><!-- card -->

@endsection
