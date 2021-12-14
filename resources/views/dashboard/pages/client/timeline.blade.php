<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('client.timelineTitle') }}</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="datatable2"
                class="table table-striped table-bordered dt-responsive nowrap"
                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                    <tr>
                        <th>{{ __('client.timelineOrderNoColumn') }}</th>
                        <th>{{ __('client.timelineBuyerColumn') }}</th>
                        <th>{{ __('client.timelineStatusColumn') }}</th>
                        <th>{{ __('client.timelinePriceColumn') }}</th>
                        <th>{{ __('client.timelineDetailsColumn') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($orders)
                        @foreach($orders as $order)
                            <tr>
                                <td>{{$order->id}}</td>
                                <td>{{$order->name_buyer}}</td>
                                <td>{{$order->status}}</td>
                                <td>{{$order->billing_total}}</td>
                                <td>
                                    <button id="order" type="button" class="btn btn-primary" data-orderid="{{$order->id}}" data-bs-toggle="modal" data-bs-target="#showOrder">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>